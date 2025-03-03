<?php

namespace App\Http\Controllers;

use App\Models\PublicHoliday;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PublicHolidayController extends Controller
{
    //create a publicHoliday controller method
    public function createPublicHoliday(Request $request): JsonResponse
    {
        if ($request->query('query') === 'deletemany') {
            try {
                $ids = json_decode($request->getContent(), true);
                $deletedManyPublicHoliday = PublicHoliday::destroy($ids);

                $deletedCounted = [
                    'count' => $deletedManyPublicHoliday,
                ];

                return response()->json($deletedCounted, 200);
            } catch (Exception $err) {
                return response()->json(['error' => 'An error occurred during deleting many Public Holiday. Please try again later.'], 500);
            }
        } else if ($request->query('query') === 'createmany') {
            try {
                $publicHolidayData = json_decode($request->getContent(), true);

                $createdPublicHoliday = collect($publicHolidayData)->map(function ($holiday) {
                    return PublicHoliday::firstOrCreate([
                        'name' => $holiday['name'],
                        'date' => new \DateTime($holiday['date']),
                    ]);
                });

                return response()->json(['count' => count($createdPublicHoliday)], 201);
            } catch (Exception $err) {
                return response()->json(['error' => 'An error occurred during creating many Public Holiday. Please try again later.'], 500);
            }
        } else {
            try {
                $publicHolidayData = json_decode($request->getContent(), true);

                $createdPublicHoliday =  PublicHoliday::create([
                    'name' => $publicHolidayData['name'],
                    'date' => new \DateTime($publicHolidayData['date']),
                ]);

                $converted = arrayKeysToCamelCase($createdPublicHoliday->toArray());
                return response()->json($converted, 201);
            } catch (Exception $err) {
                return response()->json(['error' => 'An error occurred during creating a single Public Holiday. Please try again later.'], 500);
            }
        }
    }

    // get publicHoliday controller method
    public function getAllPublicHoliday(Request $request): JsonResponse
    {
        if ($request->query('query') === 'all') {
            try {
                $getAllPublicHoliday = PublicHoliday::orderBy('id', 'asc')
                    ->where('status', 'true')
                    ->get();

                $converted = arrayKeysToCamelCase($getAllPublicHoliday->toArray());
                return response()->json($converted, 200);
            } catch (Exception $err) {
                return response()->json(['error' => 'An error occurred during getting Public Holiday. Please try again later.'], 500);
            }
        } else if ($request->query('status')) {
            try {
                $pagination = getPagination($request->query());

                $getAllPublicHoliday = PublicHoliday::orderBy('id', 'asc')
                    ->where('status', $request->query('status'))
                    ->skip($pagination['skip'])
                    ->take($pagination['limit'])
                    ->get();

                $converted = arrayKeysToCamelCase($getAllPublicHoliday->toArray());
                $aggregation = [
                    'getAllPublicHoliday' => $converted,
                    'totalPublicHoliday' => PublicHoliday::where('status', $request->query('status'))->count(),
                ];

                return response()->json($aggregation, 200);
            } catch (Exception $err) {
                return response()->json(['error' => 'An error occurred during getting Public Holiday. Please try again later.'], 500);
            }
        } else if ($request->query()) {
            try {
                $pagination = getPagination($request->query());

                $getAllPublicHoliday = PublicHoliday::orderBy('id', 'asc')
                    ->where('status', 'true')
                    ->skip($pagination['skip'])
                    ->take($pagination['limit'])
                    ->get();

                $converted = arrayKeysToCamelCase($getAllPublicHoliday->toArray());
                $aggregation = [
                    'getAllPublicHoliday' => $converted,
                    'totalPublicHoliday' => PublicHoliday::where('status', 'true')->count(),
                ];

                return response()->json($aggregation, 200);
            } catch (Exception $err) {
                return response()->json(['error' => 'An error occurred during getting Public Holiday. Please try again later.'], 500);
            }
        } else {
            return response()->json(['error' => 'Invalid Query!'], 400);
        }
    }

    // get a single publicHoliday controller method
    public function getSinglePublicHoliday(Request $request, int $id): JsonResponse
    {
        try {
            $getSinglePublicHoliday = PublicHoliday::where('id', $id)
                ->first();

            if (!$getSinglePublicHoliday) {
                return response()->json(['error' => 'public Holiday not found!'], 404);
            }

            $converted = arrayKeysToCamelCase($getSinglePublicHoliday->toArray());
            return response()->json($converted, 200);
        } catch (Exception $err) {
            return response()->json(['error' => 'An error occurred during getting Public Holiday. Please try again later.'], 500);
        }
    }

    // update single publicHoliday controller method
    public function updateSinglePublicHoliday(Request $request, int $id): JsonResponse
    {
        try {
            $updatedPublicHoliday = PublicHoliday::where('id', $id)->update([
                'name' => $request->input('name'),
                'date' => new \DateTime($request->input('date')),
            ]);

            if (!$updatedPublicHoliday) {
                return response()->json(['error' => 'Failed to update Public Holiday!'], 404);
            }
            return response()->json(['message' => 'PublicHoliday updated successfully'], 200);
        } catch (Exception $err) {
            return response()->json(['error' => 'An error occurred during updating Public Holiday. Please try again later.'], 500);
        }
    }

    // delete a single publicHoliday controller method
    public function deleteSinglePublicHoliday(Request $request, $id): JsonResponse
    {
        try {
            $deletedPublicHoliday = PublicHoliday::where('id', $id)
                ->delete();

            if ($deletedPublicHoliday) {
                return response()->json(['message' => 'PublicHoliday Deleted Successfully'], 200);
            } else {
                return response()->json(['error' => 'Failed to delete Public Holiday!'], 404);
            }
        } catch (Exception $err) {
            return response()->json(['error' => 'An error occurred during deleting Public Holiday. Please try again later.'], 500);
        }
    }
}
