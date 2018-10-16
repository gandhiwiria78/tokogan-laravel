<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class ProdukDetail extends Model
{
    use Notifiable,HasApiTokens;
    protected $table = 'produk_detail';

    protected $fillable = [
        'nama', 'deskripsi','harga','image'
    ];
}
