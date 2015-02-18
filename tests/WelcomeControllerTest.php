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

    public function testLogoutMechanic ()
    {
        $this->call('GET', 'logout');

        $this->assertRedirectedTo('/');
    }

}
