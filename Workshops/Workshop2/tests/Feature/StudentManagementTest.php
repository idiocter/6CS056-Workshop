<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_pages_use_the_shared_layout(): void
    {
        $this->get(route('students.index'))
            ->assertOk()
            ->assertSee('Training Institute')
            ->assertSee('Students')
            ->assertSee('Courses')
            ->assertSee('Training Institute Management System');
    }

    public function test_a_student_can_be_created(): void
    {
        $response = $this->post(route('students.store'), [
            'name' => 'Aarav Sharma',
            'email' => 'aarav@example.com',
            'phone' => '9800000001',
            'address' => 'Kathmandu',
            'date_of_birth' => '2002-04-12',
        ]);

        $response
            ->assertRedirect(route('students.index'))
            ->assertSessionHas('success', 'Student Aarav Sharma created successfully.');

        $this->assertDatabaseHas('students', [
            'name' => 'Aarav Sharma',
            'email' => 'aarav@example.com',
        ]);
    }

    public function test_student_validation_rejects_missing_fields_and_duplicate_email(): void
    {
        Student::create([
            'name' => 'Maya Rai',
            'email' => 'maya@example.com',
            'phone' => '9800000002',
        ]);

        $this->post(route('students.store'), [])
            ->assertSessionHasErrors(['name', 'email', 'phone']);

        $this->post(route('students.store'), [
            'name' => 'Another Maya',
            'email' => 'maya@example.com',
            'phone' => '9800000003',
        ])->assertSessionHasErrors('email');
    }

    public function test_a_student_can_keep_their_email_when_updated(): void
    {
        $student = Student::create([
            'name' => 'Nima Sherpa',
            'email' => 'nima@example.com',
            'phone' => '9800000004',
        ]);

        $this->put(route('students.update', $student), [
            'name' => 'Nima T. Sherpa',
            'email' => 'nima@example.com',
            'phone' => '9800000004',
            'address' => 'Lalitpur',
            'date_of_birth' => '2001-09-20',
        ])->assertRedirect(route('students.show', $student));

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Nima T. Sherpa',
            'email' => 'nima@example.com',
        ]);
    }

    public function test_a_student_can_be_deleted_and_missing_students_return_404(): void
    {
        $student = Student::create([
            'name' => 'Rita Gurung',
            'email' => 'rita@example.com',
            'phone' => '9800000005',
        ]);

        $this->delete(route('students.destroy', $student))
            ->assertRedirect(route('students.index'));

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
        $this->get('/students/9999')->assertNotFound();
    }
}
