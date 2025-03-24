@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">{{ $property->name }}</h1>

        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <p class="text-sm text-gray-600">{{ $property->description }}</p>
            <p class="text-lg font-medium mt-2">{{ $property->price }} €</p>
            <p class="text-sm mt-2">
                <span class="font-bold">Tipo:</span> {{ ucfirst($property->type) }}
            </p>
            <p class="text-sm mt-2">
                <span class="font-bold">Estado:</span> {{ ucfirst($property->status) }}
            </p>
            <p class="text-sm mt-2">
                <span class="font-bold">Ubicación:</span> {{ ucfirst($property->location) }}
            </p>
            <p class="text-sm mt-2">
                <span class="font-bold">Propietario:</span> {{ $property->user->name }}
            </p>
            <a href="{{ route('properties.index') }}" class="text-blue-500 mt-4 inline-block">Ir atrás</a>
        </div>

        <!-- Sección de Comentarios -->
        <div class="bg-white shadow-md rounded-lg p-4 mt-6">
            <h2 class="text-2xl font-bold">Comentarios</h2>

            <!-- Formulario para agregar un comentario -->
            @if(auth()->check())
                <form action="{{ route('reviews.store', $property->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-bold">Tu Comentario:</label>
                        <textarea name="comment" class="w-full border rounded p-2" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">Valoración (1-5):</label>
                        <input type="number" name="rating" min="1" max="5" class="w-full border rounded p-2" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enviar Comentario</button>
                </form>
            @else
                <p class="text-red-500 mt-4">Debes estar autenticado para comentar.</p>
            @endif

            <!-- Mostrar comentarios -->
            <div class="mt-6">
                @foreach($property->reviews as $review)
                    <div class="bg-gray-100 p-4 rounded mt-4">
                        <p class="text-lg font-semibold">{{ $review->user->name }}</p>
                        <p class="text-gray-700">{{ $review->comment }}</p>
                        <p class="text-sm text-gray-500">Valoración: {{ $review->rating }} ⭐</p>
                        <p class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
