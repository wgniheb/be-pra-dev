<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserHasEntityController extends Controller
{
    public function index(){
        $data = UserHasEntity::all();
        return response()->json([$data], 200);
    }


}
