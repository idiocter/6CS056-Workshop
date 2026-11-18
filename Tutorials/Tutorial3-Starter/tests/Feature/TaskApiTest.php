<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_can_be_managed_through_the_api(): void
    {
        $created = $this->postJson('/api/tasks', [
            'title' => 'Finish tutorial',
            'description' => 'Complete the API section',
            'status' => 'pending',
            'due_date' => '2026-11-30',
        ])->assertCreated()
            ->assertJsonPath('title', 'Finish tutorial');

        $taskId = $created->json('id');

        $this->getJson("/api/tasks/{$taskId}")
            ->assertOk()
            ->assertJsonPath('status', 'pending');

        $this->patchJson("/api/tasks/{$taskId}", [
            'status' => 'completed',
        ])->assertOk()
            ->assertJsonPath('status', 'completed');

        $this->deleteJson("/api/tasks/{$taskId}")
            ->assertOk()
            ->assertJsonPath('message', 'Task deleted successfully');

        $this->assertDatabaseMissing('tasks', ['id' => $taskId]);
    }
}
