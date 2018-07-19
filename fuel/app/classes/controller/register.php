<?php

/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 18/07/2018
 * Time: 16:05
 */
class Controller_Register extends Controller
{
    public function action_register()
    {
        $rules = $this->setRules();
        $check_vali = $this->validateData($rules);

        if ($check_vali) {
            $this->register();
        } else {
            return $this->handleFailedValidateResponse($rules);
        }
    }

    private function register()
    {
        if (\Input::method() == 'POST' && \Security::check_token()) {
            $this->createUser();

        } else {
            $this->handWrongTokenResponse();
        }
    }

    private function validateData($rules)
    {
        $check_vali = $rules->run();

        if ($check_vali) {
            $this->validateUniqueUsername();
            $this->validateUniqueEmail();

            return true;
        }
        return false;
    }

    private function validateUniqueUsername()
    {
        if (!$this->_validation_unique_username(Input::param('username'))) {
            Session::set_flash('errorMessage', 'Username is exist');
            return \Response::redirect_back('login/register');
        }
    }
    private function validateUniqueEmail()
    {
        if (!$this->_validation_unique_email(Input::param('email'))) {
            Session::set_flash('errorMessage', 'Email is exist');
            return \Response::redirect_back('login/register');
        }
    }

    private function createUser()
    {
        $username = Input::param('username');
        $password = Input::param('password');
        $email = Input::param('email');
        try {
            // call Auth to create this user
            $created = \Auth::create_user(
                $username,
                $password,
                $email,
                100
            );
            // if a user was created succesfully
            if ($created) {
                // Login user and redirect home
                Auth::login($username, $password);

                \Response::redirect_back('/');
            } else {
                echo "Tao user that bai";
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    private function setRules()
    {

        $vali = Validation::forge();

        $vali->add_field('username', 'Your username', 'required');
        $vali->add_field('email', 'Email', 'required');
        $vali->add_field('password', 'Your password', 'required|min_length[3]|max_length[10]');
        $vali->add_field('confirmed_password', 'Confirmed password', 'required|match_field[password]');

        return $vali;
    }

    private function _validation_unique_username($username)
    {
        $exists = DB::select(DB::expr('COUNT(*) as total_count'))->from('users')
            ->where('username', '=', $username)->execute()->get('total_count');

        return (bool)!$exists;
    }

    private function _validation_unique_email($email)
    {
        $exists = DB::select(DB::expr('COUNT(*) as total_count'))->from('users')->where('email', '=', $email)
            ->execute()->get('total_count');

        return (bool)!$exists;
    }

    private function handleFailedValidateResponse($vali)
    {
        $errors = $vali->error();
        $oldRequest = $vali->validated();
        $data = array(
            'errors' => $errors,
            'oldRequest' => $oldRequest,
        );

        return Response::forge(View::forge('login/register')->set($data));
    }

    private function handleUsernameExistResponse()
    {
        $errorMessage = 'Username is exist!';
        $data = array(
            'errorMessage' => $errorMessage,
        );

        return Response::forge(View::forge('login/register')->set($data));
    }

    private function handleEmailExistResponse()
    {
        $errorMessage = 'Email is exist!';
        $data = array(
            'errorMessage' => $errorMessage,
        );

        return Response::forge(View::forge('login/register')->set($data));
    }

    private function handWrongTokenResponse()
    {
        $errorMessage = 'Dont hack my wed :D!';
        $data = array(
            'errorMessage' => $errorMessage,
        );

        return Response::forge(View::forge('login/register')->set($data));
    }
}