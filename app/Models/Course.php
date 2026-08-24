<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    
    protected $fillable = [
        'course_code',
        'name',
        'image',
        'price',
        'discount',
        'tax',
        'offline_price',
        'offline_discount',
        'offline_tax',
        'non_regular_price',
        'non_regular_discount',
        'non_regular_tax',
        'private_price',
        'private_discount',
        'private_tax',
        'is_active',
        'for_class',
    ];

    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'trainer_course');
    }

}
