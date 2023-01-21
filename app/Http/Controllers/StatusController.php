<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    function index(){

        return response()->json([
            'success' => true,
            'data' => StatusResource::collection(Status::query()
                ->get())
        ]);
    }
}
