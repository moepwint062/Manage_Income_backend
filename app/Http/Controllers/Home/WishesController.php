<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Home\Wishes;
use Illuminate\Http\Request;

class WishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $wishList = Wishes::all();
        $firstPageList = Wishes::paginate(10);
        $totalCount = $wishList->count();
        return response()->json([
            'result' => true, 
            'totalCount' => $totalCount, 
            'data' => [
                'wishList' => $wishList,
                'firstPageList' => $firstPageList
            ]
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        error_log($request);
        $request->validate([
            'item' => 'required',
            'price' => 'required'
        ]);
        if($request != NULL) {
            $wishItem = new Wishes();
            $wishItem->item = $request->input('item');
            $wishItem->price = $request->input('price');
            $wishItem->save();
        } else {
            return response()->json(['result' => true, 'message' => "Please type item & price!"]);
        }
        return response()->json(['result' => true, 'message' => "Item is saved."]);
    }
}
