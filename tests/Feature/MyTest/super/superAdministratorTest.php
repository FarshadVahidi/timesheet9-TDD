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

    /** @test */
    public function super_admin_send_post_on_add_new_person()
    {
        $this->withoutExceptionHandling();

        $role = Role::factory()->create(['name' => 'superadministrator']);
        $user = User::factory()->create();
        $user->attachRole($role);

        $this->actingAs($user)->post('/addNewPerson',['name' => 'farshad', 'email' => 'farshad@app.com', 'password' => 'password', 'role_id' => '1'])->assertRedirect('/addNewPerson')->assertViewHas('user_added', 'User added successfully.');
        $this->assertCount(2, User::all());
    }
}
