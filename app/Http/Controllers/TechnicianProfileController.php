<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTechnicianProfileRequest;
use App\Http\Requests\UpdateTechnicianProfileRequest;
use App\Models\TechnicianProfile;
use Illuminate\Http\Request;

class TechnicianProfileController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', TechnicianProfile::class);
        $profiles = TechnicianProfile::with('user')->paginate(15);
        return response()->json($profiles);
    }

    public function show(TechnicianProfile $technicianProfile)

    {

        $this->authorize('view', $technicianProfile);
        return response()->json($technicianProfile->load('user'));
    }

    public function store(StoreTechnicianProfileRequest $request)
    {
        $this->authorize('create', TechnicianProfile::class);

        if ($request->user()->technicianProfile) {

            return response()->json([
                'message' => 'Technician profile already exists.'
            ], 409);

        }
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $profile = TechnicianProfile::create($data);

        return response()->json([
            'message' => 'Technician profile created successfully.',
            'data' => $profile,
        ], 201);
    }

    public function update(UpdateTechnicianProfileRequest $request, TechnicianProfile $technicianProfile)
    {
        $this->authorize('update', $technicianProfile);
        $data = $request->validated();
        $technicianProfile->update($data);

        return response()->json([
            'message' => 'Technician profile updated successfully.',
            'data' => $technicianProfile,]);

    }

    public function destroy(TechnicianProfile $technicianProfile)
    {
        $this->authorize('delete', $technicianProfile);

        $technicianProfile->delete();

        return response()->json([
            'message' => 'Deleted successfully.'
        ]);
    }
}
