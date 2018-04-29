<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function item()
    {
    	return $this->belongsTo(Item::class);
    }
}
