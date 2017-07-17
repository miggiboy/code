<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ACLTest extends TestCase
{
    /** @test */
    function not_authenticated_user_is_redirected_to_login_page_test()
    {
        $response = $this->get('/')
            ->assertSee('Вход на сайт')
            ->assertStatus(403);
    }

    /** @test */

    function newly_registered_user_has_no_access_test()
    {
        // User hits /register
        $response = $this->get('/register')
            ->assertSee('Регистрация');

        // sends post request to /register
        // tries to log in
        // fails
    }
}
