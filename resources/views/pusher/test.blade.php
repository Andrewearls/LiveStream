<!DOCTYPE html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Pusher Test</title>
  <script src="{{ asset('js/app.js') }}"></script>
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
    Pusher.logToConsole = true;

    var pusher = new Pusher('45f7e2d005912d917ae1', {
      cluster: 'us3',
      forceTLS: true
    });

    var channel = pusher.subscribe('open-channel');
    channel.bind('BroadcastingVideo', function(data) {
      console.log(JSON.stringify(data['message']));
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>