@extends('layouts.app')
@section('content')
<h1>Add Restaurant</h1>
    {!! Form::open(['action' => 'RestaurantController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class = 'form-group'>
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class = 'form-group'>
            {{Form::label('review', 'Review')}}
            {{Form::textArea('review', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Review'])}}
        </div>
        <div class = 'form-group'>
            {{Form::hidden('latitude', '', ['id' => 'latitude', 'class' => 'form-control', 'placeholder' => 'Review'])}}
        </div>
        <div class = 'form-group'>
            {{Form::hidden('longitude', '', ['id' => 'longitude', 'class' => 'form-control', 'placeholder' => 'Review'])}}
        </div>
        <div class = 'form-group'>
            {{Form::label('address', 'address')}}
            {{Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Address'])}}
        </div>
        <div class = 'form-group'>
            {{Form::label('rating', 'rating')}}
            {{Form::text('rating', '', ['class' => 'form-control', 'placeholder' => 'Rating'])}}
        </div>

        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
<div id="map" style="width:100%;height:500px;"></div>


@endsection

@section('footer')
<script>
    function myMap() {
        var mapCanvas = document.getElementById("map");
        var myCenter=new google.maps.LatLng(53.3490142754436,-6.25971794128418);
        var mapOptions = {center: myCenter, zoom: 12};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(map, event.latLng);
        });
    }

    function placeMarker(map, location) {
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
        var infowindow = new google.maps.InfoWindow({
            content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
        });
        $('#latitude').val(location.lat);
        $('#longitude').val(location.lng);
        infowindow.open(map,marker);
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgYwLaQvnDAsrLllVZZvmmn-2D9Xuqi-U&callback=myMap"></script>

@endsection

