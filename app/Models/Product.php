<?php

namespace App\Models;

use App\Models\Classes\BaseModel;

class Product extends BaseModel
{
    protected $table = "product";

    /**
     * get name of product.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
