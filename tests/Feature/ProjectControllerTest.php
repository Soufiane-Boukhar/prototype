<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Project;
use App\Models\User;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProjectControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function test_project_create_and_store(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $user->givePermissionTo('create-ProjectController');
        $user->givePermissionTo('store-ProjectController');
        $user->givePermissionTo('index-ProjectController');
        $this->assertTrue($user->hasPermissionTo('create-ProjectController'));
        $this->assertTrue($user->hasPermissionTo('store-ProjectController'));
        $this->assertTrue($user->hasPermissionTo('index-ProjectController'));
        $createPermissionResponse = $this->get(route('project.create'));
        $createPermissionResponse->assertStatus(200);
        $project = Project::factory()->raw();
        $storePermissionResponse = $this->post(route('project.store'), $project);
        $storePermissionResponse->assertStatus(302);
        $redirectUrl = $storePermissionResponse->headers->get('Location');
        $this->get($redirectUrl)
            ->assertStatus(200);
    }

    
    
    public function test_project_edit_and_update(): void
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'project-manager']);
        $user->assignRole($role);
        $role->givePermissionTo('edit-ProjectController');
        $role->givePermissionTo('update-ProjectController');
        $this->assertTrue($user->hasPermissionTo('edit-ProjectController'));
        $this->assertTrue($user->hasPermissionTo('update-ProjectController'));
        $project = Project::factory()->create();
        $editResponse = $this->actingAs($user)->get(route('project.edit', ['id' => $project->id]));
        $editResponse->assertStatus(200);
        $editedData = [
            'name' => 'Edited Project Name',
            'description' => 'Edited Project Description',
        ];
        $updateResponse = $this->actingAs($user)->put(route('project.update', ['id' => $project->id]), $editedData);
        $updateResponse->assertStatus(302);
        $this->assertDatabaseHas('projects', $editedData);
    }


    public function test_project_destroy(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo('destroy-ProjectController');
        $project = Project::factory()->create();
        $this->assertTrue($user->hasPermissionTo('destroy-ProjectController'));
        $destroyResponse = $this->actingAs($user)->delete(route('project.destroy', ['id' => $project->id]));
        $destroyResponse->assertStatus(302);
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }



}