<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $fillable = ['title', 'description', 'price', 'period'];
}
