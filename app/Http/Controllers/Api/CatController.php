<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\GenralTraits;
use Illuminate\Http\Request;

class CatController extends Controller
{
    use GenralTraits;
    public function index(){

        $cat = Category::select('id','name_' . app()->getLocale() .' as name')->get();

        return response()->json($cat);
    }

    public function activeToUpdate(Request $request){

    Category::where('id', $request-> id) -> update(['active' => $request-> active]);

    return $this -> successupdate('تم التحديث بنجاح');


    }
}
