<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Mail;

class LoginController extends Controller
{
	public function __construct()
	{
		session_start();
		if(empty($_SESSION['validate_count'])){
			$_SESSION['validate_count'] = 0;
		}
	}

	public function index()
	{
		if(!empty($_SESSION['nl_username'])){
			return redirect('index/index.html');
		}
		return view('login/index');
	}

	public function loginHandle()
	{
		if(!empty($_SESSION['nl_username'])){
			echo js_arr("login");
			exit;
		}
		if($_SESSION['validate_count']>=3){
			echo js_arr("validate");
			exit;
		}
		if(!$_POST['username'] || !$_POST['password']){
			echo js_arr("failed");
			$_SESSION['validate_count'] += 1;
			exit;
		}
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		$data = DB::table('nl_user')->where('phone', $username)->get();
		if(!empty($data[0])){
			if($data[0]->password == md5($password)){
				$_SESSION['nl_username'] = $data[0]->username;
				$_SESSION['nl_access'] = $data[0]->access;
				$_SESSION['nl_phone'] = $data[0]->phone;
				$_SESSION['validate_count'] += 1;
				echo js_arr("ok");
			}else{
				echo js_arr("error_password");
				$_SESSION['validate_count'] += 1;
			}
		}else{
			echo js_arr("error_user");
			$_SESSION['validate_count'] += 1;
		}

	}

	public function loginExit()
	{
		$_SESSION['nl_username'] = null;
		$_SESSION['nl_access'] = null;
		$_SESSION['nl_phone'] = null;
		echo js_arr("ok");
	}

	public function register()
	{
		return view('login/register', ['name'=>$_SESSION['nl_username']]);
	}


	public function registerHandle()
	{
		if(empty($_POST['phone']) || empty($_POST['name']) || empty($_POST['password'])){
			echo js_arr("failed");
			exit;
		}
		$phone = htmlspecialchars($_POST['phone']);
		$name = htmlspecialchars($_POST['name']);
		$password = htmlspecialchars($_POST['password']);
		if(!$name || !$phone || !$password){
			echo js_arr("failed");
			exit;
		}
		if(!phoneCheck($phone)){
			echo js_arr("phoneFailed");
			exit;
		}
		if(mb_strlen($name) > 10){
			echo js_arr("nameFailed");
			exit;
		}
		if(strlen($password) > 16){
			echo js_arr("passwordFailed");
			exit;
		}
		$data = DB::table('nl_user')->where("phone", $phone)->get();
		if(!empty($data[0])){
			echo js_arr("exist");
			exit;
		}
		$password = md5($password);
		
		$arr = array(
			"username" => $name,
			"password" => $password,
			"phone" => $phone,
			"access" => 1
		);
		$data = DB::table("nl_user")->insert($arr);
		if($data){
			echo js_arr("ok");
		}else{
			echo js_arr("failed");
		}
	}

	// 修改密码验证邮件发送
	public function sendMail()
	{
		$email = "1023767856@qq.com";
		$name = "宋节";
		$result = Mail::send('email/changePassword',['name'=>$name],function($message) use ($email){
			$message->subject("修改密码");
			$message->to($email);
		});
		if(!$result){
			echo js_arr("error_email")."\n";
			exit;
		}
		if($result){
			echo "成功给".$name."发送邮件(".$email.")\n";
		}
	}
}