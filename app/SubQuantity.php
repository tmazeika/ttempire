<?php

namespace TTEmpire;

use Illuminate\Database\Eloquent\Model;

class SubQuantity extends Model
{
    public function product()
    {
        return $this->belongsTo('TTEmpire\Product');
    }

    public function quantity()
    {
        return number_format($this->quantity, 0);
    }
}
