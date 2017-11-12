<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DataController;

class IndexController extends Controller
{
	public function __construct()
	{
		session_start();
		if(empty($_SESSION['validate_count'])){
			$_SESSION['validate_count'] = 0;
		}

		if(empty($_SESSION['nl_username'])){
			$_SESSION['nl_username'] = null;
		}else{
			$_SESSION['nl_username'] = $_SESSION['nl_username'];
		}
	}

	public function index()
	{
		// 日期，用来显示是要哪个季节的数据
		$date = date('m', time());
		$date = (int)($date/3);
		switch ($date) {
			case 0:$date = "冬季";
				break;
			case 1:$date = "夏季";
				break;
			case 2:$date = "秋季";
				break;
			case 3:$date = "冬季";
				break;
			
			default:$date = "时间获取出错";
				break;
		}
		$menu = DataController::getMenuData($date, 6);
		$ys = DataController::getMenuData("养生", 6);
		$foodKind = DataController::getFoodKind();
		$data = DB::select("select * from nl_bh_food_data order by looknum desc limit 0,6");
		return view('index/index', ['name'=>$_SESSION['nl_username'], "data"=>$data, 'date'=>$date, "menu"=>$menu, "foodKind"=>$foodKind, "ys"=>$ys]);
	}

	public function getData()
	{
		$url = "http://www.haodou.com/recipe/all/p-1/";
		$result = getInfoRefer($url, "http://www.haodou.com/recipe");
		// $result = str_ireplace(chr(60), "&lt;", $result);
		// $result = str_ireplace(chr(62), "&gt;", $result);
		$pattern = '/<p class="f14 mgt5"><a href="([\w\W]*?)" target="_blank" title="([\w\W]*?)">([\w\W]*?)<\/a><\/p>/';
		preg_match_all($pattern, $result, $matches);
		$url = $matches[1];
		$name = $matches[2];
		foreach ($url as $k => $v) {
			$value[$k]['url'] = "http://www.haodou.com".$v;
			$value[$k]['name'] = $name[$k];
		}
		$data = DB::table('nl_url_data')->insert($value);
		debug($data);
	}
}