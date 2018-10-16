<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use Notifiable,HasApiTokens;
    protected $table = 'galery';
    public $timestamps = false;
    //
    protected $fillable = [
        'title', 'deskripsi', 'path',
    ];
}
