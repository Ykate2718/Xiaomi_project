<?php
namespace App\Http\Controllers;

use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;

class HelperController extends Controller
{

    public function index()
    {
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder();
        // 可以设置图片宽高及字体
        $builder->build($width = 250, $height = 70, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        session()->flash('milkcaptcha', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    // 验证注册码的正确与否
    public function verifyCaptcha()
    {
        $userInput = request('captcha');
        if (session('milkcaptcha') == $userInput) {
            // 用户输入验证码正确
            return $this->outPutJson('', 200, '验证码正确！');
        } else {
            // 用户输入验证码错误
            return $this->outPutJson('', 301, '验证码输入错误！');
        }
    }
}