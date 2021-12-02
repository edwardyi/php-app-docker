<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // Guarded
    protected $guarded = [];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
