<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return response()->json([
            'success' => true,
            'data' => $services,
        ]);
    }

    public function show(Service $service)
    {
        return response()->json([
            'success' => true,
            'data' => $service,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:services',
            'description' => 'required|string',
            'duration_minutes' => 'required|integer|min:15',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:terapia,retiro,formacion',
        ]);

        $service = Service::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Servicio creado exitosamente',
            'data' => $service,
        ], 201);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|unique:services,slug,' . $service->id,
            'description' => 'sometimes|string',
            'duration_minutes' => 'sometimes|integer|min:15',
            'price' => 'sometimes|numeric|min:0',
            'type' => 'sometimes|in:terapia,retiro,formacion',
        ]);

        $service->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Servicio actualizado exitosamente',
            'data' => $service,
        ]);
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Servicio eliminado exitosamente',
        ]);
    }
}