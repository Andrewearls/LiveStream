<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\BroadcastingVideo;


class Reciever extends Controller
{
	public function main()
{
	return view('reciever/main');
}

    public function response(Request $data)
    {
    	event(new BroadcastingVideo($request->data));
    	return "success";
    }
}
