<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTechnicianServiceRequest;
use App\Http\Requests\UpdateTechnicianServiceRequest;
use App\Models\TechnicianService;
use Illuminate\Http\Request;

class TechnicianServiceController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', TechnicianService::class);

        $technicianServices = TechnicianService::with([
            'technician',
            'service'
        ])->paginate(15);

        return response()->json($technicianServices);
    }

    public function show(TechnicianService $technicianService)
    {
        $this->authorize('view', $technicianService);

        $technicianService->load([
            'technician',
            'service'
        ]);

        return response()->json($technicianService);
    }

    public function store(StoreTechnicianServiceRequest $request)
    {
        $this->authorize('create', TechnicianService::class);

        $data = $request->validated();

        $data['technician_id'] = $request->user()->id;

        $technicianService = TechnicianService::create($data);

        return response()->json([
            'message' => 'Technician service created successfully.',
            'data' => $technicianService,
        ], 201);
    }

    public function update(
        UpdateTechnicianServiceRequest $request,
        TechnicianService              $technicianService
    )
    {
        $this->authorize('update', $technicianService);

        $data = $request->validated();

        $technicianService->update($data);

        return response()->json([
            'message' => 'Technician service updated successfully.',
            'data' => $technicianService,
        ]);
    }

    public function destroy(TechnicianService $technicianService)
    {
        $this->authorize('delete', $technicianService);

        $technicianService->delete();

        return response()->json([
            'message' => 'Deleted successfully.'
        ]);
    }
}
