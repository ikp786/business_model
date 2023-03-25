<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchImage extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'image_name'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
