<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_course_can_be_created(): void
    {
        $response = $this->post(route('courses.store'), [
            'name' => 'Laravel Fundamentals',
            'description' => 'A practical introduction to Laravel.',
            'duration' => 8,
            'fee' => 12500,
            'difficulty' => 'Easy',
            'is_active' => true,
        ]);

        $response
            ->assertRedirect(route('courses.index'))
            ->assertSessionHas('success', 'Course Laravel Fundamentals created successfully.');

        $this->assertDatabaseHas('courses', [
            'name' => 'Laravel Fundamentals',
            'duration' => 8,
            'difficulty' => 'Easy',
            'is_active' => true,
        ]);
    }

    public function test_course_validation_rejects_invalid_values(): void
    {
        $this->post(route('courses.store'), [
            'name' => '',
            'duration' => 0,
            'fee' => -1,
            'difficulty' => 'Expert',
        ])->assertSessionHasErrors([
            'name',
            'duration',
            'fee',
            'difficulty',
            'is_active',
        ]);
    }

    public function test_a_course_can_be_viewed_and_updated(): void
    {
        $course = Course::create([
            'name' => 'PHP Basics',
            'duration' => 6,
            'fee' => 9000,
            'difficulty' => 'Easy',
            'is_active' => true,
        ]);

        $this->get(route('courses.show', $course))
            ->assertOk()
            ->assertSee('PHP Basics');

        $this->put(route('courses.update', $course), [
            'name' => 'Modern PHP',
            'description' => 'Updated course description.',
            'duration' => 7,
            'fee' => 10000,
            'difficulty' => 'Medium',
            'is_active' => false,
        ])->assertRedirect(route('courses.show', $course));

        $this->assertDatabaseHas('courses', [
            'id' => $course->id,
            'name' => 'Modern PHP',
            'difficulty' => 'Medium',
            'is_active' => false,
        ]);
    }

    public function test_a_course_can_be_deleted_and_missing_courses_return_404(): void
    {
        $course = Course::create([
            'name' => 'Database Design',
            'duration' => 5,
            'fee' => 8000,
            'difficulty' => 'Medium',
            'is_active' => true,
        ]);

        $this->delete(route('courses.destroy', $course))
            ->assertRedirect(route('courses.index'));

        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
        $this->get('/courses/9999')->assertNotFound();
    }
}
