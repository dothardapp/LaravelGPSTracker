<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Device;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Location::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Nueva ubicación recibida', $request->all());

        $validatedData = $request->validate([
            'device_id'       => 'required|string|max:255',
            'tracker_user_id' => 'required|exists:trackers_users,id',
            'latitude'        => 'required|numeric',
            'longitude'       => 'required|numeric',
            'timestamp'       => 'required|date',
            'speed'           => 'nullable|numeric',
            'bearing'         => 'nullable|numeric',
            'altitude'        => 'nullable|numeric',
            'accuracy'        => 'nullable|numeric',
        ]);

        // Busca el dispositivo por su ID. Si no existe, lo crea y asocia al usuario.
        $device = Device::firstOrCreate(
            ['device_id' => $validatedData['device_id']],
            ['tracker_user_id' => $validatedData['tracker_user_id']]
        );
        
        // Crea el nuevo punto de localización y lo asocia al dispositivo encontrado/creado.
        $location = $device->locations()->create($validatedData);

        return response()->json(['message' => 'Ubicación guardada con éxito', 'location_id' => $location->id], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
