<?php

namespace Vinfo\Http\Controllers\Api;

use Vinfo\Http\Controllers\Api\Controller;
use Input;

use Vinfo\Region;
use Vinfo\Transformers\RegionTransformer;
use Vinfo\Country;
use Vinfo\Transformers\CountryTransformer;
// use Vinfo\Winery;
// use Vinfo\Transformers\WineryTransformer;

class GeometriesController extends Controller
{

    public function searchGeometried()
    {
        $type = Input::get('geometried_type');
        $string = Input::get('query');

        if (in_array($type, ['Region', 'Country', 'Winery'])) {

            $method = "get{$type}Results";

            list($transformer, $query) = $this->$method();

            $results = $query
            ->orderByTranslation('name')
            ->whereTranslationLike('name', "%$string%")
            ->get();

            return $this->response->collection($results, $transformer);
        }

        return $this->response->errorBadRequest();
    }

    private function getRegionResults()
    {
        $query = Region::where('is_structural', 0)
        ->where('shortcut_id', null)
        ->with('country', 'regionType');

        $transformer = new RegionTransformer;

        return [$transformer, $query];
    }

    private function getCountryResults()
    {
        $query = Country::whereIsActive();

        $transformer = new CountryTransformer;

        return [$transformer, $query];
    }

    // private function getWineryResults()
    // {
    //     $query = new Winery;

    //     $transformer = new WineryTransformer;

    //     return [$transformer, $query];
    // }
    
}
