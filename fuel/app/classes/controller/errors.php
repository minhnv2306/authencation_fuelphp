<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 23/07/2018
 * Time: 14:52
 */
class Controller_Errors extends Controller
{
    public function action_404()
    {
        return View::forge('errors/404.twig');
    }
}