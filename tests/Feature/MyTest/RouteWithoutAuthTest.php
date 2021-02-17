<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteWithoutAuthTest extends TestCase
{

    /** @test */
    public function route_for_home_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/home');

        $response->assertOk();
    }

    /** @test */
    public function route_for_about_us_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/about');

        $response->assertOk();
    }

    /** @test */
    public function route_for_contact_us_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/contact');

        $response->assertOk();
    }

}
