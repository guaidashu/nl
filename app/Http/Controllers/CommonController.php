<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class CommonController extends Controller
{
	public function __construct()
	{
		session_start();
	}

	public function getImg()
	{
		// 因为薄荷的图片加了防盗链（我猜测的，反正要伪造一个referer来试试）
		$imgurl = $_GET['imgurl'];
		// $imgurl = "http://s2.boohee.cn/house/food_mid/mid_photo_201513114533765.jpg";
		$result = $this->getImgInfoRefer($imgurl, "http://www.boohee.com/");
		echo $result;
	}

	//需要加域名请求的信息获取
	public function getImgInfoRefer($url, $refer = null, $cookie = null)
	{
	    // 伪造Ip
	    $ip = virtualIp();
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_USERAGENT, "baiduspider");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('CLIENT-IP:'.$ip, 'X-FORWARDED-FOR:'.$ip)); 
	    curl_setopt($ch, CURLOPT_REFERER, $refer);
	    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    return $result;
	}
}