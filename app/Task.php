<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'status',
        'contact_name',
        'contact_phone',
        'website',
        'cost'
    ];
    
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }
}
