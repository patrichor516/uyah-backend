<?php

namespace App\Observers;

use App\Models\Books;

class BooksObserver
{
    public function creating(Books $book)
    {
        $now = date('dmy');
        $lastestBook = Books::latest('id')->first();
        $sequenceNumber = 1;

        if ($lastestBook) {
            $isbnParts = explode('-', $lastestBook->isbn);
            $lastSequenceNumber = (int) end($isbnParts);

            if ($lastSequenceNumber >= $sequenceNumber) {
                $sequenceNumber = $lastSequenceNumber + 1;
            }
        }


        $isbn = 'UYAH' . '-' . $now . '-' . str_pad($sequenceNumber, 6, '0', STR_PAD_LEFT);


        $book->isbn = 'UYAH' . '-' . $now . '-' . $isbn;

        $book->isbn = $isbn;
    }
}
