<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('service')->get();
        return response()->json([
            'success' => true,
            'data' => $appointments,
        ]);
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('service');
        return response()->json([
            'success' => true,
            'data' => $appointment,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:50',
            'preferred_date' => 'required|date|after_or_equal:today',
            'preferred_time' => 'required|date_format:H:i',
            'mode' => 'required|in:presencial,online',
            'notes' => 'nullable|string',
        ]);

        $appointment = Appointment::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cita agendada exitosamente',
            'data' => $appointment,
        ], 201);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'sometimes|in:pendiente,confirmada,cancelada',
            'notes' => 'sometimes|nullable|string',
        ]);

        $appointment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cita actualizada exitosamente',
            'data' => $appointment,
        ]);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cita eliminada exitosamente',
        ]);
    }
}