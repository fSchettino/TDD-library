<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Test book title',
            'author' => 'Test author name'
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function book_title_is_required()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Test author name'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function book_author_is_required()
    {
        $response = $this->post('/books', [
            'title' => 'Test book title',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

        // First: insert a record
        $this->post('/books', [
            'title' => 'Test book title',
            'author' => 'Test author name'
        ]);

        $book = Book::first();

        // Second: update inserted record
        $this->put('/books/' . $book->id, [
            'title' => 'Updated test book title',
            'author' => 'Updated test author name'
        ]);

        $this->assertEquals('Updated test book title', Book::first()->title);
        $this->assertEquals('Updated test author name', Book::first()->author);
    }
}
