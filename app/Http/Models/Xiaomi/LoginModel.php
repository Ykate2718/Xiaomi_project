<?php
namespace App\Http\Models\Xiaomi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoginModel extends Model
{

    /**
     * 登录验证
     *
     * @param $where 需要查询验证的用户账号            
     */
    public function doLogin($where)
    {
        return DB::table("user")->where($where)->first();
    }

    /**
     * 注册
     *
     * @param $values 用户填写的内容填入数据库            
     */
    public function register($values)
    {
        return DB::table('user')->insert($values);
    }
}