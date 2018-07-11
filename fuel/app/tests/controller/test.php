<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 11/07/2018
 * Time: 15:20
 */
class Test_Controller_Test extends TestCase
{
    public function test_SluggifyReturnsSluggifiedString()
    {
        $originalString = 'This string will be sluggified';
        $expectedResult = 'this-string-will-be-sluggified';

        $url = new \Model\Test();
        $result = $url->sluggify($originalString);
        $this->assertEquals($expectedResult, $result);
    }
}
