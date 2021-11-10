@extends('layouts.frontend')
@section('content')
     <div style="margin: 100px 100px">

     <h1>Not Found what you re looking for!!!!</h1>
     @if(!empty($message))
        <h2> {{$message}}</h2>
     @endif
     </div>
@endsection    