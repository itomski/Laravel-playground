<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'registration', 'brand', 'type', 'description', 'status', 'file'
    ];

    // Hier können Casts für Attribute festgelegt werden
    // Die Casts werden automatisch beim Belegn des Objekts vorgenommen
    protected $casts = [
        // 'brand' => 'int'
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
