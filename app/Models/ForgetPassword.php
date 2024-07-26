<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgetPassword extends Model
{
    use HasFactory;

    protected $table = 'forget_password';

    protected $fillable = [
        'email',
        'forget_token',
    ];

    // If forget_token is not an integer, you may use $casts to convert it.
    protected $casts = [
        'forget_token' => 'integer',
    ];
}
