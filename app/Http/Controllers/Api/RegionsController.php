<?php

namespace Vinfo\Http\Controllers\Api;

use Vinfo\Http\Controllers\Api\Controller;
use Input;

use Vinfo\Region;
use Vinfo\Transformers\RegionTransformer;

class RegionsController extends Controller
{

    public function searchRegions($exclude = null)
    {
        $string = Input::get('query');

        $query = Region::where('is_structural', 0)
        ->where('shortcut_id', null)
        ->with('country', 'regionType')
        ->whereTranslationLike('name', "%$string%")
        ->orderByTranslation('sortas');

        if ($exclude) {
            if ($exclude = Region::find($exclude)) {
                $query->where('country_id', $exclude->country_id)
                ->where($exclude->getLeftColumnName(), '<', $exclude->getLeft())
                ->where($exclude->getRightColumnName(), '<', $exclude->getRight());
            }
            else {
                return $this->response->errorBadRequest();
            }
        }
        
        $results = $query->get();

        $transformer = new RegionTransformer;

        return $this->response->collection($results, $transformer);

    }

}
