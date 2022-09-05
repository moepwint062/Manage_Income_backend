<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Home\Income;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IncomeController extends Controller
{
    public function index()
    {
        $income = Income::all();
        $totalCount = $income->count();
        return response()->json([
            'result' => true, 
            'totalCount' => $totalCount, 
            'data' => [
                'incomeList' => $income
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
        // error_log($request);
        $request->validate([
            'income' => 'required'
        ]);

        $currentMonth = Carbon::now()->format('M');
        // $currentMonth = 'Aug';
        
        if($request !== NULL) {
            $existedMonth = Income::where('month', '=', $currentMonth)->orderBy('id', 'ASC')->first();
            if($existedMonth == NULL) {
                $income = new Income();
                $income->month = $currentMonth;
                $income->income = $request->input('income');
                $income->save_money = $request->input('income') * 0.1;
                $income->tax_money = $request->input('income') * 0.1;
                $income->general_expenses = $request->input('income') * 0.6;
                $income->extra_money = $request->input('income') * 0.2;
                $income->save();
            } else {
                return response()->json(['result' => false, 'message' => "Income for this month is already existed!"]);
            }
        } else {
            return response()->json(['result' => false, 'message' => "Please type income amount!"]);
        }
        
        return response()->json(['result' => true, 'message' => "Income is saved."]);
    }
}
