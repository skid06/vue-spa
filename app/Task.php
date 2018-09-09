<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
