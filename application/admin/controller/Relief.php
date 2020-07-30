<?php

namespace app\admin\controller;

use app\common\controller\Backend;

/**
 * 测试管理
 *
 * @icon fa fa-circle-o
 */
class Relief extends Backend
{
    
    /**
     * Relief模型对象
     * @var \app\admin\model\Relief
     */
    protected $model = null;
	
	protected $noNeedRight = ['selectpage'];
    protected $dataLimit = 'auth';
    protected $dataLimitField = 'admin_id';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Relief;
          $this->view->assign("hobbydataList", $this->model->getHobbydataList());

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
                     ->with('admin','addressname','mesh','dname')                     
                    ->where($where)
                    ->order($sort, $order)
                    ->count();
            $list = $this->model 
            ->with('admin','addressname','mesh','dname')                    
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();
            $sum['totalviews'] = $this->model 
                     ->with('admin','addressname','mesh','dname')                     
                    ->where($where)
                    ->order($sort, $order)
                    ->sum('views');
            $sum['totalfireviews'] = $this->model 
                     ->with('admin','addressname','mesh','dname')                     
                    ->where($where)
                    ->order($sort, $order)
                    ->sum('fireviews');
            $sum['views']=0;//这里我们要统计的值是views救助群众 
           $sum['fireviews']=0;//这里我们要统计的值是views救助群众 
            foreach ($list as $row) {
                $row->visible(['id', 'admin_nicknames','addressname_names','mesh_names','dname_names','activitytime','images','views','hobbydata','fireviews','addcontent']);
                $sum['views']+=$row['views'];
                $sum['fireviews']+=$row['fireviews'];
            }

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
            ],
            [
                'field'    => 'dname_ids',
                'display'  => 'dname_names',
                'primary'  => 'id',
                'column'   => 'name',
                'model'    => '\app\admin\model\Category',
                'name'     => 'Category',
                'table'    => 'Category'
            ]
        ]);
        $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list, "sum" => $sum);
           
            return json($result);
        }

        return $this->view->fetch();
    }

}
