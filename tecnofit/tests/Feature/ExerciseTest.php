<?php

namespace Tests\Feature;

use App\Models\Exercise;
use App\Models\Training;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExerciseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_instructors_cant_see_the_exercises_list()
    {
        $this->get('/exercises')->assertRedirect('/login');
        $this->get('/exercises/create')->assertRedirect('/login');
        $this->post('/exercises')->assertRedirect('/login');
    }

    /** @test */
    public function only_authenticated_instructors_can_read_all_exercises_list()
    {
        $this->actingAs($this->instructor)
            ->get(route('exercises.index'))
            ->assertViewHas(['exercises'])
            ->assertStatus(200);
    }

    /** @test */
    public function an_authenticated_instructor_can_create_a_new_exercise()
    {
        $exercise = factory(Exercise::class)->make();
        $this->actingAs($this->instructor)->post(route('exercises.store'), $exercise->toArray())
            ->assertStatus(302)
            ->assertRedirect('exercises');
    }

    /** @test */
    public function it_errors_when_trying_to_create_a_exercise_without_any_data()
    {
        $this->actingAs($this->instructor)
            ->post(route('exercises.store'), array())
            ->assertStatus(302)
            ->assertSessionHas(['errors']);
    }

    /** @test */
    public function an_authenticated_instructor_can_update_an_exercise()
    {
        $old = factory(Exercise::class)->create();
        $new = factory(Exercise::class)->make();
        $this->actingAs($this->instructor)->put(route('exercises.update', $old->id, $new->toArray()))
            ->assertStatus(302);
    }

    /** @test */
    public function it_errors_when_trying_to_update_a_exercise_without_data()
    {
        $old = factory(Exercise::class)->create();
        $this->actingAs($this->instructor)->put(route('exercises.update', $old->id, array()))
            ->assertStatus(302);
    }

    /** @test */
    public function an_authenticated_instructor_can_delete_an_inactive_exercise()
    {
        $training = factory(Training::class)->create(['active' => false]);
        $this->actingAs($this->instructor)->delete(route('exercises.destroy', $training->exercise_id))
            ->assertStatus(302)
            ->assertRedirect('exercises');
    }

    /** @test */
    public function it_errors_when_delete_an_active_exercise()
    {
        $training = factory(Training::class)->create(['active' => true]);
        $this->actingAs($this->instructor)->delete(route('exercises.destroy', $training->exercise_id))
            ->assertStatus(302)
            ->assertSessionHas(['error']);
    }
}
