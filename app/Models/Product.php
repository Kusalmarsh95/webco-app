<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','description','product_color_id','product_category_id'];

    /**
     *relationship of colors
    */
    public function color() {
    return $this->belongsTo(ProductColor::class, 'product_color_id');
}

    /**
     *relationship of category
    */
    public function category() {
    return $this->belongsTo(ProductCategory::class, 'product_category_id');
}

    /**
     *relationship of polymorphic ivot
    */
    public function types()
    {
        return $this->morphToMany(ProductType::class, 'type_assignment', 'type_assignments', 'type_assignment_id', 'type_id');
    }

}
