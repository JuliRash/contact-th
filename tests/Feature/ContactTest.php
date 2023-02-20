<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Faker\Generator as Faker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

 
    public function test_with_valid_data(): void
    {
        $faker = \Faker\Factory::create();

        $file = UploadedFile::fake()->image('avatar.png');

        $testData = [
            'name' => $faker->name,
            'email' => $faker->email,
            'attachment' => $file,
            'message' => $faker->paragraph
        ];

        $response = $this->post('/api/contact', $testData, ['Accept' => 'application/json']);

        $response->assertSeeText('contact stored successfully.');

        $response->assertJsonStructure(['success', 'message', 'contact']);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_with_invalid_data(): void
    {
        $testData = [];

        $response = $this->post('/api/contact', $testData, ['Accept' => 'application/json']);

        $response->assertJsonValidationErrors(['name', 'email', 'message', 'attachment']);

        $response->assertUnprocessable();

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_with_invalid_attachment()
    {
        $faker = \Faker\Factory::create();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $testData = [
            'name' => $faker->name,
            'email' => $faker->email,
            'attachment' => $file,
            'message' => $faker->paragraph
        ];

        $response = $this->post('/api/contact', $testData, ['Accept' => 'application/json']);

        $response->assertJsonValidationErrors(['attachment']);

        $response->assertSeeText("The attachment field must be a file of type: png, svg, csv.");

        $response->assertUnprocessable();

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_with_invalid_http_method()
    {
        $response = $this->get('/api/contact', ['Accept' => 'application/json']);

        $response->assertStatus(RESPONSE::HTTP_METHOD_NOT_ALLOWED);
    }
}
