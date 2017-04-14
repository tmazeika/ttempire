<?php

namespace TTEmpire;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

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
        return asset("img/products/$this->id.jpg");
    }

    public function getCheapestSubQuantity()
    {
        return $this->subQuantities->sortBy('eur_price')->first();
    }

    public function hasMultipleSubQuantities()
    {
        return $this->subQuantities->count() > 1;
    }
}
