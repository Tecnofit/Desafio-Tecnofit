<?php

namespace Tests\Feature;

use App\Models\Training;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WorkoutTest extends TestCase
{
    use RefreshDatabase;

    // $response->dump();

    /** @test */
    public function unauthenticated_customer_cant_access_own_training()
    {
        $this->get('/workout')->assertRedirect('/login');
    }

    /** @test */
    public function it_can_show_the_customer_workout_page()
    {
        $this->actingAs($this->customer)
            ->get(route('workout'))
            ->assertSuccessful();
    }

    /** @test */
    public function an_authenticated_customer_can_skip_an_exercise()
    {
        $id = factory(Training::class)->create()->id;
        $this->actingAs($this->customer)
            ->post(route('workout.skip'), ['id' => $id])
            ->assertStatus(302)
            ->assertRedirect('workout');
    }

    /** @test */
    public function a_skip_requires_id()
    {
        $this->actingAs($this->customer)
            ->post(route('workout.skip'), ['id' => ''])
            ->assertStatus(302)
            ->assertSessionHas(['errors']);
    }

    /** @test */
    public function an_authenticated_customer_can_complete_an_exercise()
    {
        $id = factory(Training::class)->create()->id;
        $this->actingAs($this->customer)
            ->post(route('workout.completed'), ['id' => $id])
            ->assertStatus(302)
            ->assertRedirect('workout');
    }

    /** @test */
    public function a_complete_requires_id()
    {
        $this->actingAs($this->customer)
            ->post(route('workout.completed'), ['id' => ''])
            ->assertStatus(302)
            ->assertSessionHas(['errors']);
    }
}
