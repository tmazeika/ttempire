<?php

namespace TTEmpire;

use Illuminate\Database\Eloquent\Model;

class SubQuantity extends Model
{
    public function product()
    {
        return $this->belongsTo('TTEmpire\Product');
    }

    public function usdPrice(int $count = 1)
    {
        return '$' . number_format($this->usd_price * $count / 100.0, 0);
    }

    public function eurPrice(int $count = 1)
    {
        return '€' . number_format($this->eur_price * $count / 100.0, 0);
    }

    public function unitUsdPrice()
    {
        return '$' . number_format((float)$this->usd_price / $this->quantity / 100.0, 3);
    }

    public function unitEurPrice()
    {
        return '€' . number_format((float)$this->eur_price / $this->quantity / 100.0, 3);
    }
}
