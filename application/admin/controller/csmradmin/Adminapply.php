<?php

namespace app\admin\controller\csmradmin;

use addons\csmradmin\library\CsmBackend;
use app\admin\model\Admin;
use think\Request;

/**
 * 管理员注册申请管理
 *
 * @icon fa fa-circle-o
 */
class Adminapply extends CsmBackend
{

    /**
     * Adminapply模型对象
     *
     * @var \app\admin\model\csmradmin\Adminapply
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\csmradmin\Adminapply();
        $this->view->assign("auditstatusList", $this->model->getAuditstatusList());
    }


    /**
     * 审核通过
     */
    public function submitauditok($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            $auth_group_ids = $params['auth_group_ids'];

            $admin = Admin::getByUsername($row->username);
            if ($admin != null) {
                $this->error(__('用户名已被注册，无法审核通过'));
                return;
            }
            $admin = Admin::getByEmail($row->email);
            if ($admin != null) {
                $this->error(__('邮箱已被注册，无法审核通过'));
                return;
            }

            //创建管理员帐号
            $params = [
                'username'     => $row->username,
                'nickname'     => $row->nickname,
                'salt'         => $row->salt,
                'password'     => $row->password,
                'email'        => $row->email,
                'loginfailure' => 0,
                'salt'         => $row->salt,
                'avatar'       => '/assets/img/avatar.png'
            ];
            $admindao = new \app\admin\model\Admin();
            $admindao->save($params);
            $adminid = $admindao->getLastInsID();

            //分配角色权限
            $auth_group_idarray = explode(",", $auth_group_ids);
            $dataset = [];
            foreach ($auth_group_idarray as $value) {
                $dataset[] = [
                    'uid'      => $adminid,
                    'group_id' => $value
                ];
            }
            $dao = new \app\admin\model\AuthGroupAccess();
            $dao->saveAll($dataset);

            //更新审核状态
            $sessionuser = $this->auth;
            $params = [
                "relate_admin_id" => $adminid,
                "auditstatus"     => "1",
                "auditreturn"     => "",
                "audituser_id"    => $sessionuser->id,
                "audituser"       => $sessionuser->username,
                "auth_group_ids"  => $auth_group_ids,
                "updatetime"      => time()
            ];
            $row->allowField(true)->save($params);

            // 通过发送邮件
            $config = get_addon_config("csmradmin");
            $emailtitle = $config["auditokemailtitle"];
            $emailcontent = $config["auditokemailcontent"];

            $email = $row->email;
            trace("Emslib.send({$email},{$emailtitle})");
            $obj = \app\common\library\Email::instance();
            $obj->to($email)
                ->subject($this->convertMailContent($emailtitle, $row))
                ->message($this->convertMailContent($emailcontent, $row))
                ->send();
            $this->success();
        }
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }

    /**
     * 审核退回
     */
    public function submitauditreturn($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            $auditreturn = $params['auditreturn'];
            $sessionuser = $this->auth;
            $params = [
                "auditstatus"  => "-1",
                "auditreturn"  => $auditreturn,
                "audituser_id" => $sessionuser->id,
                "audituser"    => $sessionuser->username,
                "updatetime"   => time()
            ];
            $row->allowField(true)->save($params);

            // 退回发送邮件
            $config = get_addon_config("csmradmin");
            $emailtitle = $config["auditreturnemailtitle"];
            $emailcontent = $config["auditreturnemailcontent"];

            $email = $row->email;
            trace("Emslib.send({$email},{$emailtitle})");
            $obj = \app\common\library\Email::instance();
            $obj->to($email)
                ->subject($this->convertMailContent($emailtitle, $row))
                ->message($this->convertMailContent($emailcontent, $row))
                ->send();
            $this->success();
        }
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }

    public function view($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }

    private function convertMailContent($str, $apply)
    {
        $str = str_replace('%nickname%', $apply->nickname, $str);
        $str = str_replace('%username%', $apply->username, $str);
        $str = str_replace('%email%', $apply->email, $str);
        $str = str_replace('%auditreturn%', $apply->auditreturn, $str);
        $loginurl = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . $this->request->root() . "/index/login";
        $str = str_replace('%loginurl%', $loginurl, $str);
        return $str;
    }


    /**
     * 查看
     */
    public function selectindex()
    {
        $this->request->filter([
            'strip_tags'
        ]);
        $this->model = new \app\admin\model\AuthGroup();
        if ($this->request->request('keyField')) {
            return $this->selectpage();
        }
    }

}
