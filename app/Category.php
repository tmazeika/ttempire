<?php

namespace TTEmpire;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    {
        return $this->belongsToMany('TTEmpire\Product');
    }
}
