<?php

namespace App\Services;

use Dbfx\LaravelStrapi\LaravelStrapi;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Cache;
use Dbfx\LaravelStrapi\Exceptions\NotFound;
use Dbfx\LaravelStrapi\Exceptions\PermissionDenied;
use Dbfx\LaravelStrapi\Exceptions\UnknownError;

class AppStrapi extends LaravelStrapi{
	protected $sortString = "_sort=createdAt:DESC";
	protected $pubString = "_publicationState=live";
	
	function getQueryParams(){
		return implode("&", [
			$this->sortString,
			$this->pubString,
		]);
	}

	public function getSingle(string $type, $id){
		$surl = $this->strapiUrl;
		$url = "$surl/$type/$id";
		$r =Http::withHeaders($this->headers)
			->get($url)
			->json();
		
		return $r;
	}

	public function collection(string $type, $sortKey = 'id', $sortOrder = 'DESC', $limit = 20, $start = 0, $fullUrls = true, array $populate = array()): array
    {
        $url = $this->strapiUrl;
        $cacheKey = self::CACHE_KEY . '.collection.' . $type . '.' . $sortKey . '.' . $sortOrder . '.' . $limit . '.' . $start;
        $populateString = $this->createPopulateString($populate);
		$qParam = $this->getQueryParams();

        // Fetch and cache the collection type
        $collection = Cache::remember($cacheKey, $this->cacheTime, function () use ($url, $type, 
			$sortKey, $sortOrder, $limit, $start, $populateString,
			$qParam) {
			// $url = $url . '/' . $type . '?sort[0]=' . $sortKey . ':' . $sortOrder . '&pagination[limit]=' . $limit . '&pagination[start]=' . $start . '&' . $populateString;
			$url = "$url/$type?$qParam";
			// preson($url);
            $response = Http::withHeaders($this->headers)
				->get($url);

            return $response->json();
        });

		// preson($collection);

        if (isset($collection['statusCode']) && $collection['statusCode'] >= 400) {
            Cache::forget($cacheKey);

            throw new PermissionDenied('Strapi returned a ' . $collection['statusCode']);
        }

        if (!is_array($collection)) {
            Cache::forget($cacheKey);

            if ($collection === null) {
                throw new NotFound('The requested single entry (' . $type . ') was null');
            }

            throw new UnknownError('An unknown Strapi error was returned');
        }

        // Replace any relative URLs with the full path
        if ($fullUrls) {
            $collection = $this->convertToFullUrls($collection);
        }

        return $collection;
    }
}