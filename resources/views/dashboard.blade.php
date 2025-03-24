@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        @auth
            <div class="bg-white mb-6 p-6 rounded-lg shadow-lg">
                <h1 class="text-3xl font-semibold text-gray-800">Bienvenido, {{ $user->name }}</h1>
                @if($user->role === 'admin')
                    <p class="text-gray-600">Tu rol es: <span class="font-bold text-blue-600">{{ $user->role }}</span></p>
                @endif
            </div>

            {{-- Mostrar opciones de usuario si es admin --}}
            @if($user->role === 'admin')
                <div class="mt-6 mb-6 bg-gray-50 p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold text-gray-800">Panel de administración</h3>
                    <ul class="mt-4 space-y-4">
                        <li>
                            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline text-lg">
                                Gestionar Usuarios
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline text-lg">
                                Gestionar Recursos
                            </a>
                        </li>
                    </ul>
                </div>
            @endif

            {{-- Mostrar las propiedades del usuario --}}
            <div class="mt-10 bg-gray-50 p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold text-gray-800">Tus propiedades</h3>
                <a href="{{ route('properties.create') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                                        Crear Propiedad
                                    </a>
                @if($properties->isEmpty())
                    <p class="text-gray-600 mt-4">No tienes propiedades publicadas aún.</p>
                @else
                    <ul class=" space-y-4">
                        @foreach($properties as $property)
                            <li class="bg-white mb-4 p-4 rounded-lg shadow-sm">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $property->name }}</h4>
                                <p class="text-gray-600">{{ $property->description }}</p>
                                <p class="text-gray-600">Precio: ${{ number_format($property->price, 2) }}</p>
                                <p class="text-gray-600">Tipo: {{ $property->type }}</p>
                                <p class="text-gray-600">Ubicación: {{ $property->location }}</p>
                                <p class="text-gray-600">Estado: <span class="font-bold">{{ $property->status }}</span></p>
                                <div class="mt-4">
                                    <a href="{{ route('properties.edit', $property->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                                        Editar propiedad
                                    </a>
                                </div>  
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @else
            <div class="bg-red-100 p-4 rounded-lg shadow-lg">
                <p class="text-red-600">No estás autenticado. <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Inicia sesión</a> para acceder al dashboard.</p>
            </div>
        @endauth
    </div>
@endsection
