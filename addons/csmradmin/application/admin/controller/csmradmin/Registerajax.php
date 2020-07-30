<?php

namespace app\admin\controller\csmradmin;

use app\common\library\Ems as Emslib;
use addons\csmradmin\library\CsmBackend;
use app\admin\model\Admin;
use think\Session;
use fast\Random;

class Registerajax extends CsmBackend
{
    protected $layout = 'default';

    protected $noNeedLogin = [
        '*'
    ];

    protected $noNeedRight = [
        '*'
    ];

    public function index()
    {
        $this->error("当前插件暂无前台页面");
    }

    /**
     * 管理员注册发送邮件验证码
     */
    public function sendccode()
    {
        $email = strtolower($this->csmreq("email", true));
        $event = "csmradmin_reg";
        $last = Emslib::get($email, $event);
        if ($last && time() - $last['createtime'] < 60) {
            $this->error(__('发送频繁'));
        }
        if ($event) {
            $admin = Admin::getByEmail($email);
            if ($admin != null) {
                $this->error(__('已被注册'));
            }
            $adminapplydao = new \app\admin\model\csmradmin\Adminapply();
            $apply = $adminapplydao->where("email", "=", $email)->where("auditstatus", "=", "0")->find();
            if ($apply != null) {
                $this->error(__('您的申请待审核中，请耐心等候'));
            }
        }
        $rand = mt_rand(1000, 9999);
        trace("Emslib.send({$email},{$rand},{$event})");
        \think\Hook::add('ems_send', function ($params) {
            $obj = \app\common\library\Email::instance();
            $result = $obj->to($params->email)
                ->subject('验证码')
                ->message("你的验证码是：" . $params->code)
                ->send();
            return $result;
        });
        $ret = Emslib::send($email, $rand, $event);
        if ($ret) {
            session::set("csmradmin_registerccode", $rand);
            session::set("csmradmin_registerccode_email", $email);
            $this->success(__('发送成功'));
        } else {
            $this->error(__('发送失败'));
        }
    }

    /**
     * 管理员注册提交
     */
    public function register()
    {
        $username = $this->csmreq("username", true);
        $ccode = $this->csmreq("ccode", true);
        $password = $this->csmreq("password", true);
        $nickname = $this->csmreq("nickname", true);
        $email = strtolower($this->csmreq("email", true));
        $ip = $this->request->ip();

        $sccode = session::get("csmradmin_registerccode");
        $sccodeemail = session::get("csmradmin_registerccode_email");
        if ($sccode != $ccode || $sccodeemail != $email) {
            $this->error(__('验证码错误'));
            return;
        }

        $admin = Admin::getByUsername($username);
        if ($admin != null) {
            $this->error(__('用户名已被注册'));
            return;
        }
        $admin = Admin::getByEmail($email);
        if ($admin != null) {
            $this->error(__('邮箱已被注册'));
            return;
        }
        $adminapplydao = new \app\admin\model\csmradmin\Adminapply();
        $apply = $adminapplydao->where("email", "=", $email)->where("auditstatus", "=", "0")->find();
        if ($apply != null) {
            $this->error(__('您的申请待审核中，请耐心等候'));
        }
        $salt = Random::alnum();
        $mipassword = md5(md5($password) . $salt);

        $adminapplydao = new \app\admin\model\csmradmin\Adminapply();
        $param = [
            "username"    => $username,
            "nickname"    => $nickname,
            "password"    => $mipassword,
            "salt"        => $salt,
            "email"       => $email,
            "ip"          => $ip,
            "auditstatus" => "0",
            "createtime"  => time()
        ];
        $adminapplydao->create($param);
        $this->success(__('申请已提交，请耐心等待审核；审核通过后会通过邮件通知您。'));
    }


}
