<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{



    public function availableCars(Request $request)
    {



        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $model = $request->input('model');
        $comfortCategory = $request->input('comfort_category');

        $query = Car::whereDoesntHave('trips', function($query) use ($startTime, $endTime) {
            $query->where(function($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function($q) use ($startTime, $endTime) {
                        $q->where('start_time', '<', $startTime)
                            ->where('end_time', '>', $endTime);
                    });
            });
        });

        if ($model) {
            $query->where('model', $model);
        }

        if ($comfortCategory) {
            $query->where('comfort_category', $comfortCategory);
        }

        $availableCars = $query->get();

        return response()->json($availableCars);
    }
}
