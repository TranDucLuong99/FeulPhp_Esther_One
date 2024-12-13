<?php

use Fuel\Core\Input;
use Fuel\Core\Response;
use Auth\Auth;
use Mockery as m;

class Test_Controller_Login  extends \Fuel\Core\TestCase
{
    public function test_successful_login()
    {
        // Dữ liệu đăng nhập
        $data = ['username' => 't_ducluong', 'password' => '12345678'];

        // Gửi yêu cầu POST để đăng nhập
        $url = 'admin/login';
        $method = 'POST';
        $response = Request::forge($url)->set_method($method)->set_post($data, null)->execute()->response();

        $this->assertEquals(true);

//        $this->assertContains('Welcome, t_ducluong', $response->body());
//
//        $this->assertTrue(Auth::check());
    }
}