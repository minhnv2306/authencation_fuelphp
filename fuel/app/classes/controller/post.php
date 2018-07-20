<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 19/07/2018
 * Time: 14:37
 */
class Controller_Post extends Controller
{
    public function action_create()
    {
        return Response::forge(View::forge('post/create'));
    }

    public function action_store()
    {
        try {
            $post = new \Model\Post();
            $post->title = Input::param('title');
            $post->content = Input::param('content');
            $post->save();

            Session::set_flash('successMessage', 'Successfully create post');
            Response::redirect('/');

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}