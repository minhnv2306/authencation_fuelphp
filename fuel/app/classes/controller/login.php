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

    public function post_register()
    {
        $vali = $this->_vali_register();

        $check_vali = $vali->run();

        // if validate successfully
        if ($check_vali) {
            if ($this->_validation_unique_username(Input::param('username'))) {

                if ($this->_validation_unique_email(Input::param('email'))) {
                    // If username is not exist
                    if (\Input::method() == 'POST' && \Security::check_token()) {
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

                    } else {
                        echo "Token sai sai";
                    }
                } else {
                    echo "email da ton tai";
                }
            } else {
                echo "username da ton tai";
            }
        } else {
            echo "Validator error";
        }
    }

    public function post_login()
    {
        $vali = $this->_vali();

        $check_vali = $vali->run();

        var_dump($check_vali);
        // was the login form posted?
        if (\Input::method() == 'POST')
        {
            // check the credentials.
            if (\Auth::instance()->login(\Input::param('username'), \Input::param('password')))
            {
                // did the user want to be remembered?
                if (\Input::param('remember', false))
                {
                    // create the remember-me cookie
                    \Auth::remember_me();
                }
                else
                {
                    // delete the remember-me cookie if present
                    \Auth::dont_remember_me();
                }
                // logged in, go back to the page the user came from, or the
                // application dashboard if no previous page can be detected
                \Response::redirect_back('/');
            }
            else
            {
                echo 2;
                // Login sai, tự động chuyển về trang login
                // login failed, show an error message
                //\Messages::error(__('login.failure'));
            }
        }

        // display the login page
        return \View::forge('login/index');
    }

    public function action_logout()
    {
        // remove the remember-me cookie, we logged-out on purpose
        \Auth::dont_remember_me();

        // logout
        \Auth::logout();

        // inform the user the logout was successful
        //\Messages::success(__('login.logged-out'));

        // and go back to where you came from (or the application
        // homepage if no previous page can be determined)
        \Response::redirect_back('/');
    }

    public function action_test()
    {
        if (Auth::check()) {
            return 1;
        } else {
            var_dump(__('index.name'));
            return \Lang::get('index.name');
        }
    }

    // validater login
    private function _vali()
    {
        $vali = Validation::forge();

        $vali->add_field('username', 'Your username', 'required');
        $vali->add_field('password', 'Your password', 'required|min_length[3]|max_length[10]');

        return $vali;
    }

    // validator register
    private function _vali_register()
    {

        $vali = Validation::forge();

        $vali->add_field('username', 'Your username', 'required');
        $vali->add_field('email', 'Email', 'required');
        $vali->add_field('password', 'Your password', 'required|min_length[3]|max_length[10]');
        $vali->add_field('confirmed_password', 'Confirmed password', 'required|match_field[password]');

        return ($vali);
    }
    private function _validation_unique_username($username)
    {
        $exists = DB::select(DB::expr('COUNT(*) as total_count'))->from('users')
            ->where('username', '=', $username)->execute()->get('total_count');

        return (bool) !$exists;
    }

    private function _validation_unique_email($email)
    {
        $exists = DB::select(DB::expr('COUNT(*) as total_count'))->from('users')->where('email', '=', $email)
            ->execute()->get('total_count');

        return (bool) !$exists;
    }
}