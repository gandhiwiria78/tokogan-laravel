<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Chating extends Model
{
    //
    use Notifiable,HasApiTokens;
    protected $table = 'chating';
    protected $fillable = ['message','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
