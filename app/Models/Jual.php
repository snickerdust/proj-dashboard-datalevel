<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jual extends Model
{
    use HasFactory;

    protected $table = 'jual';

    protected $primarykey = null;
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'Province',
        'Currency',
        'Month',
        'Value',
        'Bi_rate',
    ];
}
