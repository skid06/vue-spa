<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }
}
