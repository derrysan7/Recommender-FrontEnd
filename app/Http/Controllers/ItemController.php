<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Resources\Item as ItemResource;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Collection;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_api()
    {
        $items = Item::paginate(15);

        return ItemResource::collection($items);
    }

    public function home()
    {
        if (\App\Rating::where('user_id', Auth::user()->user_id)->get()->count())
        {
            $items_array = \App\Rating::where('user_id', Auth::user()->user_id)->get();
            $client = new Client(['base_uri' => 'http://10.0.2.2:5000']);

            $data = array(
                "json" => array()
            );
            foreach($items_array as $item)
            {
                $data['json'][] = array(
                    'ItemMat' => (int)$item->item->item_mat_id,
                    'ItemRating' => (int)$item->rating
                );
            }

            $res = $client->request('POST', '/predict_user', $data);

            $item_reccs = json_decode($res->getBody());

            $reccs_array = [];
            foreach ($item_reccs as $recc) 
            {
                $reccs_array[] = $recc->item_id;
            }

            $reccs_array_imploded = implode(',',array_fill(0, count($reccs_array), '?'));
            $items = Item::whereIn('item_id', $reccs_array)
                            ->where('title','!=','')
                            ->orderByRaw("field(item_id,{$reccs_array_imploded})",$reccs_array)
                            ->paginate(12);
            // $items = Item::where('title','!=','')
            //                 ->paginate(12);

            // foreach ($items as $key => $item) 
            // {
            //     if ($item->title == "")
            //     {
            //         $items->forget($key);
            //     }
            // }

        }

        return view('home', compact('items'));
    }

    public function index()
    {
        $items = Item::search(request(['result']))
            ->paginate(20);

        return view('items.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function search(Request $request)
    {
        $result = $request->txt_search_item;

        return redirect('/items?result='.$result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $client = new Client(['base_uri' => 'http://10.0.2.2:5000']);
        $res = $client->request('POST', '/predict_item', ['json' => ['ItemMat' => $item->item_mat_id]]);

        $item_reccs = json_decode($res->getBody());

        $reccs_array = [];
        foreach($item_reccs as $recc){
            $reccs_array[] = $recc->item_id;
        }
        $reccs_array_imploded = implode(',',array_fill(0, count($reccs_array), '?'));
        $reccs_complete = Item::whereIn('item_id', $reccs_array)
                        ->where('title','!=','')
                        ->orderByRaw("field(item_id,{$reccs_array_imploded})",$reccs_array)
                        ->paginate(12);

        $avg_rating = \App\Rating::where('item_id',$item->item_id)
                            ->avg('rating');

        $count_rating = \App\Rating::where('item_id',$item->item_id)
                            ->count('user_id');

        $user_item_rating = $item->ratings->where('user_id', Auth::user()->user_id)->first();

        return view('items.detail',compact('item', 'avg_rating', 'count_rating', 'reccs_complete', 'user_item_rating'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {     
        if ($request->submit_button == "1")
        {
            $item->StoreOrUpdateRating($request, $item, 1);
        }
        elseif ($request->submit_button == "2")
        {
            $item->StoreOrUpdateRating($request, $item, 2);
        }
        elseif ($request->submit_button == "3")
        {
            $item->StoreOrUpdateRating($request, $item, 3);
        }
        elseif ($request->submit_button == "4")
        {
            $item->StoreOrUpdateRating($request, $item, 4);
        }
        elseif ($request->submit_button == "5")
        {
            $item->StoreOrUpdateRating($request, $item, 5);
        }

        return redirect('/items/detail/'.$item->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    public function my_ratings()
    {
        $items = \App\Rating::where('user_id', Auth::user()->user_id)->paginate(20);

        return view('items.my_ratings',compact('items'));
    }
}
