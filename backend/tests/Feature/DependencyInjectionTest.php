<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DependencyInjectionTest extends TestCase
{

  public function testDependencyInjection()
  {
    $foo = new Foo();
    $bar = new Bar($foo);

    self::assertEquals('Foo and Bar', $bar->bar());
  }

  public function test_example()
  {
    $response = $this->get('/');

    $response->assertStatus(200);
  }
}
