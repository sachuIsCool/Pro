<?php

namespace App\Services;

use GuzzleHttp\Client;

class GooglePlacesService
{
	private Client $httpClient;
	private string $apiKey;

	public function __construct()
	{
		$this->httpClient = new Client([
			'timeout' => 10,
		]);
		$this->apiKey = config('services.google.maps_api_key', '');
	}

	/**
	 * @return array<int, array{name:string,address:string,rating:float|null}>
	 */
	public function searchRestaurantsByCity(string $city, int $limit = 10): array
	{
		if ($this->apiKey === '') {
			throw new \RuntimeException('Missing Google Maps API key.');
		}

		$query = sprintf('restaurants in %s', $city);
		$url = 'https://maps.googleapis.com/maps/api/place/textsearch/json';

		$response = $this->httpClient->get($url, [
			'query' => [
				'query' => $query,
				'key' => $this->apiKey,
				'type' => 'restaurant',
			],
		]);

		$data = json_decode((string) $response->getBody(), true);

		if (!is_array($data) || ($data['status'] ?? '') !== 'OK') {
			return [];
		}

		$items = array_slice($data['results'] ?? [], 0, $limit);

		$normalized = [];
		foreach ($items as $item) {
			$normalized[] = [
				'name' => $item['name'] ?? 'Unknown',
				'address' => $item['formatted_address'] ?? ($item['vicinity'] ?? 'N/A'),
				'rating' => isset($item['rating']) ? (float) $item['rating'] : null,
			];
		}

		return $normalized;
	}
}


