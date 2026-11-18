<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkshopOneCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_crud_flow_works(): void
    {
        $this->assertSame('sqlite', config('database.default'));

        $response = $this->post('/students', [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'phone' => '07123456789',
            'address' => 'London',
            'date_of_birth' => '2000-01-01',
        ]);

        $student = Student::firstOrFail();
        $response->assertRedirect('/students');
        $this->get('/students')->assertOk()->assertSee('Ada Lovelace');
        $this->get("/students/{$student->id}")->assertOk()->assertSee('ada@example.com');

        $this->put("/students/{$student->id}", [
            'name' => 'Ada Byron',
            'email' => 'ada@example.com',
            'phone' => '07987654321',
            'address' => 'London',
            'date_of_birth' => '2000-01-01',
        ])->assertRedirect("/students/{$student->id}");

        $this->assertDatabaseHas('students', ['name' => 'Ada Byron']);
        $this->delete("/students/{$student->id}")->assertRedirect('/students');
        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    public function test_student_validation_rejects_invalid_data(): void
    {
        $this->from('/students/create')
            ->post('/students', ['name' => '', 'email' => 'not-an-email'])
            ->assertRedirect('/students/create')
            ->assertSessionHasErrors(['name', 'email', 'phone']);
    }

    public function test_course_crud_flow_works(): void
    {
        $response = $this->post('/courses', [
            'name' => 'Advanced Full Stack Development',
            'description' => 'Laravel course',
            'duration' => 12,
            'fee' => 999.99,
            'difficulty' => 'Hard',
            'is_active' => '1',
        ]);

        $course = Course::firstOrFail();
        $response->assertRedirect('/courses');
        $this->get('/courses')->assertOk()->assertSee('Advanced Full Stack Development');
        $this->get("/courses/{$course->id}")->assertOk()->assertSee('Laravel course');

        $this->put("/courses/{$course->id}", [
            'name' => 'Full Stack Development',
            'description' => 'Updated Laravel course',
            'duration' => 10,
            'fee' => 799.50,
            'difficulty' => 'Medium',
        ])->assertRedirect("/courses/{$course->id}");

        $this->assertDatabaseHas('courses', [
            'name' => 'Full Stack Development',
            'is_active' => false,
        ]);

        $this->delete("/courses/{$course->id}")->assertRedirect('/courses');
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }

    public function test_course_validation_rejects_invalid_data(): void
    {
        $this->from('/courses/create')
            ->post('/courses', [
                'name' => '',
                'description' => '',
                'duration' => 0,
                'fee' => -1,
                'difficulty' => 'Impossible',
            ])
            ->assertRedirect('/courses/create')
            ->assertSessionHasErrors(['name', 'description', 'duration', 'fee', 'difficulty']);
    }
}
