<?php

namespace Domain\Model;

use Domain\Model\BookInventory;

class InMemoryBookInventory implements BookInventory
{
    protected $books;

    public function save(Book $book)
    {
        $this->books[$book->getId()] = $book;
    }

    public function findBy(array $criteria = [])
    {
        $books = [];

        if (empty($this->books)) {
            return $books;
        }

        foreach ($this->books as $book) {
            if ($this->meetsCriteria($criteria, $book)) {
                $books[] = $book;
            }
        }

        return $books;
    }

    private function meetsCriteria(array $criteria, Book $book)
    {
        $meetsCriteria = true;
        foreach ($criteria as $key => $value) {
            $condition = call_user_func([$book, 'get' . ucfirst($key)]) === $value;
            $meetsCriteria = $meetsCriteria && $condition;
        }

        return $meetsCriteria;
    }
}
