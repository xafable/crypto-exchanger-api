<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TicketController extends Controller
{
    function create(Request $request){

        Ticket::query()
            ->insert([
                'contact_name'=> $request->contactName,
                'contact_address'=>$request->contactAddress,
                'created_at'=> Carbon::now(),
                'updated_at'=> null,
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Appeal added. You will be contacted soon.'
        ]);


    }
}
