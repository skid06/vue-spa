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
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }

    public function latestNote(){
        return $this->hasMany(Note::class)->orderBy('created_at', 'DESC')->first();
    }    
}
