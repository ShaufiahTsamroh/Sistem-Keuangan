<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Kolom yang boleh diisi
    protected $fillable = ['name', 'type'];
}