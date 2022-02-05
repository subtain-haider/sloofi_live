<?php

namespace Modules\ThirdPartyApi\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\ThirdPartyApi\Entities\ApiCategory;

class ThirdPartyApiController extends Controller
{
    public function categories($id, $name)
    {
        $internal_categories = Category::all();
        $tp_categories = get_tp_categories($id);
        return view('thirdpartyapi::index', compact('tp_categories', 'internal_categories', 'name'));
    }

    public function attach_tp(Request $request){
        $api_category = ApiCategory::where('external_id', $request->otp_id)->first();
        if (!empty($api_category)){
            $api_category->update([
                'category_id' => $request->catid,
                'name' => $request->name,
            ]);

        }else{
            ApiCategory::create([
                'category_id' => $request->catid,
                'provider_type' => 'p_'. $request->type,
                'external_id' => $request->otp_id,
                'name' => $request->name,
            ]);
        }
        return true;
    }

}
