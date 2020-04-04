<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Events\BroadcastingVideo;

class Sender extends Controller
{
    public function main()
    {
    	return view('sender.main');
    }

    public function goLive(Request $request)
    {
    	broadcast(new BroadcastingVideo($request->data))->toOthers();
    	return $request->data;
    }
}
