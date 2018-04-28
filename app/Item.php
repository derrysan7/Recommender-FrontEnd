<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function scopeSearch($query, $filters)
    {
        if (isset($filters['result']) ? $filters['result'] : '') {
        	$result = $filters['result'];
            $query->where('item_id','LIKE','%'.$result.'%')
                    ->orWhere('title','LIKE','%'.$result.'%');
        }
    }
}
