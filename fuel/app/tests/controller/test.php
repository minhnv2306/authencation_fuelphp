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
        if (true) {
            $this->assertEquals($expectedResult, $result);
        } else {
            $this->assertTrue(true);
        }
    }

    public function test_MockObject()
    {
        // Tạo lại 1 class Test với các phương thức giống hệt lớp chính
        $authorizeNet = $this->getMockBuilder(\Model\Test::class)
            ->getMock();

        // Định nghĩa lại một phương thức nào đó với giá trị trả về
        $return = true;

        // Tạo override phương thức với giá trị giả lập return
        $authorizeNet->expects($this->once())
            ->method('sluggify')
            ->will($this->returnValue($return));

        $result = $authorizeNet->sluggify('aaa');
        $this->assertTrue($result);
    }
}
