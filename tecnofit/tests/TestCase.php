<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $customer;
    protected $instructor;

    /**
     * Set up the test
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->instructor = factory(User::class)->create(['role' => 'instructor']);
        $this->customer = factory(User::class)->create();
    }
}
