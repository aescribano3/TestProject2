<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Resources;
use App\Models\User;

class ResourcesTest extends TestCase
{
    use RefreshDatabase;


    public function test_resources_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/recursos');

        $response->assertStatus(200);
    }

    public function test_resources_create()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/recursos/create');

        $response->assertStatus(200);
    }

    public function test_create_resource()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/recursos', [
            'title' => 'Recurso de Laravel',
            'content' => 'Recurso de Laravel para iniciantes',
            'courseId' => 1,
            'visible' => 1
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'title' => 'Recurso de Laravel',
            'content' => 'Recurso de Laravel para iniciantes',
            'courseId' => 1,
            'visible' => 1
        ]);
    }

}