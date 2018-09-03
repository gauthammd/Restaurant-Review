@extends('layouts.app')

@section('content')
    <a href="/restaurants" class="btn btn-default">Go Back</a>
    <h1>{{$restaurant->name}}</h1>
    <span>Rating: {{$restaurant->rating}}/5</span>
    <img style="width:100%" src="/storage/cover_images/{{$restaurant->cover_image}}">
    <br><br>
    <div>
        {!!$restaurant->review!!}
    </div>
    <hr>
    <small>Written on {{$restaurant->created_at}} by {{$restaurant->user->name}}</small>
    <hr>
    <div id="map" style="width:100%;height:500px;"></div>

    @if(!Auth::guest())
        @if(Auth::user()->id == $restaurant->user_id)

            {!!Form::open(['action' => ['RestaurantController@destroy', $restaurant->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    
    {!! Form::open(['action' => ['CommentController@store', $restaurant->id], 'method' => 'POST']) !!}
        <div class = 'form-group'>
            {{Form::label('comment', 'Comment')}}
            {{Form::textArea('comment', '', ['class' => 'form-control', 'placeholder' => 'Review'])}}
        </div>
        {{Form::submit('Submit_Comment', ['class'=>'btn btn-primary'])}}

    {!!Form::close()!!}
    @else
    <a>Please log in to comment</a>
        
    @endif

    <div> Comments </div>
    
    <ul class = "list-group" id = "comments">
            @foreach($restaurant->comments as $comment)
            <li class = "list-group-item">
                <span>{{$comment->comment}}</span><span style = "float:right">{{$comment->user->name}}</span>
            </li>
            @endforeach
        
    </ul>
    

    <div id = 'comment_reply_form' style="display: none;">
        {!! Form::open(['action' => ['CommentController@store', $restaurant->id], 'method' => 'POST']) !!}
        <div class = 'form-group'>
            {{Form::label('comment', 'Comment')}}
            {{Form::textArea('comment', '', [ 'class' => 'form-control', 'placeholder' => 'Review'])}}
        </div>
        {{Form::hidden('parent_id', '', ['id' => 'parent_id'])}}
    {{Form::submit('Submit_Reply', ['class'=>'btn btn-primary'])}}

    {!!Form::close()!!}
    </div>

    @endsection

@section('footer')
<script>
function myMap() {
  var myCenter = new google.maps.LatLng({{$restaurant->lat}},{{$restaurant->lng}});
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 12};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);
}

/*$( '#comment_form' ).submit(function() {
 // alert( "Handler for .click() called." );
//    alert($('#comment').val());
    return false;
    $.ajax({
        method: 'POST', 
        url: '/CommentController/store',
        data: {'comment' : $('#comment').val()}, 
        success: function(response){ 
            console.log(response); 
        },
        error: function(jqXHR, textStatus, errorThrown) { 
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });

});


$( '.comment_reply' ).click(function() {
 // alert( "Handler for .click() called." );
 var comment_parent_id = $(this).children('div').text();
 $('#parent_id').val(comment_parent_id);
 $("#comment_reply_form").detach().appendTo($(this).parent());
 $('#comment_reply_form').css('display','block');
return false;
});
*/
/*$('#comment_form').submit(function(){
   alert('1');
   return false;
});*/

</script>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgYwLaQvnDAsrLllVZZvmmn-2D9Xuqi-U&callback=myMap"></script>

<script src="https://js.pusher.com/4.2/pusher.min.js"></script>
<script>
   function displayComment(data) {
    //    alert(data.comment);
            $('#comments').prepend('<li class = "list-group-item"> <span>' + data.comment + '</span><span style = "float:right">' + data.comment + '</span></li>');
        }


    var socket = new Pusher("597e415c9aa87d6c98f1", {
        cluster: 'eu',
    });

    socket.connection.bind('connected', function() {
        window.socketId = socket.connection.socket_id;
    });
    socket.subscribe('comments')
        .bind('new-comment',displayComment);
</script>
@endsection
