<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Task;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
 
    use RefreshDatabase;

    public function user_retrieve_task()
    {

        $testunit = $this->testunit();
        factory(Task::class, 3)->create(['user_id' => $testunit]);

        $this->actingAs($testunit)
            ->json('GET', '/tasks')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [[
                    'id',
                    'title',
                    'description',
                    'due_at',
                    'is_completed',
                    'user_id',
                ]],
            ])
            ->assertJsonCount(3, 'data');
    }



    public function user_can_update_a_task()
    {
        $testunit = $this->testunit();
        $task = factory(Task::class)->create(['user_id' => $testunit]);
        $this->actingAs($testunit)
            ->json('PUT', "/tasks/{$task->id}/update", [
                'title' => 'Get groceries',
                'description' => 'getting it',
                'due_at' => now()->toDateTimeString(),
                'is_completed' => true,
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'description',
                    'due_at',
                    'user_id',
                        
                    
                ],
            ])
            ->assertJson([
                'data' => [
                    'id' => $task->id,
                    'title' => 'Get groceries',
                    'description' => 'getting it',
                    'due_at' => now()->toATOMString(),
                    'is_completed' => true,
                    'user_id' => [
                        'id' => $testunit->id,
                        'name' => $testunit->name,
                        'email' => $testunit->email
                    ]
                ]
            ])
            ->assertJsonCount(1);
    }

    public function user_can_complete_a_task_without_updating_title()
    {
        $testunit = $this->testunit();
        $task = factory(Task::class)->create(['user_id' => $testunit]);
        $this->actingAs($testunit)
            ->json('PUT', "/tasks/{$task->id}/completed", [
                'is_completed' => true,
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'description',
                    'due_at',
                    'user_id',
                        
                    
                ],
            ])
            ->assertJson([
                'data' => [
                    'id' => $task->id,
                    'title' => $task->title,
                    'description' => $task->description,
                    'due_at' => $task->due_at,
                    'is_completed' => true,
                    'user_id',

                    
                ]
            ])
            ->assertJsonCount(1);
        $this->assertEquals($task->title, $task->refresh()->title);
        $this->assertTrue($task->is_completed);
    }

    public function user_can_delete_a_task()
    {
        $testunit = $this->testunit();
        $task = factory(Task::class)->create(['user_id' => $testunit]);
        $this->actingAs($testunit)
            ->json('DELETE', "/tasks/{$task->id}/delete")
            ->assertStatus(204);
        $this->assertDatabaseMissing('tasks', $task->toArray());
    }
    /** @test */
   
}
