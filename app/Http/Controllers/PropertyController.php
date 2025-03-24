<?php

namespace App\Http\Controllers;

use App\Models\Property;  // Asegúrate de importar el modelo Property
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

// app/Http/Controllers/PropertyController.php

public function create()
{
    // Aquí puedes pasar datos si es necesario, como categorías de propiedades
    return view('properties.create');
}



    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
            'location' => 'required',
            'status' => 'required',
        ]);

        // Creación de la propiedad en la base de datos
        Property::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'type' => $request->type,
            'location' => $request->location,
            'status' => $request->status,
            'user_id' => auth()->id(),  // Asignar el ID del usuario autenticado
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

    // Redirigir con un mensaje de éxito
    return redirect()->route('dashboard')->with('success', 'Property updated successfully!');
}

    // Puedes añadir más métodos para editar, mostrar y eliminar propiedades si lo necesitas.
}
