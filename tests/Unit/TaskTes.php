<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Task;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RouteTest extends TestCase
{

    use RefreshDatabase;

    /**test */
    public function check_if_task_complete(){

        $testunit = $this->testunit();
        $this->actingAs($testunit);

        $notCompleted = factory(Task::class)->create(['user_id' => $testunit->id]);
        $completed = factory(Task::class)->states('completed')->create(['user_id' => $testunit->id]);

        $this->assertTrue($completed->is_completed);
        $this->assertFalse($notCompleted->is_completed);

    }
    
}
