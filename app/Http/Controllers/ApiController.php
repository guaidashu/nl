<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class ApiController extends Controller
{
	public function __construct()
	{
		session_start();
	}
}