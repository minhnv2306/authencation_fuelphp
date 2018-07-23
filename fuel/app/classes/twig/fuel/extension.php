<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 09/07/2018
 * Time: 11:06
 */
class Twig_Fuel_Extension extends \Parser\Twig_Fuel_Extension
{
    public function getFunctions()
    {
        return array_merge(
            parent::getFunctions(), [
                /*
                 * Define a new function Twig
                 * Example form button
                 */
                new Twig_SimpleFunction('is_active', function () {
                    return true;
                }),
                new Twig_SimpleFunction('isValue', function () {
                    if (!empty(Session::get_flash())) {
                        return true;
                    } else {
                        return false;
                    }
                }),
            ]
        );
    }
}
