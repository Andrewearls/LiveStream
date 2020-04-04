@extends('app')

@section('content')
	<video id="recieved_video" class=""></video>
@endsection

@section('buttons')
  	<button id="play_button" data-href="{{ route('respond') }}" >Play</button>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('js/reciever.js') }}"></script>
@endsection