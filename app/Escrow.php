<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Escrow extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected $dates = [''];

    protected $table = "escrows";

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function creator()
    {
        return $this->belongsTo('App\User','creator_id','id');
    }


    public function mileStones()
    {
        return $this->hasMany('App\Milestone','escrow_id')->latest();
    }
}
