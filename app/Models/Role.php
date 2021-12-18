<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
