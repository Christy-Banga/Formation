<?php

namespace App\Models;

use App\Models\User;
use App\Models\Episode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;

class Formation extends Model
{
    use HasFactory;
    use Authorizable;

    protected $fillable = ['title','description','user_id'];

    protected $appends = ['update'];

   /*  public static function boot()
    {
        parent::boot();

        self::creating(function($formation){
            $formation->user()->associate(auth()->user()->id);
        });
    } */

    public function getUpdateAttribute()
    {
        return $this->can('update-formation',$this);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
