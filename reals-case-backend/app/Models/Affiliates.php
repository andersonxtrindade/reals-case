<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Affiliates extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'birth_date',
        'email',
        'number_phone',
        'address',
        'city',
        'state',
        'active',
    ];

    public function commission()
    {
        return $this->hasMany(Commission::class);
    }
}
