<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class CurriculumTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_curriculum() {
        $response = $this->post('/api/curriculum/create', [
            'name' => 'John Doe',
            'email' => 'pBc9d@example.com',
            'phone' => '1234567890',
            'position' => 'Software Engineer',
            'education' => 'Ensino Médio',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file_name' => 'curriculum.pdf',
            'file_path' => 'storage/curriculum.pdf',
        ]);

        $response->assertStatus(201)->assertJsonStructure(['id', 'name', 'email']);
    }

    public function test_cannot_create_curriculum_without_name() {
        $response = $this->post('/api/curriculum/create', [
            'email' => 'pBc9d@example.com',
            'phone' => '1234567890',
            'position' => 'Software Engineer',
            'education' => 'Bachelor of Science in Computer Science',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file_name' => 'curriculum.pdf',
            'file_path' => 'storage/curriculum.pdf',
        ]);

        $response->assertStatus(422);
    }

    public function test_cannot_create_curriculum_without_email() {
        $response = $this->post('/api/curriculum/create', [
            'name' => 'John Doe',
            'phone' => '1234567890',
            'position' => 'Software Engineer',
            'education' => 'Bachelor of Science in Computer Science',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file_name' => 'curriculum.pdf',
            'file_path' => 'storage/curriculum.pdf',
        ]);

        $response->assertStatus(422);
    }

    public function test_cannot_create_curriculum_without_phone() {
        $response = $this->post('/api/curriculum/create', [
            'name' => 'John Doe',
            'email' => 'pBc9d@example.com',
            'position' => 'Software Engineer',
            'education' => 'Bachelor of Science in Computer Science',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file_name' => 'curriculum.pdf',
            'file_path' => 'storage/curriculum.pdf',
        ]);

        $response->assertStatus(422);
    }

    public function test_cannot_create_curriculum_without_position() {
        $response = $this->post('/api/curriculum/create', [
            'name' => 'John Doe',
            'email' => 'pBc9d@example.com',
            'phone' => '1234567890',
            'education' => 'Bachelor of Science in Computer Science',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file_name' => 'curriculum.pdf',
            'file_path' => 'storage/curriculum.pdf',
        ]);

        $response->assertStatus(422);
    }

    public function test_cannot_create_curriculum_without_education() {
        $response = $this->post('/api/curriculum/create', [
            'name' => 'John Doe',
            'email' => 'pBc9d@example.com',
            'phone' => '1234567890',
            'position' => 'Software Engineer',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file_name' => 'curriculum.pdf',
            'file_path' => 'storage/curriculum.pdf',
        ]);

        $response->assertStatus(422);
    }

    public function test_cannot_create_curriculum_without_file() {
        $response = $this->post('/api/curriculum/create', [
            'name' => 'John Doe',
            'email' => 'pBc9d@example.com',
            'phone' => '1234567890',
            'position' => 'Software Engineer',
            'education' => 'Bachelor of Science in Computer Science',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        ]);

        $response->assertStatus(422);
    }
}