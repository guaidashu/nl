<?php
class db_mysql{
      var $dbLocalhost;
	  var $dbDatabase;
	  var $dbUser;
	  var $dbPassword;
	  var $dblink;
	  var $result;
	  var $row_num;
	  var $row;
	  function dbconnect(){//链接数据库
		  $this->dblink=mysqli_connect($this->dbLocalhost,$this->dbUser,$this->dbPassword) or die("connect false");
		  mysqli_select_db($this->dblink,$this->dbDatabase);
		  mysqli_query($this->dblink,"set names utf8");
	  }
	  function dbresult($q){//获取执行语句并执行
		  $this->result=mysqli_query($this->dblink,$q);
	  }
	  function dbrow($result){//获取数据库里面内容的值
		  $this->row=mysqli_fetch_assoc($result);
		  return $this->row;
	  }
	  function dbrow_num($result){
		  $this->row_num=mysqli_num_rows($result);
	  }
	  function dbclose(){//关闭数据库
		  mysqli_close($this->dblink);
	  }
	  function dbfree($result){
		  mysqli_free_result($result);
	  }
	  function dbGetId(){
	  	  $data=mysqli_insert_id($this->dblink);
	  	  return $data;
	  }
}
?>