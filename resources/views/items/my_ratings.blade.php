@extends('layouts.app')

@section('content')
<main role="main">
    <section class="jumbotron text-left" style="background-color: #fff;">
        <div class="container">
            <h1 class="jumbotron-heading">My Ratings</h1>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @forelse($items as $item)
                    <div class="col-md-3">
                        <div class="card mb-3 box-shadow">
                            <a href="/items/detail/{{ $item->item->id }}">
                                <img class="card-img-top" src="{{ $item->item->img_url }}">
                            </a>
                            <div class="card-body">
                                <p class="card-text">
                                    <a href="/items/detail/{{ $item->item->id }}">{{ $item->item->title }}</a><br>
                                    ItemId&nbsp;:&nbsp;{{ $item->item->item_id }}<br> 
                                    MatId&nbsp;:&nbsp;{{ $item->item->item_mat_id }}<br>
                                    Rating&nbsp;:&nbsp;{{ number_format($item->where('item_id',$item->item_id)->avg('rating'), 2) }}
                                            &nbsp;From&nbsp;{{ $item->where('item_id',$item->item_id)->count('user_id') }}&nbsp;Users
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <form method="POST" action="/items/update/{{ $item->item->id }}">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                                @if ($item->rating == 1)
                                                    <button class="btn btn-sm btn-primary" type="submit" value="1" name="submit_button">1</button>
                                                @else
                                                    <button class="btn btn-sm btn-outline-primary" type="submit" value="1" name="submit_button">1</button>
                                                @endif
                                                @if ($item->rating == 2)
                                                    <button class="btn btn-sm btn-primary" type="submit" value="2" name="submit_button">2</button>
                                                @else
                                                    <button class="btn btn-sm btn-outline-primary" type="submit" value="2" name="submit_button">2</button>
                                                @endif
                                                @if ($item->rating == 3)
                                                    <button class="btn btn-sm btn-primary" type="submit" value="3" name="submit_button">3</button>
                                                @else
                                                    <button class="btn btn-sm btn-outline-primary" type="submit" value="3" name="submit_button">3</button>
                                                @endif
                                                @if ($item->rating == 4)
                                                    <button class="btn btn-sm btn-primary" type="submit" value="4" name="submit_button">4</button>
                                                @else
                                                    <button class="btn btn-sm btn-outline-primary" type="submit" value="4" name="submit_button">4</button>
                                                @endif
                                                @if ($item->rating == 5)
                                                    <button class="btn btn-sm btn-primary" type="submit" value="5" name="submit_button">5</button>
                                                @else
                                                    <button class="btn btn-sm btn-outline-primary" type="submit" value="5" name="submit_button">5</button>
                                                @endif
                                        </form>
                                    </div>
                                </div>

                                <br>
                            </div>
                        </div>
                    </div>
                @empty
                    <h4>You haven't rated any Item</h4>
                @endforelse
            </div>
            {{ $items->links() }}
        </div>
    </div>
</main>
@endsection
