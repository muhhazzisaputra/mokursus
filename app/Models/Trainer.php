<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    
    protected $fillable = ['card_id','name','address','email','wa_number','fee_reguler', 'fee_non_reguler', 'fee_online', 'fee_privat','gender','place_of_birth','date_of_birth','date_of_entry','ktp_number','is_active','photo','agree_contract','user_id'];

    public static function generateCardId()
    {
        $prefix    = 'PTC';
        $month     = now()->format('m');  // 06
        $year      = now()->format('Y');  // 2026
        $monthYear = $month . $year;      // 062026
        
        // Format pencarian: PTC-%-062026
        $searchPattern = $prefix . '-%' . '-' . $monthYear;
        
        // Ambil data terakhir berdasarkan created_at untuk bulan ini
        $lastEmployee = self::where('card_id', 'like', $searchPattern)
                           ->orderBy('created_at', 'desc')
                           ->first();
        
        if ($lastEmployee) {
            // Extract counter dari kode terakhir
            // Contoh: PTC-05-062026 -> ambil "05"
            $parts = explode('-', $lastEmployee->card_id);
            // $parts[0] = PTC, $parts[1] = 05, $parts[2] = 062026
            $lastCounter = isset($parts[1]) ? intval($parts[1]) : 0;
            $newCounter = str_pad($lastCounter + 1, 2, '0', STR_PAD_LEFT);
        } else {
            // Mulai counter dari 01
            $newCounter = '01';
        }
        
        // Generate kode lengkap: PTC-01-062026
        return $prefix . '-' . $newCounter . '-' . $monthYear;
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'trainer_course');
    }

}
