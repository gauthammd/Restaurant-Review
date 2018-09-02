@extends('layouts.app')
@section('content')
<h1>Profile</h1>
    {!! Form::open(['action' => 'ProfileController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class = 'form-group'>
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class = 'form-group'>
            {{Form::label('age', 'Age')}}
            {{Form::text('age', $user->age, ['class' => 'form-control', 'placeholder' => 'Age'])}}
        </div>
        <div class = 'form-group'>
            {{Form::label('gender', 'Gender')}}
            {{Form::select('gender', array(
                'SELECT', 'MALE', 'FEMALE'
            ))
            }}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
<div id="map" style="width:100%;height:500px;"></div>

@endsection
