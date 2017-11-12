<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class ValidateController extends Controller
{
	public function __construct()
	{
		session_start();
		if(empty($_SESSION['validate_count'])){
			$_SESSION['validate_count']=0;
		}
	}
	public function validate()
	{
		$image=imagecreatetruecolor(100,30);
		header('content-type:image/png');
		$bgcolor=imagecolorallocate($image,255,255,255);
		imagefill($image,0,0,$bgcolor);
		/*for($i=0;$i<4;$i++){
			$fontsize=8;
			$fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
			$fontcontent=rand(0,9);
			$x=($i*100/4+rand(5,10));
			$y=rand(5,10);
			imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
		}*/
		$check=0;
		$value1=0;
		$value2=0;
		$value3="+";
		for($i=0;$i<4;$i++){
			$fontsize=6;
		    $fontcolor=imagecolorallocate($image,rand(10,120),rand(10,120),rand(10,120));
			$data='0123456789';
			$fontcontent=substr($data,rand(0,strlen($data)-1),1);
			$x=($i*100/4+rand(5,10));
			$y=rand(5,10);
			if($i==0){
				$value1=$fontcontent;
			}
			if($i==1){
				$tmpRand=intval(rand(0,30))%3;
				if($tmpRand==3){
					$tmpRand=2;
				}
				switch ($tmpRand){
					case 0:$fontcontent="+";break;
					case 1:$fontcontent="-";break;
					case 2:$fontcontent="*";break;
				}
				$value3=$fontcontent;
			}
			if($i==2){
				$value2=$fontcontent;
			}
			if($i==3){
				$fontcontent="=";
			}
			imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
		}
		switch ($value3) {
			case "+":$check=$value1+$value2;break;
			case "-":$check=$value1-$value2;break;
			case "*":$check=$value1*$value2;break;
		}
		$_SESSION['validate']=$check;
		for($i=0;$i<200;$i++){
			$pointcolor=imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));
			imagesetpixel($image,rand(1,99),rand(1,29),$pointcolor);
		}
		for($i=0;$i<3;$i++){
			$linecolor=imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
			imageline($image,rand(1,99),rand(1,29),rand(1,29),rand(1,29),$linecolor);
		}
		imagepng($image);
		imagedestroy($image);
	}

	public function getValidateCount()
	{
		if(empty($_SESSION['validate_count'])){
			$_SESSION['validate_count']=0;
		}
		echo js_arr($_SESSION['validate_count']);
	}

	public function validateCheck()
	{
		$validate=htmlspecialchars($_POST['validate']);
		if($validate!=$_SESSION['validate']){
			echo js_arr("failed");
		}else{
			$_SESSION['validate_count']=0;
			echo js_arr("ok");
		}
	}
}