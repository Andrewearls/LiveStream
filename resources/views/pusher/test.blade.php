<!DOCTYPE html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Pusher Test</title>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="{{ asset('js/sendMessages.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/eventHandlers.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
  <script src="{{ asset('js/reciever.js') }}"></script>
  <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
  
  <script>
    // Echo.channel('open-channel')
    // .listen('BroadcastingVideo', (e) => {
    //   alert(e.message);
    // });

    // document.onreadystatechange = () => {
    //   if (document.readyState === 'complete') {
    //     console.log("doc is ready");
    //     Echo.channel('open-channel').listen('BroadcastingVideo', function(e) {
    //       console.log(e);
    //     });
    //   }
    // };

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('45f7e2d005912d917ae1', {
      cluster: 'us3',
      forceTLS: true
    });

    var channel = pusher.subscribe('open-channel');
    channel.bind('BroadcastingVideo', function(data) {
      handleRecievedMessage(data['message']);
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
  <video id="recieved_video" style="border: 1px solid red;"></video>
  <button id="play_button" data-href="{{ route('respond') }}" >Play</button>
  <script type="text/javascript">

  </script>
</body>