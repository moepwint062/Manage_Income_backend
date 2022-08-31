<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishes extends Model
{
    use HasFactory;
    protected $fillable = [
        'item',
        'price'
    ];

    public static function boot()
    {
        parent::boot();
    }
}
