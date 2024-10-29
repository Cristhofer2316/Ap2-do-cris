<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return response()->json([
            'status' => true,
            'message' => 'cars retrieved successfully',
            'data' => $cars
        ], 200);
    }

    public function show($id)
    {
        $car = car::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'car found successfully',
            'data' => $car
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'placa' => 'required|string|max:10',
            'quilometragem' => 'required|numeric',
            'modelo' => 'required|string|max:50',
            'marca' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $car = car::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'car created successfully',
            'data' => $car
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'placa' => 'required|string|max:10',
            'quilometragem' => 'required|numeric',
            'modelo' => 'required|string|max:50',
            'marca' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $car = car::findOrFail($id);
        $car->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'car updated successfully',
            'data' => $car
        ], 200);
    }

    public function destroy($id)
    {
        $car = car::findOrFail($id);
        $car->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'car deleted successfully'
        ], 200);
    }
}
