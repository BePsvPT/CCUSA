<?php

namespace App\Core;

use Eloquent;
use Hashids;

class Entity extends Eloquent
{
    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 10;

    /**
     * Get the table name of this model.
     *
     * @return string
     */
    public static function getTableName()
    {
        return (new static)->getTable();
    }

    /**
     * Get the hashid of the attachment.
     *
     * @return string mixed
     */
    public function getHashId()
    {
        return Hashids::encode($this->getKey());
    }
}
