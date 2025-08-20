<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //POST /api/services
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $service = Service::create($validated);

        return response()->json([
            'message' => 'Service Created Successfully.',
            'data' => $service
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find service
        $service = Service::findOrFail($id);

        // Validate only the fields you send
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:active,inactive',
        ]);

        // Fill and check if anything actually changed
        $service->fill($validated);

        if (! $service->isDirty()) {
            return response()->json([
                'message' => 'No changes detected',
                'data' => $service
            ], 200);
        }

        // Save changes
        $service->save();

        return response()->json([
            'message' => 'Service updated successfully',
            'data' => $service->fresh()
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DELETE /api/services/{id}
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json(['message' => 'Service Deleted Successfully.']);
    }
}
