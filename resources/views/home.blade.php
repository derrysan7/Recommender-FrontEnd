@extends('layouts.app')

@section('content')
<main role="main">
    <section class="jumbotron text-left" style="background-color: #fff;">
        <div class="container">
            <h1 class="jumbotron-heading">Home</h1>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @if (isset($items))
                    @forelse($items as $item)
                        <div class="col-md-3">
                            <div class="card mb-3 box-shadow">
                                <a href="/items/detail/{{ $item->id }}">
                                    <img class="card-img-top" src="{{ $item->img_url }}">
                                </a>
                                <div class="card-body">
                                    <p class="card-text">
                                        <a href="/items/detail/{{ $item->id }}">{{ $item->title }}</a><br>
                                        ItemId&nbsp;:&nbsp;{{ $item->item_id }}<br> 
                                        MatId&nbsp;:&nbsp;{{ $item->item_mat_id }}<br>
                                        Rating&nbsp;:&nbsp;{{ number_format($item->ratings->where('item_id',$item->item_id)->avg('rating'), 2) }}
                                                &nbsp;From&nbsp;{{ $item->ratings->where('item_id',$item->item_id)->count('user_id') }}&nbsp;Users
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h4>Rate Item to get Recommendation</h4>
                    @endforelse

                @else
                    <h4>Rate Item to get Recommendation</h4>
                @endif
            </div>
            @if (isset($items))
                {{ $items->links() }}
            @endif
        </div>
    </div>
</main>
@endsection
