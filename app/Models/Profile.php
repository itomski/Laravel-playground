<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'street',
        'street_nr',
        'city',
        'zip',
    ];

    public function user() {
        $this->belongsTo(User::class);
    }
}
