<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    protected $fillable = [
    'user_id',
    'amount',
    'description',
    'status',
    'date',
];
}
