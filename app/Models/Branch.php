<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['business_id', 'name'];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function workingHours()
    {
        return $this->hasMany(BranchWorkingHour::class);
    }

    public function images()
    {
        return $this->hasMany(BranchImage::class);
    }
    
}
