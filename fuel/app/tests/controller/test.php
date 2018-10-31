<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 11/07/2018
 * Time: 15:20
 */
use \Model\Test;
use \Model\Book;
use Fuel\Core\Response;
use AspectMock\Test as Aspect;

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
        $newTestClass = $this->getMockBuilder(\Model\Test::class)
            ->getMock();

        // Định nghĩa lại một phương thức nào đó với giá trị trả về
        $return = true;

        // Tạo override phương thức với giá trị giả lập return
        $newTestClass->expects($this->once())
            ->method('sluggify')
            ->will($this->returnValue($return));

        $result = $newTestClass->sluggify('aaa');
        $this->assertTrue($result);
    }

    // Test with mockery package support
    public function test_MockObjectMockery()
    {
        $newTestClass = \Mockery::mock(\Model\Test::class)
            ->shouldReceive('sluggify')
            ->once()
            ->andReturn(true)
            ->getMock();

        $result = $newTestClass->sluggify('aaa');
        $this->assertTrue($result);
    }

    public function test_testStaticMethodWithMockery()
    {
        $newTestClass = \Mockery::mock('alias:Test');
        $newTestClass
            ->shouldReceive('doYouLoveMe')
            ->once()
            ->andReturn(true);

        $result = $newTestClass::doYouLoveMe();
        $this->assertTrue($result);
    }

    public function test_testStaticMethosWithAspect()
    {
        $return = true;
        // Mock các phương thức
        Aspect::double(Test::class, [
            'doYouLoveMe' => $return,
        ]);

        // Execute a request to 'test/redirect'
        $response = Request::forge('test/doYouLoveMe')
            ->set_method('GET')
            ->execute()
            ->response();

        // Xác nhận tham số redirect có phải/redirect hem?
        $this->assertEquals(200, $response->status);

        // Note: truyen tham so theo post
        /*
        // Execute a request to 'test/redirect'
        $response = Request::forge('/redirect')
            ->set_method('POST')
            ->set_post([
                'user_id' => 1,
                'member_id' => 32443,
            ], null)
            ->execute()
            ->response();
        */
    }

    public function test_testDI()
    {
        // Book trong phương thức getBookModel() đang được gọi qua Container, đoạn này giả lập Container
        Container::add('book', 'Minh');


        // Gia lap class Book qua Container
        // Gia lap method paginate luon tra ve true

        $newBookClass = \Mockery::mock(\Model\Book::class)
            ->shouldReceive('paginate')
            ->once()
            ->andReturn(true)
            ->getMock();

        Container::add('book', $newBookClass);
        // Gọi ra và nó là lớp mà ta giả lập
        // var_dump(Test::getBookModel());
    }

    public function test_testRedirect()
    {
        // Replace Response::redirect() with a test double which only returns true
        $res = Aspect::double(Response::class, [
            'redirect' => true
        ]);

        // Execute a request to 'test/testRedirect'
        $response = Request::forge('test/testRedirect')
            ->set_method('GET')
            ->execute()
            ->response();

        $res->verifyInvoked('redirect', ['book/index']); // tương đương assert
        $this->assertEquals(200, $response->status);
    }
}
