@extends('layouts.app')

@section('content')
<main role="main">
    <section class="jumbotron text-left" style="background-color: #fff;">
        <div class="container">
            <h1 class="jumbotron-heading">{{ $item->title }}</h1>
            <h4>MatId:{{ $item->item_mat_id }}</h4>
            <h4>ItemId:{{ $item->item_id }}</h4>
            <h4>{{ number_format($avg_rating,2) }}&nbsp;From&nbsp;{{ $count_rating }}&nbsp;User&nbsp;Ratings</h4>
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
                @foreach($reccs_complete as $recc)
                    <div class="col-md-2">
                        <div class="card mb-2 box-shadow">
                            <img class="card-img-top" src="{{ $recc->img_url }}">
                            <div class="card-body">
                                <p class="card-text">
                                    <a href="/items/detail/{{ $recc->id }}">{{ $recc->title }}</a><br>
                                    ItemId:{{ $recc->item_id }}<br> 
                                    MatId:{{ $recc->item_mat_id }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-secondary" type="button">1</button>
                                        <button class="btn btn-sm btn-outline-secondary" type="button">2</button>
                                        <button class="btn btn-sm btn-outline-secondary" type="button">3</button>
                                        <button class="btn btn-sm btn-outline-secondary" type="button">4</button>
                                        <button class="btn btn-sm btn-outline-secondary" type="button">5</button>
                                    </div>
                                </div>
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
