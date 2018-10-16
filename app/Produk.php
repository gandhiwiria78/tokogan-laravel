<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Produk extends Model
{
    use Notifiable,HasApiTokens;
    protected $table = 'produk';
    public $timestamps = false;
    protected $fillable = [
        'id_produk', 'id_kategori'
    ];
}
