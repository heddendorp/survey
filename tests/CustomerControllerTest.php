<?php
/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 19.02.2015
 * Time: 10:28
 */

class CustomerControllerTest extends TestCase{

    public function testIndexRedirect()
    {
        $this->call('GET','customer');
        $this->assertRedirectedTo('/');
    }

}
