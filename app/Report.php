<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $table = "reports";


    public function reports()
    {
        return $this->belongsTo('App\Milestone', 'milestone_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'report_from', 'id');
    }



    public function receiver()
    {
        return $this->belongsTo('App\User', 'report_against', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
