<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 20/07/2018
 * Time: 08:39
 */
return array(
    'fuelphp' => array(
        'app_created' => function() {
            // After FuelPHP initialised
        },
        'request_created' => function() {
            // After Request forged
        },
        'request_started' => function() {
            // Request is requested
//            echo "Event when resquest is requested (in config)!";
//            echo "<br>";
        },
        'controller_started' => function() {
            // Before controllers before() method called
        },
        'controller_finished' => function() {
            // After controllers after() method called
        },
        'response_created' => function() {
            // After Response forged
        },
        'request_finished' => function() {
            // Request is complete and Response received
        },
        'shutdown' => function() {
            // Output has been send out
        },
    )
)
?>