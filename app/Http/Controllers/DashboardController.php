<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Property;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $properties = Property::where('user_id', $user->id)->get();
        return view('dashboard', compact('user', 'properties'));
    }
}
