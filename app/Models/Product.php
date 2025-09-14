<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','description','product_color_id','product_category_id'];

    public function color()
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function types()
    {
        return $this->morphToMany(ProductType::class, 'type_assignment', 'type_assignments', 'type_assignment_id', 'type_id');
    }

}
