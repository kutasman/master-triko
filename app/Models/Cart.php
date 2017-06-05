<?php

namespace App\Models;


use App\Models\Contracts\CartInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Session;
use Cache;

class Cart implements CartInterface {

    const CART_PREFIX = 'cart_';
    protected $id;
    protected $items;

    public function __construct()
    {
        $this->id = Session::getId();

        $this->items = Session::get($this->id());

    }

    public function addItem($data)
    {
        Session::push($this->id(), $data);

    }

    public function removeItem($id)
    {
        // TODO: Implement removeItem() method.
    }

    public function countItems(): int
    {
        return count(Session::get($this->id()));
    }

    public function removeAll()
    {
        // TODO: Implement removeAll() method.
    }

    public function getAll(): array 
    {
        return $this->items;
    }

    public function hasItems(): bool
    {
        return !! $this->countItems();
    }


    protected function id(){
        return self::CART_PREFIX . $this->id;
    }


}
