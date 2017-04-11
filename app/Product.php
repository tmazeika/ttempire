<?php

namespace TTEmpire;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo('TTEmpire\Category');
    }

    public function subQuantities()
    {
        return $this->hasMany('TTEmpire\SubQuantity');
    }

    public function getImgAsset()
    {
        return asset("img/$this->id.jpg");
    }

    public function getCheapestSubQuantity()
    {
        return $this->subQuantities->sortBy('usd_price')->first();
    }

    public function getOnlySubQuantityPrice()
    {
        return $this->subQuantities->first()->usd_price;
    }

    public function hasMultipleSubQuantities()
    {
        return $this->subQuantities->count() > 1;
    }
}
