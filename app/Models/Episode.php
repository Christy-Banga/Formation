<?php

namespace App\Models;

use App\Models\Formation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
