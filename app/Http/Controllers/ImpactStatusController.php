<?php

namespace App\Http\Controllers;

use App\Models\ImpactStatus;
use Illuminate\Http\Request;

class ImpactStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = ImpactStatus::all('id', 'name');
        return response()->json($status);
    }
}
