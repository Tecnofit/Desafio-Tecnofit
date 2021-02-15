<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_instructors_cant_see_the_customers_list()
    {
        $this->get('/customers')->assertRedirect('/login');
        $this->get('/customers/create')->assertRedirect('/login');
        $this->post('/customers')->assertRedirect('/login');
    }

    /** @test */
    public function only_authenticated_instructors_can_read_all_customers_list()
    {
        $this->actingAs($this->instructor)
            ->get(route('customers.index'))
            ->assertViewHas(['users'])
            ->assertStatus(200);
    }

    /** @test */
    public function an_authenticated_instructor_can_create_new_customer()
    {
        $user = factory(User::class)->make();
        $this->actingAs($this->instructor)->post(route('customers.store'), $user->toArray())
            ->assertStatus(302);
    }

    /** @test */
    public function it_errors_when_trying_to_create_a_customer_without_any_data()
    {
        $this->actingAs($this->instructor)
            ->post(route('customers.store'), array())
            ->assertStatus(302)
            ->assertSessionHas(['errors']);
    }

    /** @test */
    public function it_errors_when_the_email_is_already_taken()
    {
        $user = factory(User::class)->create(['email' => 'customer@email.com']);
        $this->actingAs($this->instructor)
            ->post(route('customers.store'), $user->toArray())
            ->assertStatus(302)
            ->assertSessionHas(['errors']);
    }

    /** @test */
    public function an_authenticated_instructor_can_update_a_customer()
    {
        $fake = factory(User::class)->make();
        $this->actingAs($this->instructor)->put(route('customers.update', $this->customer->id, $fake->toArray()))
            ->assertStatus(302);
    }

    /** @test */
    public function it_errors_when_trying_to_update_a_customer_without_data()
    {
        $this->actingAs($this->instructor)->put(route('customers.update', $this->customer->id, array()))
            ->assertStatus(302);
    }

    /** @test */
    public function an_authenticated_instructor_can_delete_a_customer()
    {
        $this->actingAs($this->instructor)->delete(route('customers.destroy', $this->customer->id))
            ->assertStatus(302)
            ->assertRedirect('customers');
    }
}
