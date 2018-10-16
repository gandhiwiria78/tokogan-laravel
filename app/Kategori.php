<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Kategori extends Model
{
    //
    use Notifiable,HasApiTokens;
    protected $table = 'kategori';
    public $timestamps = false;
    //
    protected $fillable = [
        'judul', 'deskripsi', 'image',
    ];
}
