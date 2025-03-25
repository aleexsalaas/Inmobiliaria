<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        return view('properties.index', compact('properties'));
    }

    public function show($id)
{
    $property = Property::findOrFail($id);
    return view('properties.show', compact('property'));
}


public function create()
{
    $user = auth()->user();

    return view('properties.create', compact('user'));
}



    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
            'location' => 'required',
            'status' => 'required',
        ]);

        Property::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'type' => $request->type,
            'location' => $request->location,
            'status' => $request->status,
            'user_id' => auth()->id(),
            'buyer_id' => null,
        ]);

        return redirect()->route('properties.index')->with('success', 'Property created successfully!');
    }

    public function edit($id)
{
    $property = Property::findOrFail($id);
    return view('properties.edit', compact('property'));
}

public function update(Request $request, $id)
{

    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'type' => 'required',
        'location' => 'required',
        'status' => 'required',
    ]);


    $property = Property::findOrFail($id);


    $property->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'type' => $request->type,
        'location' => $request->location,
        'status' => $request->status,
    ]);

    return redirect()->route('dashboard')->with('success', 'Property updated successfully!');
}


public function destroy($id)
{
    $property = Property::findOrFail($id);

    // Verificar que el usuario autenticado es el dueño
    if ($property->user_id !== auth()->id()) {
        abort(403, 'No tienes permiso para eliminar esta propiedad.');
    }

    $property->delete();

    return redirect()->route('dashboard')->with('success', 'Propiedad eliminada correctamente.');
}


public function buy($id)
{
    $property = Property::findOrFail($id);

    // Verificar que la propiedad está disponible para la venta
    if ($property->status !== 'available') {
        return redirect()->route('properties.index')->with('error', 'Esta propiedad ya no está disponible.');
    }

    // Verificar que el usuario está logueado
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para comprar.');
    }

    // Actualizar la propiedad como vendida y asignar el comprador
    $property->update([
        'status' => 'sold',
        'buyer_id' => auth()->id(), // Asigna el ID del comprador
    ]);

    return redirect()->route('properties.index')->with('success', '¡Propiedad comprada exitosamente!');
}

public function purchase($propertyId)
{
    $user = auth()->user(); // Obtener el usuario autenticado
    $property = Property::findOrFail($propertyId); // Obtener la propiedad a comprar

    if ($property->buyer_id) {
        return redirect()->back()->with('error', 'Esta propiedad ya ha sido comprada.');
    }

    // Asignar el buyer_id a la propiedad
    $property->buyer_id = $user->id;
    $property->save();

    return redirect()->route('dashboard')->with('success', 'Propiedad comprada exitosamente.');
}




}
