<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 09/07/2018
 * Time: 10:49
 */
class Controller_Twiger extends \Controller
{
    public function action_index()
    {
        return \View::forge('twig/index.twig');
    }
}
