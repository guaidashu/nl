<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TestModel extends Model
{
	//数据插入函数
	public function dataInsert($arr)
	{
		if(empty($arr)){
			return false;
		}
		$data=DB::table('test')->insert($arr);
		return $data;
	}

	//数据查询函数
	public function getData()
	{
		$data=DB::table('test')->get();
		return $data;
	}
}