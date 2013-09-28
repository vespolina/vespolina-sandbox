<?php

namespace Domain\Model;

use Domain\Model\Book;

interface BookInventory
{
    public function save(Book $book);
    public function findBy(array $criteria = []);
}