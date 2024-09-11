<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beli extends Model
{
    use HasFactory;
    
    protected $table = 'beli';
    protected $fillable = [
        'Province',
        'Currency',
        'Month',
        'Value',
        'Bi_rate',
    ];
}
