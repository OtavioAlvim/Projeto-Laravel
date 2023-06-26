<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $casts = [
        'items' => 'array'
    ];
    protected $dates = ['date'];
    protected $guarded = [];
    // vamos dizer que pra cada evento ha um usuario
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    // vamos dizer que o evento tem muitos usuarios
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
