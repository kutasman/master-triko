<?php

namespace App\Models;


use App\Contracts\Shop\Cart as CartInterface;
use App\Contracts\Shop\CartItemsRepository;

class Cart implements CartInterface {

    protected $itemsRepository;

    public function __construct(CartItemsRepository $cartItemsRepository)
    {

        $this->itemsRepository = $cartItemsRepository;

    }

    public function addItem($data)
    {
        $this->itemsRepository->addItem($data);

    }

    public function removeItem($id)
    {
        // TODO: Implement removeItem() method.
    }

    public function countItems(): int
    {
        return $this->itemsRepository->countItems();
    }

    public function removeAll()
    {
        // TODO: Implement removeAll() method.
    }

    public function getAll(): array
    {
        return $this->itemsRepository->getAll();
    }

    public function hasItems(): bool
    {
        return !! $this->itemsRepository->countItems();
    }

}
