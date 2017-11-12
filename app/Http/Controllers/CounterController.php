<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Http\Controllers\DataController;

class CounterController extends Controller
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

	public function counterWeight()
	{
		$foodKind = DataController::getFoodKind();
		$jf = DataController::getMenuData("减肥", 6);
		$yy = DataController::getMenuData("营养", 6);
		return view('counter/counterWeight', ['name'=>$_SESSION['nl_username'], "foodKind"=>$foodKind, 'jf'=>$jf, 'yy'=>$yy]);
	}

	public function calorie()
	{
		if(empty($_GET['food'])){
			$_GET['food'] = "米饭";
		}
		$get['keyword'] = htmlspecialchars($_GET['food']);
		$pageFood = $get['keyword'];
		$foodName = htmlspecialchars($_GET['food']);
		if(empty($_GET['page'])){
			$page = 1;
		}else{
			$page = htmlspecialchars($_GET['page']);
			if(!numCheck($page)){
				$page = 1;
			}
		}
		$get['page'] = $page;
		$get = http_build_query($get);
		$url = "http://www.boohee.com/food/search?".$get;
		$dataArr = DataController::getFoodDataHandle($url);
		$arrPage = $dataArr['arrPage'];
		$arrRes = $dataArr['arrRes'];
		$pageCount = $dataArr['pageCount'];
		return view('counter/calorie', ['name'=>$_SESSION['nl_username'], "pageCount"=>$pageCount, "data"=>$arrRes, "pageFood"=>$pageFood, "page"=>$page, "arrPage"=>$arrPage]);
	}
}