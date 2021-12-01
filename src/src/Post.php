<?php

namespace edwardyi\Press;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    /**
     * extra fields
     */
    public function extra($field)
    {
        return optional(json_decode($this->extra))->$field;
    }
}