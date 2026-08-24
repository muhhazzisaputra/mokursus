<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Member extends Model
{
    
    protected $fillable = [
        'user_id','member_code','full_name','place_of_birth','date_of_birth','full_address','wa_number','image','is_active','alumni_status','course_id','nik','certificate_number'
    ];

    // Generate unique member code
    public static function generateMemberCode() {
        $date     = now();
        $datePart = $date->format('Ymd');  // 20260524
        $prefix   = 'MK';
        
        // Get the maximum counter for today using raw query
        $lastCounter = DB::table('members')
            ->whereDate('created_at', $date->toDateString())
            ->where('member_code', 'like', $prefix . $datePart . '%')
            ->orderBy('member_code', 'desc')
            ->value(DB::raw("CAST(SUBSTRING(member_code, 11, 3) AS UNSIGNED)"));
        
        $newCounter = $lastCounter ? str_pad($lastCounter + 1, 3, '0', STR_PAD_LEFT) : '001';
        
        return $prefix . $datePart . $newCounter;
    }

}
