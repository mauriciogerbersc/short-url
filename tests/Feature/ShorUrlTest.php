<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShorUrlTest extends TestCase
{
    /** @test */
    public function only_logged_user_can_see_shorturls()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
}
