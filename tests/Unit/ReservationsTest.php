<?php

namespace Tests\Unit;

use App\Book;
use App\Reservation;
use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_checked_out()
    {
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();

        $book->checkout($user);

        $this->assertCount(1, Reservation::all());
        $this->assertEquals($user->id, Reservation::first()->user_id);
        $this->assertEquals($book->id, Reservation::first()->book_id);
        $this->assertEquals(now(), Reservation::first()->checked_out_at);
    }

    /** @test */
    public function a_book_can_be_returned()
    {
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();

        // Checkout the book before it's returned
        $book->checkout($user);

        $book->checkin($user);

        $this->assertCount(1, Reservation::all());
        $this->assertEquals($user->id, Reservation::first()->user_id);
        $this->assertEquals($book->id, Reservation::first()->book_id);
        $this->assertEquals(now(), Reservation::first()->checked_in_at);
    }

    /** @test */
    public function if_not_checked_out_an_exception_is_thrown()
    {
        $this->expectException(\Exception::class);

        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();

        $book->checkin($user);
    }

    /** @test */
    public function a_user_can_checkout_a_book_twice()
    {
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();

        $book->checkout($user);
        $book->checkin($user);
        $book->checkout($user);

        $this->assertCount(2, Reservation::all());

        // Get las inserted reservation id
        $reservations = Reservation::all();
        $lastReservationId = $reservations->last()->id;

        $this->assertEquals($user->id, Reservation::find($lastReservationId)->user_id);
        $this->assertEquals($book->id, Reservation::find($lastReservationId)->book_id);
        $this->assertNull(Reservation::find($lastReservationId)->checked_in_at);
        $this->assertEquals(now(), Reservation::find($lastReservationId)->checked_out_at);

        $book->checkin($user);

        $this->assertCount(2, Reservation::all());
        $this->assertEquals($user->id, Reservation::find($lastReservationId)->user_id);
        $this->assertEquals($book->id, Reservation::find($lastReservationId)->book_id);
        $this->assertNotNull(Reservation::find($lastReservationId)->checked_in_at);
        $this->assertEquals(now(), Reservation::find($lastReservationId)->checked_in_at);

    }
}
