<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'birthdate',
        'street',
        'street_nr',
        'city',
        'zip',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
