<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'firstname', 'lastname', 'email', 'city', 'birthdate', 'active' 
    ];

    protected $casts = [
        'birthdate' => 'datetime', 
        'active' => 'boolean' 
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
