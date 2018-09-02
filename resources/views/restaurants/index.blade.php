@extends('layouts.app')

@section('content')
    <h1>Restaurants</h1>
    @if(count($restaurants) > 0)
        @foreach($restaurants as $restaurant)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        @if($restaurant->cover_image == "")
                            <img style="width:100%" src="/storage/cover_images/no_image.jpg">
                        @else
                            <img style="width:100%" src="/storage/cover_images/{{$restaurant->cover_image}}">
                        @endif
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/restaurants/{{$restaurant->id}}">{{$restaurant->name}}</a></h3>
                    <h4>Rating :{{$restaurant->rating}}/5</h4>
                        <small>Written on {{$restaurant->created_at}} by {{$restaurant->user->name}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $restaurants->links() }}
    @else
        <p>No posts found</p>
    @endif
@endsection