<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CurriculumTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_curriculum() {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('curriculo.pdf', 1024);

        $response = $this->post('/api/curriculum/create', [
            'name' => 'John Doe',
            'email' => 'pBc9d@example.com',
            'phone' => '1234567890',
            'position' => 'Software Engineer',
            'education' => 'Ensino Médio',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file' => $file,
        ]);

        $response->assertStatus(201)->assertJsonStructure([
            'message',
            'curriculum' => [
                'id',
                'name',
                'email',
            ]
        ]);
    }

    public function test_cannot_create_curriculum_without_name() {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('curriculo.pdf', 1024);

        $response = $this->postJson('/api/curriculum/create', [
            'email' => 'pBc9d@example.com',
            'phone' => '1234567890',
            'position' => 'Software Engineer',
            'education' => 'Ensino Médio',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file' => $file,
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => ['name']
            ]);
    }


    public function test_cannot_create_curriculum_without_email() {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('curriculo.pdf', 1024);

        $response = $this->postJson('/api/curriculum/create', [
            'name' => 'John Doe',
            'phone' => '1234567890',
            'position' => 'Software Engineer',
            'education' => 'Ensino Médio',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file' => $file,
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => ['email']
            ]);
    }

    public function test_cannot_create_curriculum_without_phone() {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('curriculo.pdf', 1024);

        $response = $this->postJson('/api/curriculum/create', [
            'name' => 'John Doe',
            'email' => 'pBc9d@example.com',
            'position' => 'Software Engineer',
            'education' => 'Ensino Médio',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file' => $file,
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => ['phone']
            ]);
    }

    public function test_cannot_create_curriculum_without_position() {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('curriculo.pdf', 1024);

        $response = $this->postJson('/api/curriculum/create', [
            'name' => 'John Doe',
            'email' => 'pBc9d@example.com',
            'phone' => '1234567890',
            'education' => 'Ensino Médio',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file' => $file,
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => ['position']
            ]);
    }

    public function test_cannot_create_curriculum_without_education() {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('curriculo.pdf', 1024);

        $response = $this->postJson('/api/curriculum/create', [
            'name' => 'John Doe',
            'email' => 'pBc9d@example.com',
            'phone' => '1234567890',
            'position' => 'Software Engineer',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file' => $file,
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => ['education']
            ]);
    }

    public function test_cannot_create_curriculum_without_file() {
        $response = $this->postJson('/api/curriculum/create', [
            'name' => 'John Doe',
            'email' => 'pBc9d@example.com',
            'phone' => '1234567890',
            'position' => 'Software Engineer',
            'education' => 'Ensino Médio',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file' => null,
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => ['file']
            ]);
    }

    public function test_cannot_create_curriculum_with_size_file() {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('curriculo.pdf', 2048);

        $response = $this->postJson('/api/curriculum/create', [
            'name' => 'John Doe',
            'email' => 'pBc9d@example.com',
            'phone' => '1234567890',
            'position' => 'Software Engineer',
            'education' => 'Ensino Médio',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file' => $file,
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => ['file']
            ]);
    }

    public function test_cannot_create_curriculum_with_extension_file() {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('curriculo.txt', 1024);

        $response = $this->postJson('/api/curriculum/create', [
            'name' => 'John Doe',
            'email' => 'pBc9d@example.com',
            'phone' => '1234567890',
            'position' => 'Software Engineer',
            'education' => 'Ensino Médio',
            'observations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'file' => $file,
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => ['file']
            ]);
    }
}