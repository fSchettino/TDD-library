<?php

namespace Tests\Unit;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_has_an_author_id()
    {
        Book::create([
            'title' => 'Test book title',
            'author_id' => 1
        ]);

        $this->assertCount(1, Book::all());
    }
}
