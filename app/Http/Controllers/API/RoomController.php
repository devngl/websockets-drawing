<?php

namespace App\Http\Controllers\API;

use App\Events\DrawCompleted;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function addLine($room)
    {
        broadcast(new DrawCompleted($room, [
            'id' => request()->get('id'),
            'path' => request()->get('path'),
            'width' => request()->get('width'),
            'color' => request()->get('color'),
        ]))->toOthers();
    }
}
