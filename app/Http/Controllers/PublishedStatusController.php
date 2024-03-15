<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublishedStatus;

class PublishedStatusController extends Controller
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
        $status = PublishedStatus::all('id', 'name');
        return response()->json($status);
    }
}
