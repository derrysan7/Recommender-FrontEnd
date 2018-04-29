<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
	protected $guarded = [];
	
    public function item()
    {
    	return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
