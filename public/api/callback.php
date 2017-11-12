<?php
include 'include/mysql_connect_set.php';
require_once 'function.php';
require_once 'Connect2.1/qqConnectAPI.php';
$oauth = new Oauth();
$accesstoken = $oauth->qq_callback();
$openid = $oauth->get_openid();
$_SESSION['qq_accesstoken'] = $accesstoken;
$_SESSION['qq_openid'] = $openid;
$qc = new QC($_SESSION['qq_accesstoken'],$_SESSION['qq_openid']);
$userinfo = $qc->get_user_info();
$db->dbconnect();
$db->dbresult("select * from nl_user where qq_openid='".$_SESSION['qq_openid']."'");
$row = $db->dbrow($db->result);
$db->dbclose();
if(!empty($row)){
	$_SESSION['nl_username'] = $row['username'];
	$_SESSION['nl_phone'] = $row['phone'];
	$_SESSION['nl_access'] = $row['access'];
	header("Location: http://nl.tan90.club/index/index.html"); 
}else{
	$_SESSION['nl_username'] = $userinfo['nickname'];
	$_SESSION['nl_phone'] = null;
	$_SESSION['nl_access'] = 1;
	$username = $userinfo['nickname'];
	$phone = null;
	$access = 1;
	$qq_openid = $_SESSION['qq_openid'];
	$password = null;
	$db->dbconnect();
	$db->dbresult("insert into nl_user(username,password,access,phone,qq_openid)values('$username','$password','$access','$phone','$qq_openid')");
	$db->dbclose();
}
header("Location: http://nl.tan90.club/index/index.html");