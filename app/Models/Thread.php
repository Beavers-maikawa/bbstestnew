<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'title',
        'content',
    ];
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
