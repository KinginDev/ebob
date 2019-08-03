<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Milestone extends Model
{
    use SoftDeletes;
    protected  $guarded = [];

    protected  $table = "milestones";


    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function creator()
    {
        return $this->belongsTo('App\User','creator_id','id');
    }

    public function escrow()
    {
        return $this->belongsTo('App\Escrow','escrow_id','id');
    }

}
