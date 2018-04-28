@extends('layouts.app')

@section('content')
<main role="main">
    <section class="jumbotron text-left" style="background-color: #fff;">
        <div class="container">
            <h1 class="jumbotron-heading">All Items</h1>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach($items as $item)
                    <div class="col-md-3">
                        <div class="card mb-3 box-shadow">
                            <img class="card-img-top" src="{{ $item->img_url }}">
                            <div class="card-body">
                                <p class="card-text">
                                    <a href="/items/detail/{{ $item->id }}">{{ $item->title }}</a><br>
                                    ItemId:{{ $item->item_id }}<br> 
                                    MatId:{{ $item->item_mat_id }}
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
            {{ $items->appends($_GET)->links() }}
        </div>
    </div>
</main>
@endsection
