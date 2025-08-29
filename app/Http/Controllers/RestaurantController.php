<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GooglePlacesService;
use Illuminate\View\View;

class RestaurantController extends Controller
{
	private GooglePlacesService $placesService;

	public function __construct(GooglePlacesService $placesService)
	{
		$this->placesService = $placesService;
	}

	public function index(): View
	{
		return view('restaurants.index', [
			'results' => null,
			'error' => null,
			'city' => null,
		]);
	}

	public function search(Request $request): View
	{
		$validated = $request->validate([
			'city' => ['required', 'string', 'max:120'],
		]);

		$city = trim($validated['city']);

		try {
			$results = $this->placesService->searchRestaurantsByCity($city, 10);
			return view('restaurants.index', [
				'results' => $results,
				'error' => null,
				'city' => $city,
			]);
		} catch (\Throwable $e) {
			return view('restaurants.index', [
				'results' => null,
				'error' => 'Unable to fetch restaurants. Please try again.',
				'city' => $city,
			]);
		}
	}
}


