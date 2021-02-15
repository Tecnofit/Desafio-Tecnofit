<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_show_the_login_form()
    {
        $this->get(route('login'))->assertStatus(200);
    }

    /** @test */
    public function it_shows_the_dashboard_after_success_instructor_login()
    {
        $this->post(route('login'), ['email' => $this->instructor->email, 'password' => 'password'])
            ->assertStatus(302)
            ->assertRedirect('dashboard');
    }

    /** @test */
    public function it_shows_the_workout_after_success_customer_login()
    {
        $this->post(route('login'), ['email' => $this->customer->email, 'password' => 'password'])
            ->assertStatus(302)
            ->assertRedirect('workout');
    }

    /** @test */
    public function it_errors_when_trying_to_login_without_credentials()
    {
        $this
            ->post('login', [])
            ->assertSessionHasErrors([
                'email' => 'The email field is required.',
                'password' => 'The password field is required.'
            ]);
    }
}
