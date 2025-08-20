<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceListController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 'active')->get();

        return response()->json([
            'message' => 'Available Services',
            'data' => $services
        ]);
    }
}
