<?php

/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 04/07/2018
 * Time: 09:55
 */
class Controller_Login extends Controller
{
    public function get_register()
    {
        return Response::forge(View::forge('login/register'));
    }

    public function get_login()
    {
        return Response::forge(View::forge('login/index'));
    }

    public function post_login()
    {
        $vali = $this->_vali_login();
        $checkVali = $vali->run();

        if ($checkVali) {
            $this->handleLoginEvent();
        } else {
            return $this->handleFailedValidateResponse($vali);
        }
    }

    public function action_logout()
    {
        \Auth::dont_remember_me();
        \Auth::logout();

        \Response::redirect_back('/');
    }

    private function _vali_login()
    {
        $vali = Validation::forge();

        $vali->add_field('username', 'Your username', 'required');
        $vali->add_field('password', 'Your password', 'required|min_length[3]|max_length[10]');

        return $vali;
    }

    private function login($username, $password)
    {
        return \Auth::instance()->login($username, $password);
    }

    private function handleLoginEvent()
    {
        $username = \Input::param('username');
        $password = \Input::param('password');
        $checkLogin = $this->login($username, $password);

        if ($checkLogin) {
            $this->handleRememberMe(\Input::param('remember', false));

            \Response::redirect_back('/');
        } else {
            $this->handleFailedLoginResponse();
        }
    }

    private function handleFailedValidateResponse($vali)
    {
        $errors = $vali->error();
        $oldRequest = $vali->validated();
        $data = array(
            'errors' => $errors,
            'oldRequest' => $oldRequest,
        );

        return Response::forge(View::forge('login/index')->set($data));
    }
    private function handleFailedLoginResponse()
    {
        Session::set_flash('errorMessage', 'Username or password not right!');
        return Response::redirect('login/login');
    }
    private function handleRememberMe($remeberMe = true)
    {
        if ($remeberMe) {
            \Auth::remember_me();
        } else {
            \Auth::dont_remember_me();
        }

    }
}