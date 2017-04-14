<?php

namespace TTEmpire;

use Illuminate\Database\Eloquent\Model;

class SubQuantity extends Model
{
    public function product()
    {
        return $this->belongsTo('TTEmpire\Product');
    }

    public function unitUsdPrice()
    {
        return number_format((float)$this->usd_price / $this->quantity / 100.0, 3);
    }

    public function unitEurPrice()
    {
        return number_format((float)$this->eur_price / $this->quantity / 100.0, 3);
    }
}
