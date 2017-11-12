<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class TestController extends Controller
{
	public function __construct()
	{
		session_start();
	}

	public function testReferer()
	{
		return view('test/testReferer');
	}

	public function testGetIP()
	{
		$ip = htmlspecialchars($_POST['ip']);
		$referer = htmlspecialchars($_POST['referer']);
		if(empty($_COOKIE['html_control_ip'])){
			setcookie("html_control_ip", $ip, time()+60);
			$str = "来自 ".$referer." 的访问   ip段为： ".$ip."  访问次数：5\n";
			$fileName = "iplog/".date('Y-m-d',time()).".log";
			file_put_contents($fileName, $str, FILE_APPEND);
		}else{
			$oldIP = $_COOKIE['html_control_ip'];
			if($oldIP == $ip){
				echo js_arr("已经提交");
				exit;
			}
		}
		echo js_arr($ip.", ".$referer);
	}
}