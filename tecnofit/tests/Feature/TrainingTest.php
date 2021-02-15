<?php

namespace Tests\Feature;

use App\Models\Exercise;
use App\Models\Training;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrainingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_instructors_cant_see_the_trainings_list()
    {
        $this->get('/trainings')->assertRedirect('/login');
        $this->get('/trainings/create')->assertRedirect('/login');
        $this->post('/trainings')->assertRedirect('/login');
    }

    /** @test */
    public function only_authenticated_instructors_can_read_all_trainings_list()
    {
        $this->actingAs($this->instructor)
            ->get(route('trainings.index'))
            ->assertViewHas(['trainings'])
            ->assertStatus(200);
    }

    /** @test */
    public function an_authenticated_instructor_can_create_a_new_training()
    {
        $training = factory(Training::class)->make();
        $this->actingAs($this->instructor)->post(route('trainings.store'), $training->toArray())
            ->assertStatus(302);
    }

    /** @test */
    public function it_errors_when_trying_to_create_a_training_without_any_data()
    {
        $this->actingAs($this->instructor)
            ->post(route('trainings.store'), array())
            ->assertStatus(302)
            ->assertSessionHas(['errors']);
    }

    /** @test */
    public function an_authenticated_instructor_can_update_an_training()
    {
        $old = factory(Training::class)->create();
        $new = factory(Training::class)->make();
        $this->actingAs($this->instructor)->put(route('trainings.update', $old->id, $new->toArray()))
            ->assertStatus(302);
    }

    /** @test */
    public function it_errors_when_trying_to_update_a_training_without_data()
    {
        $old = factory(Training::class)->create();
        $this->actingAs($this->instructor)->put(route('trainings.update', $old->id, array()))
            ->assertStatus(302);
    }

    /** @test */
    public function an_authenticated_instructor_can_handle_active_or_disable_a_training()
    {
        $training = factory(Training::class)->create();
        $this->actingAs($this->instructor)->post(route('trainings.handleActive'), ['user_id' => $training->user_id, 'active' => true])
            ->assertStatus(302);
    }

    /** @test */
    public function it_errors_when_trying_to_handle_active_or_disable_without_params()
    {
        $this->actingAs($this->instructor)->post(route('trainings.handleActive'), [])
            ->assertStatus(302);
    }
}
