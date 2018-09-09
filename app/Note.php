<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function task(){
        return $this->belongsTo(Task::class); 
    }
}
