<?php
/**
 * Created by PhpStorm.
 * User: kutas
 * Date: 6/6/17
 * Time: 2:03 AM
 */

namespace App\Repositories;

use App\Contracts\Shop\CartItemsRepository;
use Illuminate\Contracts\Session\Session;

class SessionCartItemsRepository implements CartItemsRepository
{
    const SESSION_KEY = 'shopping_cart';

    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function addItem($data)
    {
        $this->session->push($this->key(), $data);
    }

    public function removeItem($id)
    {
        // TODO: Implement removeItem() method.
    }

    public function removeAll()
    {
        // TODO: Implement removeAll() method.
    }

    public function getAll(): array
    {
        return $this->session->get($this->key());
    }

    public function countItems(): int
    {
        return count($this->session->get($this->key()));
    }

    public function hasItems(): bool
    {
        return !! $this->countItems();
    }

    protected function key(){
        return self::SESSION_KEY;
    }

}