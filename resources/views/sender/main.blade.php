@extends('app')

@section('content')
	<video id="localVideo" class=""></video>
@endsection

@section('buttons')
	<button id="startButton">Start</button>
    <button id="sendButton">Send</button>
    <button id="hangupButton">Hang up</button>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/connection.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sender.js') }}"></script>

@endsection