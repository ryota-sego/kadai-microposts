<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function favorite_users(){
        $this->belongsToMany(Micropost::class, 'favorites', 'micropost_id', 'user_id')->withTimestamps();
    }
}
