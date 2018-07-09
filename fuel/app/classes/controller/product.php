<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 03/07/2018
 * Time: 14:58
 */
class Controller_Product extends Controller
{
    public function action_add()
    {
        return Response::forge(View::forge('product/add'));
    }

    public function action_create()
    {
        $val = Validation::forge('product/add');
        $val->add_field('email', 'Your username', 'required');
        $val->add_field('password', 'Your password', 'required|min_length[3]|max_length[10]');

        // run validation on just post
        if ($val->run()) {
            // process your stuff when validation succeeds
            echo 1;
        } else {
            $errors = $val->error();
            var_dump($errors);
            // validation failed
        }
    }
}