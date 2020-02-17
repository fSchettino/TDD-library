<?php

namespace Tests\Feature;

use App\Author;
use App\Book;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $response = $this->post('/books', $this->data());

        $book = Book::first();

        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());
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
        $response = $this->post('/books', array_merge($this->data(), [ 'author_id' => '' ]));

        $response->assertSessionHasErrors('author_id');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        // First: insert a record
        $this->post('/books', $this->data());

        $book = Book::first();

        // Second: update inserted record
        $response = $this->put($book->path(), array_merge($this->data(), [ 'title' => 'Updated test book title' ]));

        $this->assertEquals('Updated test book title', Book::first()->title);
        //$this->assertEquals(6, Book::first()->author_id);

        // Fresh method reload updated $book record from database
        $response->assertRedirect($book->fresh()->path());
    }

    /** @test */
    public function a_book_can_be_deleted()
    {
        // First: insert a record
        $this->post('/books', $this->data());

        $book = Book::first();
        $this->assertCount(1, Book::all());

        // Second: update inserted record
        $response = $this->delete($book->path());
        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');
    }

    /** @test */
    public function a_new_author_is_automatically_added()
    {
        // First: insert a record
        $this->post('/books', $this->data());

        $book = Book::first();
        $author = Author::first();

        $this->assertEquals($author->id, $book->author_id);
        $this->assertCount(1, Author::all());


    }

    private function data()
    {
        return [
            'title' => 'Test book title',
            'author_id' => 1
        ];
    }
}
