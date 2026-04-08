<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\DeploymentCheck;

class DeploymentCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project) {
        $request->validate(['title' => 'required|string']);

        $check = $project->checks()->create([
            'title' => $request->title,
            'is_completed' => false
        ]);

        return response()->json(['data' => $check], 201);
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
    public function complete(DeploymentCheck $check) {
        if ($check->is_completed) {
            return response()->json(['message' => 'Already completed'], 422);
        }

        $check->update([
            'is_completed' => true,
            'completed_at' => now()
        ]);

        return response()->json(['message' => 'Marked as completed']);
    }
}
