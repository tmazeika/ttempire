<?php

namespace TTEmpire;

use Illuminate\Database\Eloquent\Model;

class SubQuantity extends Model
{
    public function product()
    {
        return $this->belongsTo('TTEmpire\Product');
    }
}
