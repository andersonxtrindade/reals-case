<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'date',
        'affiliates_id',
    ];

    
    public function affiliate()
    {
        return $this->belongsTo(Affiliates::class);
    }

}
