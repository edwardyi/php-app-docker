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

     protected $attributes = [
        'active' => 1
     ];

    public function getActiveAttribute($attribute)
    {
        return $this->getActiveOptions()[$attribute];
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

    public function getActiveOptions()
    {
        return [
            1 => 'Active',
            0 => 'inActive',
            2 => 'inProgressing'
        ];
    }
}
