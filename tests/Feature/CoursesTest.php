<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Course;
use App\Models\User;

class CoursesTest extends TestCase
{
    use RefreshDatabase;

    public function test_courses_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/cursos');

        $response->assertStatus(200);
    }

    public function test_courses_create()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/cursos/create');

        $response->assertStatus(200);
    }

    public function test_create_course()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/cursos', [
            'name' => 'Curso de Laravel',
            'stage' => 'Iniciante',
            'description' => 'Curso de Laravel para iniciantes',
            'visible' => 1
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'name' => 'Curso de Laravel',
            'stage' => 'Iniciante',
            'description' => 'Curso de Laravel para iniciantes',
            'visible' => 1
        ]);
    }

}