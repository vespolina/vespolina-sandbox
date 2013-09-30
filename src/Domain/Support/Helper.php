<?php

namespace Domain\Support;

use Domain\Model\Book;
use Domain\Model\InMemoryBookInventory;
use Dough\Money\Money;

class Helper
{
    protected $bookInventory;

    public function loadUseCases()
    {
        $this->bookInventory = new InMemoryBookInventory();
    }

    public function createTheRequestForTheSpecificBook()
    {
        $bookRequest = ['bookId' => 123];

        return $bookRequest;
    }

    public function findBookInformation($bookRequest)
    {
        $id = $bookRequest['bookId'];
        $books = $this->bookInventory->findBy(['id' => $id]);

        return [
            'id' => $id,
            'amount' => reset($books)->getPrice(),
            'quantity' => 1
        ];
    }

    public function persistBookSampleOnInventoryWithId($id)
    {
        $book = new Book();
        $book->setId($id);
        $book->setPrice(new Money(12));
        $this->bookInventory->save($book);
    }

    public function redirectsCustomerToThirdPartyForPayment()
    {


        return RedirectResponse('https://sandbox.paypal.com');
    }
}
