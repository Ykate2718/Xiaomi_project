<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Index extends Controller
{

    // 渲染首页面
    public function index()
    {
        return view('xiaomi/index');
    }

    // 数据库练习
    public function db()
    {
        // @if(session('msg'))
        // {{session('msg')}}
        // @endif
        // $users = DB::table("user")->where($where)->first();
        // dd($users);
    }
}