<?php

namespace App\Models;


use App\Contracts\Shop\Cart as CartInterface;
use App\Contracts\Shop\CartItemsRepository;
use Illuminate\Database\Eloquent\JsonEncodingException;

class Cart  implements  CartInterface {

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

    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * Convert the model instance to JSON.
     *
     * @param  int  $options
     * @return string
     *
     * @throws \Illuminate\Database\Eloquent\JsonEncodingException
     */
    public function toJson($options = 0): string
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw JsonEncodingException::forModel($this, json_last_error_msg());
        }

        return $json;
    }

    /**
     * Collect data for serialization
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->itemsRepository->getAll();
    }

}
