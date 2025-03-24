<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Property;

class ReviewController extends Controller
{
    public function store(Request $request, Property $property)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'property_id' => $property->id,
            'comment' => $request->comment,
            'rating' => $request->rating
        ]);

        return redirect()->route('properties.show', $property->id)->with('success', 'Comentario agregado correctamente.');
    }
}
