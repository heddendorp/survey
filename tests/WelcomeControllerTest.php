<?php
/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 18.02.2015
 * Time: 11:22
 */



class WelcomeControllerTest extends TestCase {

    public function testWelcomePage ()
    {
        $this->call('GET', '/');

        $this->assertResponseOk();
    }

    public function testLoginPage ()
    {
        $this->call('GET', 'login');

        $this->assertResponseOk();
    }

    public function testUnauthorizedLogin()
    {
        $credentials = array(
            'email' => 'test@admin.com',
            'password' => 'ifail',
            'remember' => false
        );
        $response = $this->call('POST', '/login', $credentials);
        $this->assertRedirectedTo('/login');
    }

    public function testAuthorizedLogin()
    {
        $credentials = array(
            'email' => 'lu.heddendorp@gmail.com',
            'password' => 'lukas2110'
        );
        $response = $this->call('POST', '/login', $credentials);
        $this->assertRedirectedTo('/customer/1');
    }

    public function testUnauthorizedAccess()
    {
        $this->call('GET', '/customer/1');
        $this->assertRedirectedTo('/login');
    }

    public function testDashboard()
    {
        $user = \Survey\Models\User::first();
        $this->be($user);
        $this->call('GET', '/customer/1');
        $this->assertResponseOk();
    }

    public function testLogoutMechanic ()
    {
        $user = \Survey\Models\User::first();
        $this->be($user);
        $this->call('GET', 'logout');
        $this->assertRedirectedTo('/');
    }

}
