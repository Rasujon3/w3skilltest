<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Efficient query: counts checks without loading all data
        $projects = Project::withCount(['checks', 'checks as completed_checks_count' => function($query) {
            $query->where('is_completed', true);
        }])->latest()->get();

        return response()->json(['data' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'owner_email' => 'required|email',
        ]);

        $project = Project::create($data);
        return response()->json(['data' => $project], 201);
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
    public function readiness(Project $project) {
        $total = $project->checks()->count();
        $completed = $project->checks()->where('is_completed', true)->count();

        return response()->json([
            'project' => $project->name,
            'total_checks' => $total,
            'completed_checks' => $completed,
            'is_ready_for_deployment' => ($total > 0 && $total === $completed)
        ]);
    }
}
