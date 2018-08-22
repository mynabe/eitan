<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\result;
use App\detail;
use App\vocabulary;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();    
        $exist_results = DB::table('results')->where('user_id', $user->id)->exists();

        // 実行結果がある場合は、未実行または不正解の単語を表示する
        if($exist_results)
        {            
            $items = vocabulary::whereNotExists(function($query)
            {
                $user = \Auth::user(); 
                $query->select('vocabularies.id', 'vocabularies.japanese', 'vocabularies.english', 'vocabularies.part')
                     ->from('details')
                     ->whereRaw('vocabularies.id = details.vocabulary_id')
                     ->leftJoin('results', 'results.id', '=', 'details.result_id')
                     ->where('results.user_id', '=', $user->id)
                     ->where('details.decision', '=', 1);
            })
            ->limit(10)->get();
            
        }
        else
        { 
            $items =  DB::table('vocabularies')->limit(10)->get();
        }

        return view('home', compact('items'));
    }

    public function post(Request $request)
    {
        // 履歴を表示ボタン押下
        if(Input::get('history'))
        {
            return redirect("list");
        }

        // 採点するボタン押下
        $items = array();
        for($i = 0; $i < count($request["japanese"]); $i++) 
        {
            $items[$i]["japanese"][$i] = $request["japanese"][$i];
            $items[$i]["english"][$i] = $request["english"][$i];
            $items[$i]["part"][$i] = $request["part"][$i];
            $items[$i]["input_value"][$i] = $request["input_value"][$i];
            $items[$i]["id"][$i] = $request["id"][$i];

            if($request["english"][$i] == $request["input_value"][$i])
            {
                $items[$i]["decision"][$i] = true;
            }
            else
            {
                $items[$i]["decision"][$i] = false;
            }
        }
        return view('display', compact('items'));
    }
}