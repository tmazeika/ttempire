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
}
