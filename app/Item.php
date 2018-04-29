<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Item extends Model
{
	public function ratings()
    {
    	return $this->hasMany(Rating::class, 'item_id', 'item_id');
    }

    protected $guarded = [];

    public function scopeSearch($query, $filters)
    {
        if (isset($filters['result']) ? $filters['result'] : '') {
        	$result = $filters['result'];
            $query->where('item_id','LIKE','%'.$result.'%')
                    ->orWhere('title','LIKE','%'.$result.'%');
        }
    }

    public function StoreOrUpdateRating($request, $item, $rating)
    {
        if(\App\Rating::where('user_id', Auth::user()->user_id)->where('item_id', $item->item_id)->exists())
        {
            $rating_rec = \App\Rating::where('user_id', Auth::user()->user_id)
                    ->where('item_id', $item->item_id)
                    ->first()
                    ->update(['rating' => $rating]);
        }
        else
        {
            $rating_rec = new \App\Rating;
            $rating_rec->user_id = Auth::user()->user_id;
            $rating_rec->item_id = $item->item_id;
            $rating_rec->rating = $rating;
            $rating_rec->save();
        }
    }
}
