<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name','description','url'];

    /**
     *relationship of polymorphic ivot
    */
    public function types()
    {
        return $this->morphToMany(ProductType::class, 'type_assignment', 'type_assignments', 'type_assignment_id', 'type_id');
    }
}
