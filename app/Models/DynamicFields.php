<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicFields extends Model
{
    protected $fillable = [
        'subcategory_id',
        'name',
        'type'];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
}
