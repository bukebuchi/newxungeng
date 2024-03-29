<?php

namespace app\admin\controller;

use app\common\controller\Backend;

/**
 * 测试管理
 *
 * @icon fa fa-circle-o
 */
class Disputetest extends Backend
{
    
    /**
     * Disputetest模型对象
     * @var \app\admin\model\Disputetest
     */
    protected $model = null;
    //protected $noNeedRight = [''];
    protected $dataLimit = 'auth';
    protected $dataLimitField = 'admin_id';
    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Disputetest;
        $this->view->assign("genderdataaList", $this->model->getGenderdataaList());
        $this->view->assign("genderdatabList", $this->model->getGenderdatabList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    /**
     * 查看
     */
    public function index()
    {
        $this->relationSearch = true;
        $this->searchFields = "admin.username,id";
        if ($this->request->isAjax()) {
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model 
                     ->with('admin','addressname','mesh')                   
                    ->where($where)
                    ->order($sort, $order)
                    ->count();
            $list = $this->model 
            ->with('admin','addressname','mesh')                  
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();
            $sum['price']=0;//这里我们要统计的值是price 价格的合计，先定义一个变量值为0，用来保存统计的值
            
                    $list = addtion($list, [
           [
                'field'    => 'admin_ids',
                'display'  => 'admin_nicknames',
                'primary'  => 'id',
                'column'   => 'nickname',
                'model'    => '\app\admin\model\Admin',
                'name'     => 'Admin',
                'table'    => 'Admin'
            ],
            [
                'field'    => 'addressname_ids',
                'display'  => 'addressname_names',
                'primary'  => 'id',
                'column'   => 'name',
                'model'    => '\app\admin\model\Category',
                'name'     => 'Category',
                'table'    => 'Category'
            ],
            [
                'field'    => 'mesh_ids',
                'display'  => 'mesh_names',
                'primary'  => 'id',
                'column'   => 'name',
                'model'    => '\app\admin\model\Category',
                'name'     => 'Category',
                'table'    => 'Category'
            ]
        ]);
        $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

}
