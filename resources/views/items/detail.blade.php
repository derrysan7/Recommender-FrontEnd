@extends('layouts.app')

@section('content')
<main role="main">
    <section class="jumbotron text-left" style="background-color: #fff;">
        <div class="container">
            <h1 class="jumbotron-heading">{{ $item->title }}</h1>
            <h4>MatId:{{ $item->item_mat_id }}</h4>
            <h4>ItemId:{{ $item->item_id }}</h4>
            <h4>{{ number_format($avg_rating,2) }}&nbsp;From&nbsp;{{ $count_rating }}&nbsp;User&nbsp;Ratings</h4>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <form method="POST" action="/items/update/{{ $item->id }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        @if (isset($user_item_rating->rating))
                            @if ($user_item_rating->rating == 1)
                                <button class="btn btn-sm btn-primary" type="submit" value="1" name="submit_button">1</button>
                            @else
                                <button class="btn btn-sm btn-outline-primary" type="submit" value="1" name="submit_button">1</button>
                            @endif
                            @if ($user_item_rating->rating == 2)
                                <button class="btn btn-sm btn-primary" type="submit" value="2" name="submit_button">2</button>
                            @else
                                <button class="btn btn-sm btn-outline-primary" type="submit" value="2" name="submit_button">2</button>
                            @endif
                            @if ($user_item_rating->rating == 3)
                                <button class="btn btn-sm btn-primary" type="submit" value="3" name="submit_button">3</button>
                            @else
                                <button class="btn btn-sm btn-outline-primary" type="submit" value="3" name="submit_button">3</button>
                            @endif
                            @if ($user_item_rating->rating == 4)
                                <button class="btn btn-sm btn-primary" type="submit" value="4" name="submit_button">4</button>
                            @else
                                <button class="btn btn-sm btn-outline-primary" type="submit" value="4" name="submit_button">4</button>
                            @endif
                            @if ($user_item_rating->rating == 5)
                                <button class="btn btn-sm btn-primary" type="submit" value="5" name="submit_button">5</button>
                            @else
                                <button class="btn btn-sm btn-outline-primary" type="submit" value="5" name="submit_button">5</button>
                            @endif
                        @else
                            <button class="btn btn-sm btn-outline-primary" type="submit" value="1" name="submit_button">1</button>
                            <button class="btn btn-sm btn-outline-primary" type="submit" value="2" name="submit_button">2</button>
                            <button class="btn btn-sm btn-outline-primary" type="submit" value="3" name="submit_button">3</button>
                            <button class="btn btn-sm btn-outline-primary" type="submit" value="4" name="submit_button">4</button>
                            <button class="btn btn-sm btn-outline-primary" type="submit" value="5" name="submit_button">5</button>
                        @endif
                        
                        
                        
                    </form>
                </div>
            </div>
            <br>
            <div class="col-md-3">
                <div class="card mb-3 box-shadow">
                    <img class="card-img-top" src="{{ $item->img_url }}">
                </div>
            </div>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            <h2>People who bought this item also bought</h2>
            <div class="row">
                @foreach($reccs_complete as $item)
                    <div class="col-md-2">
                        <div class="card mb-2 box-shadow">
                            <a href="/items/detail/{{ $item->id }}">
                                <img class="card-img-top" src="{{ $item->img_url }}">
                            </a>
                            <div class="card-body">
                                <p class="card-text">
                                    <a href="/items/detail/{{ $item->id }}">{{ $item->title }}</a><br>
                                    ItemId:{{ $item->item_id }}<br> 
                                    MatId:{{ $item->item_mat_id }}<br>
                                    Rating&nbsp;:&nbsp;{{ number_format($item->ratings->where('item_id',$item->item_id)->avg('rating'), 2) }}
                                            &nbsp;From&nbsp;{{ $item->ratings->where('item_id',$item->item_id)->count('user_id') }}&nbsp;Users
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $reccs_complete->links() }}
        </div>
    </div>
</main>
@endsection
