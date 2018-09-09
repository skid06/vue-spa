<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];
    
    public function notes(){
        return $this->hasMany(Note::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
