<?php

namespace Tests\Feature\MyTest\super;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class superAdministratorTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function super_admin_can_add_new_staff_to_database()
    {
        $this->withoutExceptionHandling();

        $role = Role::factory()->create(['name' => 'superadministrator']);
        $user = User::factory()->create();
        $user->attachRole($role);

        $this->actingAs($user)->get('/addNewPerson')->assertRedirect('super.registration');
    }
}
