<?php
/**
 * Created by PhpStorm.
 * User: kutas
 * Date: 5/16/17
 * Time: 8:35 PM
 */

namespace Tests\Helpers\Traits;


trait UrlCreator
{

    public function url($action)
    {
        return isset($this->baseUrl) ? $this->baseUrl . $action : $action;
    }
}