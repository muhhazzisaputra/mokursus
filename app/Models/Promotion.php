<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    
    protected $fillable = [
        'user_id', 'promo_code', 'name', 'start_date', 'end_date', 'promo_type', 'promo_value', 'promo_status', 'approval_date', 'promo_code_hash', 'user_input', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
