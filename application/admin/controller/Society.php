<?php

namespace app\admin\controller;

use app\common\controller\Backend;

/**
 * 测试管理
 *
 * @icon fa fa-circle-o
 */
class Society extends Backend
{
    
    /**
     * Society模型对象
     * @var \app\admin\model\Society
     */
    protected $model = null;
	
	protected $noNeedRight = ['selectpage'];
    protected $dataLimit = 'auth';
    protected $dataLimitField = 'admin_id';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Society;
        $this->view->assign("genderdataList", $this->model->getGenderdataList());
        $this->view->assign("flagList", $this->model->getFlagList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    
public function index()
    {
        $this->relationSearch = true;
        $this->searchFields = "admin.username,id";
        if ($this->request->isAjax()) {
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model 
                    ->with('admin')                   
                    ->where($where)
                    ->order($sort, $order)
                    ->count();
            $list = $this->model 
            ->with('admin')                  
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();
                    $list = addtion($list, [
            [
                'field'    => 'admin_ids',
                'display'  => 'admin_nicknames',
                'primary'  => 'id',
                'column'   => 'nickname',
                'model'    => '\app\admin\model\Admin',
                'name'     => 'Admin',
                'table'    => 'Admin'
            ]
        ]);
        $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }
}
