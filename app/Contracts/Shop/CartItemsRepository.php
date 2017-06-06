<?php

/**
 * Cart item repository interface
 * User: kutas
 * Date: 6/6/17
 * Time: 2:01 AM
 */

namespace App\Contracts\Shop;

interface CartItemsRepository
{
    public function addItem( $data);

    public function removeItem( $id );

    public function countItems(): int;

    public function removeAll();

    public function getAll():array;
}