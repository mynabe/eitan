<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Result;
use App\Detail;
use App\Vocabulary;

class ListController extends Controller
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
    
    public function index()
    {
        $user = \Auth::user();
        $result_out = new result;
        $lists = $result_out->where('user_id', $user->id)->orderBy('created_at','desc')->paginate(10);

        return view('list', compact('lists'));
    }

    public function post(Request $request)
    {
    	$user = \Auth::user();
    	$detail = new detail;

        // 詳細ボタン押下
    	if(Input::get('detail'))
    	{
	        $items = $detail->leftJoin('results', 'results.id', '=', 'details.result_id')
                            ->leftJoin('vocabularies', 'vocabularies.id', '=', 'details.vocabulary_id')
                            ->where('results.user_id', '=', $user->id)
                            ->where('results.id', $request->detail)
                            ->get();

	        return view('detail', compact('items'));		
    	}

        // テスト実施orやり直すボタン押下
    	if(Input::get('re_test') || Input::get('retry'))
    	{
    		return redirect("home");
    	}

        // 保存するボタン押下
        $user = \Auth::user();
        $result = new result;
        $result->user_id = $user->id;
        $result->rate = $this->calc_correct_rate($request);
        // 結果テーブルに保存  
        $result->save();

        $data = array();
        for($i = 0; $i < count($request["id"]); $i++) 
        {
            $data[$i]["result_id"] = $result->id;
            $data[$i]["vocabulary_id"] = $request["id"][$i];
            $data[$i]["input_value"] = $request["input_value"][$i] ? $request["input_value"][$i] : "" ;
            $data[$i]["decision"] = $request["decision"][$i] ? 1 : 0;
            $data[$i]["user_id"] = $user->id;
        }
        // 詳細テーブルに保存
        $detail-> insert($data);

        // 結果一覧を表示
        $result_out = new result;
        $lists = $result_out->where('user_id', $user->id)->orderBy('created_at','desc')->paginate(10);

        return view('list', compact('lists'));
    }


    /**
     * 正解率を求める
     *
     * @param array
     * @return int
     */
    function calc_correct_rate($request)
    {
        $rate = 0;
        $correct = 0;
        $total = count($request["id"]);

        for($i = 0; $i < $total; $i++)
        {
            if($request["decision"][$i])
            {
                $correct++; 
            }
        }

        if($total > 0)
        {
            $rate = floor($correct / $total * 100);
        }

        return $rate;
    }
}
