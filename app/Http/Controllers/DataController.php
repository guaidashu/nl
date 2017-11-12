<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
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
	
	// 获取食物的总列表信息
	// pageCount 为页面总数
	public function getFoodData()
	{
		if(empty($_GET['food'])){
			$_GET['food'] = "牛肉";
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
		$foodKind = $this->getFoodKind();
		$menu = DataController::getMenuData($foodName, 6);
		$arrRes = $dataArr['arrRes'];
		$arrPage = $dataArr['arrPage'];
		$pageCount = $dataArr['pageCount'];

		// 开始调试
		// debug($dataImg, true);
		return view('data/getFoodData', ['name'=>$_SESSION['nl_username'], 'foodName'=>$foodName, 'data'=>$arrRes, 'pageCount'=>$pageCount, "foodKind"=>$foodKind, "pageFood"=>$pageFood, "arrPage"=>$arrPage, "page"=>$page, 'menu'=>$menu]);
	}

	public static function getFoodDataHandle($url)
	{
		$result = getInfoRefer($url, $url);

		// 获取总分页数
		$pattern = '/([0-9]*?)<\/a> <a class="next_page([\w\W]*?)" rel="next"/';
		preg_match_all($pattern, $result, $match);
		if(!empty($match[1][0])){
			$pageCount = $match[1][0];
		}else{
			// 再次进行匹配是因为有可能用户直接翻到了最后一页，我们也是需要页数的
			$pattern = '/([0-9]*?)<\/em> <span class="next_page disabled">/';
			preg_match_all($pattern, $result, $match);
			if(!empty($match[1][0])){
				$pageCount = $match[1][0];
			}else{
				$pageCount = 0;
			}
		}

		// 获取每个食物的连接
		$pattern = '/<ul class="food-list">([\w\W]*?)<\/ul>/';
		preg_match_all($pattern, $result, $match);
		if(!empty($match[0][0])){
			$result = $match[0][0];
		}else{
			echo js_arr("getFoodDataUrlFailed");
			exit;
		}
		
		// 获取食物热量
		$pattern = '/<p>热量：([\w\W]*?)<\/p>/';
		preg_match_all($pattern, $result, $match);
		if(!empty($match[1])){
			$dataPower = $match[1];
		}else{
			echo js_arr("getDataPowerFailed");
			exit;
		}

		// 获取对应的食物连接 图片链接 食物名字
		$pattern = "/<a href=['|\"]([\w\W]*?)['|\"] target=['|\"]_blank['|\"]><img src=['|\"]([\w\W]*?)[\"|']([\w\W]*?)\/>/";
		preg_match_all($pattern, $result, $match);
		if(!empty($match[2])){
			$dataImg = $match[2];
		}else{
			echo js_arr("getFoodDataUrlFailed");
			exit;
		}


		$pattern = "/<a href=\"([\w\W]*?)\" title=\"([\w\W]*?)\" target=['|\"]_blank['|\"]>([\w\W]*?)<\/a>/";
		preg_match_all($pattern, $result, $match);
		if(!empty($match[1])&&!empty($match[2])){
			$dataUrl = $match[1];
			$dataName = $match[2];
		}else{
			echo js_arr("getFoodDataUrlFailed");
			exit;
		}

		$arrFinal = array();
		$arrRes = array();
		foreach ($dataUrl as $k => $v) {
			$arrFinal[$k]['url'] = $v;
			$arrFinal[$k]['name'] = $dataName[$k];
			$arrFinal[$k]['imgurl'] = $dataImg[$k];
			$arrFinal[$k]['power'] = $dataPower[$k];
		}
		foreach ($arrFinal as $k => $v) {
			$arrRes[$k] = (object)$arrFinal[$k];
		}
		$arrPage = array();
		for($i=1; $i<=$pageCount; $i++){
			$arrPage[$i-1] = $i;
		}

		return array(
			"arrRes" => $arrRes, 
			"arrPage" => $arrPage,
			"pageCount" => $pageCount
		);
	}

	// 菜谱数据展示的页面
	public function getMenuDataDetail()
	{
		if(empty($_GET['url'])){
			$url = "http://www.haodou.com/recipe/951281/";
		}else{
			$url = $_GET['url'];
		}
		$info = DataController::getMenuDataDetailHandle($url);
		$menu = DataController::getMenuData($info['name'], 6);
		$foodKind = $this->getFoodKind();
		return view('data/getMenuData', ['name'=>$_SESSION['nl_username'], 'foodKind'=>$foodKind, "info"=>$info, "menu"=>$menu]);
	}

	// 获取食物种类分页
	public function getFoodKindData()
	{
		if(empty($_GET['kind'])){
			$_GET['kind'] = "/food/group/1";
		}
		$get['kind'] = htmlspecialchars($_GET['kind']);
		$kind = $get['kind'];
		if(empty($_GET['page'])){
			$page = 1;
		}else{
			$page = htmlspecialchars($_GET['page']);
			if(!numCheck($page)){
				$page = 1;
			}
		}

		if(empty($_GET['name'])){
			return redirect('data/getFoodKindData.html?kind=/food/group/1&name=谷薯芋、杂豆、主食');
			$foodName = "谷薯芋、杂豆、主食";
		}else{
			$foodName = htmlspecialchars($_GET['name']);
		}

		$url = "http://www.boohee.com".$get['kind']."?page=".$page;
		$data = $this->getFoodKindDataHandle($url);
		$arrRes = $data['res'];
		$arrPage = $data['arrPage'];
		$pageCount = $data['pageCount'];
		$foodKind = $this->getFoodKind();
		// $menu = DataController::getMenuData($foodName, 6);

		return view('data/getFoodKindData', ['name'=>$_SESSION['nl_username'], 'foodName'=>$foodName, 'data'=>$arrRes, 'pageCount'=>$pageCount, "foodKind"=>$foodKind, "kind"=>$kind, "arrPage"=>$arrPage, "page"=>$page]);
	}

	// 指定食物的热量查询

	public function getFoodDataSingle()
	{
		if(empty($_GET['url'])){
			return redirect('data/getFoodData.html');
		}else{
			$tmpurl = htmlspecialchars($_GET['url']);
			// $url = "asda";
		}

		$url = "http://www.boohee.com".$tmpurl;
		// 通过url进行查询数据，
		// 若有，则进行数据库提取，
		// 若没有，则进行爬虫爬取并存储到数据库
		
		// 首先 数据库查询
		$data = DB::table('nl_bh_food_data')->where('url', $url)->get();
		$foodKind = $this->getFoodKind();
		if(!empty($data[0])){
			$arr = array();
			foreach ($data[0] as $key => $value) {
				$arr[$key] = $value;
			}
			DB::table('nl_bh_food_data')->where("url", $url)->update(['looknum'=>(1 + $data[0]->looknum)]);
			$menu = DataController::getMenuData($arr['name'], 6);
			return view('data/getFoodDataSingle', ['name'=>$_SESSION['nl_username'], 'info'=>$arr, "foodKind"=>$foodKind, "menu"=>$menu]);
		}

		// 若是没数据， 就进行爬取
		// 以下是爬取过程 getInfoReferer函数在function.php里
		$result = getInfoRefer($url, $url);
		// $result = str_ireplace(chr(60), "&lt;", $result);
		// $result = str_ireplace(chr(62), "&gt;", $result);

		// 获取信息栏的数据
		$pattern = '/<ul class="basic-infor ">([\w\W]*?)<\/p>/';
		preg_match_all($pattern, $result, $match);
		if(empty($match[1][0])){
			echo js_arr("getDataFailed");
			exit;
		}
		// 获取别名
		$pattern = '/<li><b>别名：<\/b>([\w\W]*?)<\/li>/';
		preg_match_all($pattern, $match[1][0], $bm);
		if(empty($bm[1][0])){
			$bm = "";
		}else{
			$bm = $bm[1][0];
		}
		$pattern = '/<span class="stress red1">([\w\W]*?)<\/span>([\w\W]*?)<\/span>/';
		preg_match_all($pattern, $match[1][0], $rldetail);
		if(empty($rldetail[2][0])){
			$rldetailNum = "";
		}else{
			$rldetailNum = $rldetail[2][0];
		}
		if(empty($rldetail[1][0])){
			$rldetail = "";
		}else{
			$rldetail = $rldetail[1][0];
		}
		$rldetail = $rldetail.$rldetailNum;
		$pattern = '/<li><b>分类：<\/b><strong><a href="([\w\W]*?)">([\w\W]*?)<\/a><\/strong><\/li>/';
		preg_match_all($pattern, $match[1][0], $fl);
		if(empty($fl[1][0])){
			$flUrl = "";
		}else{
			$flUrl = $fl[1][0];
		}
		if(empty($fl[2][0])){
			$fl = "";
		}else{
			$fl = $fl[2][0];
		}
		$pattern = '/<p>[\w\W]*?<b>([\w\W]*?)：<\/b>([\w\W]*+)/';
		preg_match_all($pattern, $match[1][0], $pj);
		if(empty($pj[2][0])){
			$pj_content = "";
		}else{
			$pj_content = $pj[2][0];
		}
		if(empty($pj[1][0])){
			$pj = "";
		}else{
			$pj = $pj[1][0];
		}
		$pj_content = str_replace(array("\n"), array(""), $pj_content);

		// 获取主信息
		$pattern = '/<p class="form-inline"><label>名称：<\/label>([\w\W]*?)<\/p>/';
		preg_match_all($pattern, $result, $matches);
		if(!empty($matches[1][0])){
			$name = $matches[1][0];
		}else{
			$name = "";
		}

		$pattern = '/<img src=\'([\w\W]*?)\' alt="([\w\W]*?)" \/>/';
		preg_match_all($pattern, $result, $match);
		if(!empty($match[1][0])){
			$imgurl = $match[1][0];
		}else{
			$imgurl = "http://s2.boohee.cn/images/can/no-s-illu.gif";
		}

		$pattern = '/<dl class="header">([\w\W]*?)<\/div>/';
		preg_match_all($pattern, $result, $match);
		if(!empty($match[1])){
			$match = $match[1];
		}else{
			// 若是没有相对应的信息就直接调回主页
			//  或者提示没有结果(暂时输出error进行判断)
			echo js_arr("error");
			exit;
		}
		preg_match_all('/<span class="dd">([\w\W]*?)<\/span>/', $match[0], $match);
		if(!empty($match[1])){
			$result = $match[1];
		}else{
			echo js_arr("error");
			exit;
		}
		unset($result[0]);
		unset($result[1]);
		$result[2] = preg_replace(array("/<span([\w\W]*?)>/"), array(""), $result[2]);
		// debug($result);
		// 字段名
		$arr = array(
			"rl",
			"tshhw",
			"zf",
			"dbz",
			"xws",
			"wssa",
			"wssc",
			"wsse",
			"hlbs",
			"las",
			"hhs",
			"ys",
			"dgc",
			"mei",
			"gai",
			"tie",
			"xin",
			"tong",
			"meng",
			"jia",
			"lin",
			"na",
			"xi",
			"name",
			"url",
			"imgurl",
			"tmpurl",
			"bm",
			"pj",
			"pj_content",
			"fl",
			"rldetail",
			"flurl"
		);
		$arrFinal = array();
		$result = array_merge($result, $arrFinal);
		foreach ($result as $key => $value) {
			$arrFinal[$arr[$key]] = $value;
		}
		$arrFinal['name'] = $name;
		$arrFinal['url'] = $url;
		$arrFinal['imgurl'] = $imgurl;
		$arrFinal['tmpurl'] = $tmpurl;
		$arrFinal['bm'] = $bm;
		$arrFinal['pj'] = $pj;
		$arrFinal['pj_content'] = $pj_content;
		$arrFinal['fl'] = $fl;
		$arrFinal['flurl'] = $flUrl;
		$arrFinal['rldetail'] = $rldetail;
		$data = DB::table('nl_bh_food_data')->insert($arrFinal);
		if($data){
			$menu = DataController::getMenuData($name, 6);
			return view('data/getFoodDataSingle', ['name'=>$_SESSION['nl_username'], 'info'=>$arrFinal,  "foodKind"=>$foodKind, "menu"=>$menu]);
		}else{
			echo js_arr("failed");
		}
	}

	// 获取菜品信息
	public static function getMenuData($wd = "秋季", $num = null)
	{
		// 依旧先用数据库查询看看有没有数据
		// 如果没有，
		// 就进行数据抓取并且存到数据库
		
		// 首先，进行数据库查询
		if(empty($num)){
			$data =  DB::table('nl_menu_data')->where('menu_describe', "like", "%".$wd."%")->get();
		}else{
			$data = DB::select("select * from nl_menu_data where menu_describe like '%".$wd."%' limit 0,".$num);
		}
		
		if(!empty($data[0])){
			if(count($data) > 4){
				return $data;
			}
		}
		$get['wd'] = $wd;
		$get['tp'] = "recipe";
		$get = http_build_query($get);
		$url = "http://www.haodou.com/s?".$get;

		$result = getInfoRefer($url, $url);
		// $result = str_ireplace(chr(60), "&lt;", $result);
		// $result = str_ireplace(chr(62), "&gt;", $result);
		$pattern = '/<ul class="showList clearfix" id="the-list">([\w\W]*?)<\/ul>/';
		preg_match_all($pattern, $result, $match);
		// 若是没有数据，就进行关键字截取
		if(empty($match[1][0])){
			$len = mb_strlen($wd, 'utf-8');
			if($len < 3){
				$data = DataController::getMenuData("冬季", $num);
				return $data;
			}
			$wd = mb_substr($wd, 0, 2, "utf-8");
			$data = DataController::getMenuData($wd, $num);
			return $data;
		}

		// 获取标签
		$pattern ='/<p>标签：([\w\W]*?)<\/p>/';
		preg_match_all($pattern, $match[1][0], $matches);
		$pattern = '/<a href="([\w\W]*?)" title="([\w\W]*?)" target="_blank" class="search-target">([\w\W]*?)<\/a>/';
		if(empty($matches[0])){
			echo js_arr("getDataFailed");
			exit;
		}
		$i = 0;
		// 这个是标签的内容，表示有哪些
		$nl = array();
		foreach ($matches[0] as $k => $v) {
			preg_match_all($pattern, $v, $res);
			if(empty($res[2])){
				$nl[$i] = "";
				$i++;
				continue;
			}
			foreach ($res[2] as $key => $value) {
				if(empty($nl[$i])){
					$nl[$i] = $value;
					continue;
				}
				$nl[$i] = $nl[$i].",".$value;
			}
			$i++;
		}
		$pattern = '/<span class="img"><a href="([\w\W]*?)" title="([\w\W]*?)" target="_blank"><img src="([\w\W]*?)" alt="([\w\W]*?)" \/><\/a>/';
		// debug($match[1][0], true);
		preg_match_all($pattern, $match[1][0], $match);
		if(empty($match[1]) || empty($match[3]) || empty($match[4])){
			echo js_arr("getDataFailed");
			exit;
		}
		// 菜谱连接
		$arrUrl = $match[1];
		// 菜谱小图片连接
		$arrImg = $match[3];
		// 菜名
		$arrName = $match[4];
		$arrFinal = array();
		foreach ($arrUrl as $k => $v) {
			$arrFinal[$k]['url'] = "http:".$v."/";
			$arrFinal[$k]['imgurl'] = $arrImg[$k];
			$arrFinal[$k]['name'] = $arrName[$k];
			$arrFinal[$k]['menu_describe'] = $nl[$k];
		}
		$data = DB::table('nl_menu_data')->insert($arrFinal);
		$arrRes = array();
		foreach ($arrFinal as $k => $v) {
			$arrRes[$k] = (object)$arrFinal[$k];
			if($k > 4){
				break;
			}
		}
		if($data){
			return $arrRes;
		}else{
			return "failed";
		}
	}

	// 获取食物分类(获取薄荷)
	public static function getFoodKind()
	{
		$url = "http://www.boohee.com/food/";

		$result = getInfoRefer($url, $url);
		$pattern = '/<ul class="row">([\w\W]*?)<\/ul>/';
		preg_match_all($pattern, $result, $match);
		if(empty($match[0][0])){
			echo js_arr("getDataFailed");
			exit;
		}
		// 获取子分类
		// 首先先把p标签取出来
		$pattern = '/<p>([\w\W]*?)<\/p>/';
		preg_match_all($pattern, $match[0][0], $matches);
		if(empty($matches[1])){
			echo js_arr("getDataFailed");
			exit;
		}
		$arrChildUrl = array();
		$arrChildName = array();
		$pattern = '/<a href = ["|\']([\w\W]*?)["|\']>([\w\W]*?)<\/a>/';
		foreach ($matches[1] as $k => $v) {
			preg_match_all($pattern, $v, $matches);
			$arrChildUrl[$k] = $matches[1];
			$arrChildName[$k] = $matches[2];
		}
		// 获取主分类图片
		$pattern = '/<img src=["|\']([\w\W]*?)["|\']\/>/';
		preg_match_all($pattern, $match[0][0], $matches);
		if(empty($matches[1])){
			echo js_arr("getDataFailed");
			exit;
		}
		$arrImg = $matches[1];
		// 获取主分类
		$pattern = '/<h3><a href=["|\']([\w\W]*?)["|\']>([\w\W]*?)<\/a><\/h3>/';
		preg_match_all($pattern, $match[0][0], $matches);
		if(empty($matches[1] || empty($matches[2]))){
			echo js_arr("getDataFailed");
			exit;
		}
		$arrUrl = $matches[1];
		$arrName = $matches[2];
		$arrFinal = array();
		foreach($arrUrl as $k => $v){
			$arrFinal[$k]['url'] = $arrUrl[$k];
			$arrFinal[$k]['name'] = $arrName[$k];
			$arrFinal[$k]['imgurl'] = $arrImg[$k];
			$arrFinal[$k]['childname'] = $arrChildName[$k];
			$arrFinal[$k]['childurl'] = $arrChildUrl[$k];
		}
		$arrRes = array();
		foreach ($arrFinal as $key => $value) {
			$arrRes[$key] = (object)$arrFinal[$key];
		}
		// debug($arrFinal);
		return $arrRes;
	} 

	// 获取种类分页数据
	public function getFoodKindDataHandle($url)
	{
		// $url = "http://www.boohee.com/food/group/1";
		$result = getInfoRefer($url, $url);

		$pattern = '/<ul class="food-list">([\w\W]*?)<\/ul>/';
		preg_match_all($pattern, $result, $match);
		if(empty($match[1][0])){
			echo js_arr("getDataFailed");
			exit;
		}

		// 获取总分页数
		$pattern = '/([0-9]*?)<\/a> <a class="next_page([\w\W]*?)" rel="next"/';
		preg_match_all($pattern, $result, $matches);
		if(!empty($matches[1][0])){
			$pageCount = $matches[1][0];
		}else{
			// 再次进行匹配是因为有可能用户直接翻到了最后一页，我们也是需要页数的
			$pattern = '/([0-9]*?)<\/em> <span class="next_page disabled">/';
			preg_match_all($pattern, $result, $matches);
			if(!empty($matches[1][0])){
				$pageCount = $matches[1][0];
			}else{
				$pageCount = 0;
			}
		}

		// 获取图片的url
		$pattern = "/<a href=['|\"]([\w\W]*?)['|\"] target=['|\"]_blank['|\"]><img src=['|\"]([\w\W]*?)['|\"]([\w\W]*?)\/><\/a>/";
		preg_match_all($pattern, $match[1][0], $matches);
		if(empty($matches[2])){
			echo js_arr("getDataFailed");
			exit;
		}
		$dataImg = $matches[2];
		// 获取食物名字和食物连接
		$pattern = "/<a href=\"([\w\W]*?)\" title=['|\"]([\w\W]*?)['|\"] target='_blank'>([\w\W]*?)<\/a>/";
		preg_match_all($pattern, $match[1][0], $matches);
		if(empty($matches[1]) || empty($matches[3])){
			echo js_arr("getDataFailed");
			exit;
		}
		$dataUrl = $matches[1];
		$dataName = $matches[3];

		// 获取食物热量
		$pattern = '/<p>热量：([\w\W]*?)<\/p>/';
		preg_match_all($pattern, $match[1][0], $matches);
		if(!empty($matches[1])){
			$dataPower = $matches[1];
		}else{
			echo js_arr("getDataPowerFailed");
			exit;
		}
		$arrFinal = array();
		$arrRes = array();
		foreach ($dataUrl as $k => $v) {
			$arrFinal[$k]['url'] = $v;
			$arrFinal[$k]['name'] = $dataName[$k];
			$arrFinal[$k]['imgurl'] = $dataImg[$k];
			$arrFinal[$k]['power'] = $dataPower[$k];
		}
		foreach ($arrFinal as $k => $v) {
			$arrRes[$k] = (object)$arrFinal[$k];
		}
		$arrPage = array();
		for($i=1; $i<=$pageCount; $i++){
			$arrPage[$i-1] = $i;
		}
		$arr = array(
			"arrPage" => $arrPage,
			"res" => $arrRes,
			"pageCount" => $pageCount
		);
		return $arr;
	}

	public static function getMenuDataDetailHandle($url)
	{

		$result = getInfoRefer($url, $url);

		// $result = str_replace(chr(60), "&lt", $result);
		// $result = str_replace(chr(62), "&gt", $result);
		
		// 获取菜品名
		$pattern = '/<div class="box">([\w\W]*?)<\/div>/';
		preg_match_all($pattern, $result, $match);
		if(empty($match[1][0])){
			echo js_arr("getDataFailed");
			exit;
		}
		$pattern = '/<h1 id="stitle" class="fl"><a target="_blank" href="[\w\W]*?">([\w\W]*?)<\/a><\/h1>/';
		preg_match_all($pattern, $match[1][0], $matches);
		if(empty($matches[1][0])){
			$pattern = '/<h1 class="fl" id="stitle" title="[\w\W]*?">([\w\W]*?)<\/h1>/';
			preg_match_all($pattern, $match[1][0], $matches);
			if(empty($matches[1][0])){
				echo js_arr("getFoodNameFailed");
				exit;
			}else{
				$foodName = $matches[1][0];;
			}
		}else{
			$foodName = $matches[1][0];
		}

		// 获取主要信息，包括做法
		$pattern = '/<div class="intro">([\w\W]*?)<dl class="step">([\w\W]*?)<\/dl>[\w\W]*?<\/div>/';
		preg_match_all($pattern, $result, $match);
		if(empty($match[1][0]) || empty($match[2][0])){
			echo js_arr("getDataFailed");
			exit;
		}
		// 获取小提示
		$pattern = '/<dl class="prompt">([\w\W]*?)<\/dl>/';
		preg_match_all($pattern, $result, $matches);
		if(empty($matches[1][0])){
			echo js_arr("getDataFailed");
			exit;
		}
		$pattern = '/<span data="[\w\W]*?" id="stips">([\w\W]*?)<\/span>/';
		preg_match_all($pattern, $matches[1][0], $matches);
		if(empty($matches[1][0])){
			echo js_arr("getDataFailed");
			exit;
		}
		$stips = $matches[1][0];

		// 获取时间与份量
		$pattern = '/<div class="material box">([\w\W]*?)<\/div>/';
		preg_match_all($pattern, $match[1][0], $matches);
		if(empty($matches[1][0])){
			$time = array();
			$timeRemind = array();
		}else{
			$pattern = '/<p>([\w\W]*?)<\/p>/';
			preg_match_all($pattern, $matches[1][0], $matches1);
			if(empty($matches1[1])){
				echo js_arr("getDataFailed");
				exit;
			}
			$timeRemind = $matches1[1];
			$pattern = '/<span>([\w\W]*?)<\/span>/';
			preg_match_all($pattern, $matches[1][0], $matches2);
			if(empty($matches2[1])){
				echo js_arr("getDataFailed");
				exit;
			}
			$time = $matches2[1];
		}

		// 获取食材
		$pattern = '/<div class="material" id="recipe_ingt">([\w\W]*?)<\/div>/';
		preg_match_all($pattern, $match[1][0], $matches);
		if(empty($matches[1][0])){
			$pattern = '/<div class="material box" id="recipe_ingt">([\w\W]*?)<\/div>/';
			preg_match_all($pattern, $match[1][0], $matches);
			if(empty($matches[1][0])){
				echo js_arr("getFoodFailed");
				exit;
			}
		}
		// 获取主料
		$pattern = '/<li class="ingtmgr"><p class="name"><a href="[\w\W]*?" target="_blank"[\w\W]*?>([\w\W]*?)<\/a>/';
		preg_match_all($pattern, $matches[1][0], $matches1);
		if(empty($matches1[1])){
			$mainFood = array();
		}else{
			$mainFood = $matches1[1];
		}

		// 获取辅料
		$pattern = '/<li class="ingtbur"><p class="name">([\w\W]*?)<\/p>/';
		preg_match_all($pattern, $matches[1][0], $matches1);
		if(empty($matches1[1])){
			$assistFood = array();
		}else{
			$assistFood = $matches1[1];
		}

		// 获取主料和辅料的具体需求量
		$pattern = '/<span class="amount">([\w\W]*?)<\/span>/';
		preg_match_all($pattern, $matches[1][0], $matches1);
		if(empty($matches1[1])){
			$foodContent = array();
		}else{
			$foodContent = $matches1[1];
		}

		// 获取步骤的图片及其说明
		$pattern = '/<img src="([\w\W]*?)" width="[\w\W]*?" \/>/';
		preg_match_all($pattern, $match[2][0], $matches);
		if(empty($matches[1])){
			$stepImg = array();
		}else{
			$stepImg = $matches[1];
		}

		$pattern = '/<p class="sstep"><em>[\w\W]*?<\/em>([\w\W]*?)<\/p>/';
		preg_match_all($pattern, $match[2][0], $matches);
		if(empty($matches[1])){
			$step = array();
		}else{
			$step = $matches[1];
		}

		$arrFinal = array();
		$arrFinal['name'] = $foodName;
		$arrFinal['stips'] = $stips;
		$arrFinal['time'] = $time;
		$arrFinal['timeRemind'] = $timeRemind;
		$arrFinal['mainFood'] = $mainFood;
		$arrFinal['assistFood'] = $assistFood;
		$arrFinal['foodContent'] = $foodContent;
		$arrFinal['stepImg'] = $stepImg;
		$arrFinal['step'] = $step;

		return $arrFinal;
	}

	public function getFoodDataTest()
	{
		$url = "http://www.haodou.com/recipe/951281/";

		$result = getInfoRefer($url, $url);

		// $result = str_replace(chr(60), "&lt", $result);
		// $result = str_replace(chr(62), "&gt", $result);
		
		// 获取菜品名
		$pattern = '/<div class="box">([\w\W]*?)<\/div>/';
		preg_match_all($pattern, $result, $match);
		if(empty($match[1][0])){
			echo js_arr("getDataFailed");
			exit;
		}
		$pattern = '/<h1 id="stitle" class="fl"><a target="_blank" href="[\w\W]*?">([\w\W]*?)<\/a><\/h1>/';
		preg_match_all($pattern, $match[1][0], $matches);
		if(empty($matches[1][0])){
			$pattern = '/<h1 class="fl" id="stitle" title="[\w\W]*?">([\w\W]*?)<\/h1>/';
			preg_match_all($pattern, $match[1][0], $matches);
			if(empty($matches[1][0])){
				echo js_arr("getFoodNameFailed");
				exit;
			}else{
				$foodName = $matches[1][0];;
			}
		}else{
			$foodName = $matches[1][0];
		}

		// 获取主要信息，包括做法
		$pattern = '/<div class="intro">([\w\W]*?)<dl class="step">([\w\W]*?)<\/dl>[\w\W]*?<\/div>/';
		preg_match_all($pattern, $result, $match);
		if(empty($match[1][0]) || empty($match[2][0])){
			echo js_arr("getDataFailed");
			exit;
		}
		// 获取小提示
		$pattern = '/<dl class="prompt">([\w\W]*?)<\/dl>/';
		preg_match_all($pattern, $result, $matches);
		if(empty($matches[1][0])){
			echo js_arr("getDataFailed");
			exit;
		}
		$pattern = '/<span data="[\w\W]*?" id="stips">([\w\W]*?)<\/span>/';
		preg_match_all($pattern, $matches[1][0], $matches);
		if(empty($matches[1][0])){
			echo js_arr("getDataFailed");
			exit;
		}
		$stips = $matches[1][0];

		// 获取时间与份量
		$pattern = '/<div class="material box">([\w\W]*?)<\/div>/';
		preg_match_all($pattern, $match[1][0], $matches);
		if(empty($matches[1][0])){
			$time = array();
			$timeRemind = array();
		}else{
			$pattern = '/<p>([\w\W]*?)<\/p>/';
			preg_match_all($pattern, $matches[1][0], $matches1);
			if(empty($matches1[1])){
				echo js_arr("getDataFailed");
				exit;
			}
			$timeRemind = $matches1[1];
			$pattern = '/<span>([\w\W]*?)<\/span>/';
			preg_match_all($pattern, $matches[1][0], $matches2);
			if(empty($matches2[1])){
				echo js_arr("getDataFailed");
				exit;
			}
			$time = $matches2[1];
		}

		// 获取食材
		$pattern = '/<div class="material" id="recipe_ingt">([\w\W]*?)<\/div>/';
		preg_match_all($pattern, $match[1][0], $matches);
		if(empty($matches[1][0])){
			$pattern = '/<div class="material box" id="recipe_ingt">([\w\W]*?)<\/div>/';
			preg_match_all($pattern, $match[1][0], $matches);
			if(empty($matches[1][0])){
				echo js_arr("getFoodFailed");
				exit;
			}
		}
		// 获取主料
		$pattern = '/<li class="ingtmgr"><p class="name"><a href="[\w\W]*?" target="_blank"[\w\W]*?>([\w\W]*?)<\/a>/';
		preg_match_all($pattern, $matches[1][0], $matches1);
		if(empty($matches1[1])){
			$mainFood = array();
		}else{
			$mainFood = $matches1[1];
		}

		// 获取辅料
		$pattern = '/<li class="ingtbur"><p class="name">([\w\W]*?)<\/p>/';
		preg_match_all($pattern, $matches[1][0], $matches1);
		if(empty($matches1[1])){
			$assistFood = array();
		}else{
			$assistFood = $matches1[1];
		}

		// 获取主料和辅料的具体需求量
		$pattern = '/<span class="amount">([\w\W]*?)<\/span>/';
		preg_match_all($pattern, $matches[1][0], $matches1);
		if(empty($matches1[1])){
			$foodContent = array();
		}else{
			$foodContent = $matches1[1];
		}

		// 获取步骤的图片及其说明
		$pattern = '/<img src="([\w\W]*?)" width="[\w\W]*?" \/>/';
		preg_match_all($pattern, $match[2][0], $matches);
		if(empty($matches[1])){
			$stepImg = array();
		}else{
			$stepImg = $matches[1];
		}

		$pattern = '/<p class="sstep"><em>[\w\W]*?<\/em>([\w\W]*?)<\/p>/';
		preg_match_all($pattern, $match[2][0], $matches);
		if(empty($matches[1])){
			$step = array();
		}else{
			$step = $matches[1];
		}

		$arrFinal = array();
		$arrFinal['name'] = $foodName;
		$arrFinal['stips'] = $stips;
		$arrFinal['time'] = $time;
		$arrFinal['timeRemind'] = $timeRemind;
		$arrFinal['mainFood'] = $mainFood;
		$arrFinal['assistFood'] = $assistFood;
		$arrFinal['foodContent'] = $foodContent;
		$arrFinal['stepImg'] = $stepImg;
		$arrFinal['step'] = $step;

		return $arrFinal;
	}
}