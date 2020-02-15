<?php

namespace Tests\Feature;

use App\Author;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_author_has_been_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/authors', [
            'name' => 'Test author name',
            'dob' => '07/07/1978'
        ]);

        $author = Author::all();

        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1978/07/07', $author->first()->dob->format('Y/d/m'));
    }
}
