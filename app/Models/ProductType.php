<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = ['name','api_unique_number'];

    /**
     *relationship for polymorphic pivot
    */
    public function products()
    {
        return $this->morphedByMany(Product::class, 'type_assignment', 'type_assignments', 'type_id', 'type_assignment_id');
    }

    public function categories()
    {
        return $this->morphedByMany(ProductCategory::class, 'type_assignment', 'type_assignments', 'type_id', 'type_assignment_id');
    }
}
