@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-2xl font-semibold mb-6 mt-6">Crear Propiedad</h1>

    <form action="{{ route('properties.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Nombre de la propiedad -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre de la propiedad</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('name') }}" required>
        </div>

        <!-- Descripción de la propiedad -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="description" id="description" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('description') }}</textarea>
        </div>

        <!-- Precio de la propiedad -->
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
            <input type="number" name="price" id="price" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('price') }}" required>
        </div>

        <!-- Tipo de propiedad (por ejemplo, venta, alquiler) -->
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Tipo de propiedad</label>
            <select name="type" id="type" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <option value="sale" {{ old('type') == 'sale' ? 'selected' : '' }}>Venta</option>
                <option value="rent" {{ old('type') == 'rent' ? 'selected' : '' }}>Alquiler</option>
            </select>
        </div>

        <!-- Ubicación de la propiedad -->
        <div class="mb-4">
            <label for="location" class="block text-sm font-medium text-gray-700">Ubicación</label>
            <input type="text" name="location" id="location" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('location') }}" required>
        </div>

        <!-- Estado de la propiedad (disponible, vendido, etc.) -->
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Estado de la propiedad</label>
            <select name="status" id="status" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Disponible</option>
                <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Vendido</option>
                <option value="rented" {{ old('status') == 'rented' ? 'selected' : '' }}>Alquilado</option>
            </select>
        </div>

        <!-- Botón para crear la propiedad -->
        <div class="mb-6">
            <button type="submit" class="w-full bg-blue-500 text-black py-3 px-6 rounded-md focus:outline-none hover:bg-blue-600">
                Crear Propiedad
            </button>
        </div>
    </form>
</div>
@endsection
