<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //use HasFactory;

    protected $fillable = [
        'start', 'end', 'status', 'customer_id', 'vehicle_id'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
}
