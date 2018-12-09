<?php

namespace App\Http\Controllers\API;

use App\Events\DrawCompleted;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function addLine($room)
    {
        broadcast(new DrawCompleted($room, [
            'path' => request()->get('path'),
            'width' => request()->get('width'),
            'color' => request()->get('color'),
        ]))->toOthers();
    }
}
