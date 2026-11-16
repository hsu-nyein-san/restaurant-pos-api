<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantTableRequest;
use App\Http\Requests\UpdateRestaurantTableRequest;
use App\Http\Resources\RestaurantTableResource;
use App\Models\RestaurantTable;

class RestaurantTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables=RestaurantTable::latest()->get();

        return RestaurantTableResource::collection($tables);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantTableRequest $request)
    {
        $validated=$request->validated();

        $table=RestaurantTable::create($validated);

        return response()->json([
            'message' => 'Table created successfully',
            'data' => new RestaurantTableResource($table),
        ], 201);
 
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantTable $restaurantTable)
    {
        return new RestaurantTableResource($restaurantTable);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantTableRequest $request, RestaurantTable $restaurantTable)
    {
        $validated=$request->validated();

        $restaurantTable->update($validated);

        return response()->json([
            'message' => 'Table updated successfully',
            'data' => new RestaurantTableResource($restaurantTable),
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantTable $restaurantTable)
    {
        $restaurantTable->delete();

        return response()->json([
            'message' => 'Table deleted successfully',
        ],200);

    }
}
