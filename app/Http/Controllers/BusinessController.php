<?php

namespace App\Http\Controllers;

use App\Http\Resources\BusinessResource;
use App\Models\Business;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BusinessController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $businesses = $this->getUser()->businesses()->paginate(15);
        return $this->sendResponse(BusinessResource::collection($businesses)->response()->getData(true));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = false;
        try{
            $validated_data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'direction' => 'nullable|string',
                'phone' => 'nullable|string|max:20',
                'email' => 'required|email|max:255',
                'hours' => 'required|array',
                'website' => 'nullable|url|max:255',
                'social_networks' => 'nullable|array',
                'characteristics' => 'nullable|array',
                'covered_areas' => 'nullable|array'
            ]);
            $business = $this->getUser()->businesses()->create($validated_data);
            $response = $this->sendResponse(new BusinessResource($business), 'Business successfully created.');
        } catch (Exception $e) {
            $response = $this->sendError('Error on Business store', ['exceptionMessage' => $e->getMessage()], 422);
        }
        
        return $response;
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
