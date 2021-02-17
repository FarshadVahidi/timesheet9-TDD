<?php

namespace Tests\Feature\MyTest;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class multiAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_signed_in_staff_have_access_to_dashboard()
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    /** @test */
    public function after_check_staff_route_them_to_the_correct_dashboard()
    {
        $this->withoutExceptionHandling();

        //these tre line are setting
        $role = Role::factory()->create(['name' => 'user']);
        $user = User::factory()->create();
        $user->attachRole($role);

        $this->assertTrue($user->hasRole('user'));
//        $this->actingAs($user)->get('/dashboard')->assertRedirect('user.dashboard'); this test check the URL but i am returning view
        $this->actingAs($user)->get('/dashboard')->assertOk();
        $this->actingAs($user)->get('/dashboard')->assertViewIs('user.dashboard');
    }
}
