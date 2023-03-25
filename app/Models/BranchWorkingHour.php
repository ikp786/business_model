<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchWorkingHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'day',
        'start_time',
        'end_time',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
