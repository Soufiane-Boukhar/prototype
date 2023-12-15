<?php

namespace Tests\Feature;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function test_task_create_and_store(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo('create-TaskController');
        $user->givePermissionTo('store-TaskController');
        $this->assertTrue($user->hasPermissionTo('create-TaskController'));
        $this->assertTrue($user->hasPermissionTo('store-TaskController'));

        $project = Project::factory()->create();

       

        $createResponse = $this->actingAs($user)->get(route('task.create', ['id' => $project->id]));

        $createResponse->assertStatus(200);

        $task = [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_date' => now()->format('Y-m-d'), 
            'end_date' => now()->addDays(7)->format('Y-m-d'), 
            'project_id' => $project->id,
        ];

        $storeResponse = $this->actingAs($user)->post(route('task.store', ['id' => $project->id]), $task);
        $storeResponse->assertStatus(302);
        $this->assertDatabaseHas('tasks', $task);
    }

    public function test_task_edit_and_update(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo('edit-TaskController');
        $user->givePermissionTo('update-TaskController');
        $this->assertTrue($user->hasPermissionTo('edit-TaskController'));
        $this->assertTrue($user->hasPermissionTo('update-TaskController'));

        $project = Project::factory()->create();

        $taskData = [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_date' => now()->format('Y-m-d'), 
            'end_date' => now()->addDays(7)->format('Y-m-d'), 
            'project_id' => $project->id,
        ];
        $task = Task::create($taskData);
        $task = Task::find($task->id);
        $editResponse = $this->actingAs($user)->get(route('task.edit', ['id' => $project->id, 'task_id' => $task->id]));
        $editResponse->assertStatus(200);
        $editResponse->assertViewIs('task.edit');
        $editResponse->assertViewHas('task', $task);
        $editResponse->assertViewHas('project', $project);

        $updatedData = [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(7)->format('Y-m-d'),
            'project_id' => $project->id,
        ];

        $updateResponse = $this->actingAs($user)->put(route('task.update', ['id' => $project->id, 'task_id' => $task->id]), $updatedData);

        $updateResponse->assertStatus(302);
        $this->assertDatabaseHas('tasks', $updatedData);
    }

    public function test_task_destroy(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo('destroy-TaskController');
        $this->assertTrue($user->hasPermissionTo('destroy-TaskController'));

        $project = Project::factory()->create();

        $taskData = [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_date' => now()->format('Y-m-d'), 
            'end_date' => now()->addDays(7)->format('Y-m-d'), 
            'project_id' => $project->id,
        ];

        $task = Task::create($taskData);
        $task = Task::find($task->id);

        $destroyResponse = $this->actingAs($user)->delete(route('task.destroy', ['id' => $project->id, 'task_id' => $task->id]));

        $destroyResponse->assertStatus(302);
        $this->assertDatabaseMissing('tasks', $taskData);
    }

}
