<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 09/07/2018
 * Time: 13:46
 */
class Controller_Language extends Controller
{
    public function action_index()
    {
        $a = Lang::load('index');
        Lang::load('index2');
        echo __('index');
    }
}
