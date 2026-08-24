<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{

    protected $fillable = [
        'member_id','title','description','technology_used','price','promotional_price','link','image','user_input', 'created_at', 'updated_at'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}
