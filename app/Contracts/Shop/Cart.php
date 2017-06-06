<?php
/**
 * Created by PhpStorm.
 * User: kutas
 * Date: 6/4/17
 * Time: 11:18 PM
 */

namespace App\Contracts\Shop;


interface Cart
{

    public function addItem( $data);

    public function removeItem( $id );

    public function countItems(): int;

    public function removeAll();

    public function hasItems(): bool;

    public function getAll():array;

}