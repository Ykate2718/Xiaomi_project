<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;

// 注册验证码
require_once '../resources/org/code/Code.class.php';
// 登录验证码
require_once '../resources/org/code/Code2.class.php';

class Login extends Controller
{

    // 渲染登录页面以及登录效验
    public function dologin(Request $requset)
    {
        // if (Input::all()) {}
        if (request()->ajax()) {
            // 验证码效验
            $code = new \Code2();
            $_code = strtolower($code->getcode());
            $param = $requset->input();
            
            if ($param['code'] != $_code) {
                $arrs = array(
                    'status' => 0,
                    'msg' => '验证码有误'
                );
                exit(json_encode($arrs));
            }
            
            // 账号密码效验
            $where = [
                [
                    'user_name',
                    '=',
                    $param['username']
                ]
            ];
            $LoginModel = new \App\Http\Models\Xiaomi\LoginModel();
            $result = $LoginModel->doLogin($where);
            if (! $result) {
                $arrs = array(
                    'status' => 0,
                    'msg' => '账号不存在'
                );
                exit(json_encode($arrs));
            }
            
            if ($param['password'] != Crypt::decrypt($result->user_password)) {
                $arrs = array(
                    'status' => 0,
                    'msg' => '密码错误'
                );
                exit(json_encode($arrs));
            }
            $arrs = array(
                'status' => 1,
                'msg' => '登录成功'
            );
            exit(json_encode($arrs));
        } else {
            return view('xiaomi/login');
        }
    }

    // 渲染注册页面以及注册效验
    public function register(Request $request)
    {
        if (request()->ajax()) {
            
            // 验证码效验
            $code = new \Code();
            $_code = strtolower($code->getcode());
            $param = $request->input();
            
            if ($param['code'] != $_code) {
                $arrs = array(
                    'status' => 0,
                    'msg' => '验证码有误'
                );
                exit(json_encode($arrs));
            }
            
            if ($param['username'] == "") {
                $arrs = array(
                    'status' => 0,
                    'msg' => '账号不能为空'
                );
                exit(json_encode($arrs));
            }
            
            if ($param['password'] != $param['repassword']) {
                $arrs = array(
                    'status' => 0,
                    'msg' => '两次密码不一致'
                );
                exit(json_encode($arrs));
            }
            if ((strlen($param['tel'])) != 11) {
                $arrs = array(
                    'status' => 0,
                    'msg' => '手机号不符合要求'
                );
                exit(json_encode($arrs));
            }
            
            $values = [
                'user_name' => $param['username'],
                'user_password' => Crypt::encrypt($param['password']),
                'user_phone' => $param['tel']
            ];
            $LoginModel = new \App\Http\Models\Xiaomi\LoginModel();
            $result = $LoginModel->register($values);
            if ($result) {
                $arrs = array(
                    'status' => 1,
                    'msg' => '注册成功'
                );
                exit(json_encode($arrs));
            } else {
                $arrs = array(
                    'status' => 0,
                    'msg' => '注册失败'
                );
                exit(json_encode($arrs));
            }
        } else {
            return view('xiaomi/register');
        }
    }

    public function code()
    {
        $code = new \Code();
        $code->outimg();
    }

    public function code2()
    {
        $code = new \Code2();
        $code->outimg();
    }

    public function getcode()
    {
        $code = new \Code();
        echo $code->getcode();
    }
}


