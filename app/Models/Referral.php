<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'promoter_id',
        'location',
        'ip_address',
        'device',
        'name',
        'email',
        'country',
        'whatsapp',
        'age',
        'profession',
        'gender',
        'proof',
        'telegram',
        'payment_code',
        'completed',
    ];

    public function promoter(){
        return $this->belongsTo(User::class, 'promoter_id');
    }
}
