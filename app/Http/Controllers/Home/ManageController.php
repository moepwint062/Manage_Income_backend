<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home\Wishes;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $mergeArray = array();
        foreach ($months as $m) {
            $canBuyLists = Wishes::join('incomes', 'wishes.price', '<=', 'incomes.extra_money')
                    ->where('incomes.month', $m)
                    ->orderBy('id', 'ASC')->get(['wishes.*']);

            array_push($mergeArray, array(
                'month' => $m,
                'lists' => $canBuyLists
            ));
        }
        return response()->json([
            'result' => true,
            'data' => [
                'canBuyLists' => $mergeArray
            ]
        ]);
    }
}
