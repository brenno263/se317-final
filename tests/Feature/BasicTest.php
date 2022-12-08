<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BasicTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_landing_page()
    {
        $res = $this->get(route('landing'));
        $res->assertStatus(200);
    }

    public function test_regristration_page()
    {
        $res = $this->get(route('register'));
        $res->assertStatus(200);
    }

    public function test_login_page()
    {
        $res = $this->get(route('login'));
        $res->assertStatus(200);
    }

    public function test_public_index()
    {
        $res = $this->get(route('images.public-index'));
        $res->assertStatus(200);
    }
}
