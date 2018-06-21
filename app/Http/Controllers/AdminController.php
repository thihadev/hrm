<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\User;
use Cache;
use Carbon\Carbon;

class AdminController extends Controller
{

	 public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index()
    {
    	return view('admin.home');
    }

    public function admin()
	{
		$users = User::all();
		return view('admin.home', compact("users"));
	}
}
