<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_api()
    {
        $response = $this->get('/api');

        $response->assertStatus(200);
    }
}
