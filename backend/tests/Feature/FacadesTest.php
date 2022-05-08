<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadesTest extends TestCase
{
  public function testConfig() {
    $firstName = config("contoh.author.fist");
    $firstName2 = Config::get("contoh.author.fist");

    self::assertEquals($firstName, $firstName2);
    var_dump($firstName);
  }

  public function test_example()
  {
    $response = $this->get('/');

    $response->assertStatus(200);
  }
}
