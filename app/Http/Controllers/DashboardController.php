<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $recipes = $request->user()
            ->recipes()
            ->latest()
            ->get();

        return view('dashboard', compact('recipes'));
    }
}
