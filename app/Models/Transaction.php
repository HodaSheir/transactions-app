<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
