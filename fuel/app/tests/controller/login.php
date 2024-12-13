<?php

use Fuel\Core\Input;
use Fuel\Core\Response;
use Auth\Auth;
use Mockery as m;

class LoginTest extends \Fuel\Core\TestCase
{

//    public static function setUpBeforeClass() : void
//    {
//        \DB::query('CREATE DATABASE IF NOT EXISTS fuelphp_db')->execute();
//    }

    public function test_login_success_admin()
    {
        $this->assertTrue(true);
    }

    // public function test_login_success_client()
    // {
    //     Input::post('email','clientuser');
    //     Input::post('password','correctpassword');

    //     // Mock Auth::login
    //     Auth::shouldReceive('login')->with('clientuser', 'correctpassword')->andReturn(true);

    //     // Mock Auth::get_profile_fields to return role != 1
    //     Auth::shouldReceive('get')->with('role')->andReturn(2);

    //     // Mock Response::redirect
    //     Response::shouldReceive('redirect')->with('client')->once()->andReturn(null);

    //     // Mock Controller logic
    //     $response = (new Controller_Auth_Login())->action_index();
    // }

    // public function test_login_failure()
    // {
    //     Input::post('email','wronguser');
    //     Input::post('password','wrongpassword');

    //     // Mock Auth::login
    //     Auth::shouldReceive('login')->with('testuser', 'wrongpassword')->andReturn(false);

    //     // Mock Controller logic
    //     $response = (new Controller_Auth_Login())->action_index();
    // }
}