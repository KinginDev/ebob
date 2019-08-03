<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trx extends Model
{
    protected $guarded = ['id'];

    public function mining()
    {
        return $this->belongsTo('App\Mining','mining_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
