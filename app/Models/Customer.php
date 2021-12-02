<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Guarded Example

    protected $guarded = [];
    // Fillable Example
    /**
    protected $fillable = [
        'name',
        'email'
    ];
     */

    public function getActiveAttribute($attribute)
    {
        return [
            0 => 'active',
            1 => 'inactive'
        ][$attribute];
    }

    public function scopeActive($query)
    {
        return $this->where('active', 1);
    }

    public function scopeInActive($query)
    {
        return $this->where('active', 0);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
