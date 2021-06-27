<?php

namespace App\Repository;

use App\Data\ContactDTO;

interface ContactRepositoryInterface
{
    public function add(ContactDTO $item);

    public function findAll(): \Generator;

    public function findOne(int $id);

    public function edit(ContactDTO $item);

    public function delete(int $id);
}