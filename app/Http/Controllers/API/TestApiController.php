<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestApiController extends Controller
{
    public function test(): string{
        //    return "API Works";
              return response()->json(data: [
                 "status"=> "success",
                  "message"=> "API WORKS"
              ]);
}
}
