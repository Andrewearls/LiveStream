<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\BroadcastingVideo;

class Sender extends Controller
{
    public function main()
    {
    	return view('sender.main');
    }

    public function goLive()
    {
    	event(new BroadcastingVideo('sadF'));
    	return "live";
    }
}
