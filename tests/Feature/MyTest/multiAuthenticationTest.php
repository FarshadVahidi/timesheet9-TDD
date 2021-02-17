<?php

namespace Tests\Feature\MyTest;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class multiAuthenticationTest extends TestCase
{
    /** @test */
    public function only_signed_in_staff_have_access_to_dashboard()
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }
}
