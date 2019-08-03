<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CCard extends Model
{
	protected $table = 'c_cards';
	protected $fillable = ['amount','user_id', 'ref', 'name', 'cvv','card_no','street','state','city','zipcode','ip','exp_date'];
    public function user()
	{
		return $this->belongsTo('App\User');
	}
}
