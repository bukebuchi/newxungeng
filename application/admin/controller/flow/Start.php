<?php

namespace app\admin\controller\flow;

use app\common\controller\Backend;

/**
 * 发起流程
 *
 * @icon fa fa-arrow-circle-o-right
 */
class Start extends Backend
{

    /**
     * Scheme模型对象
     * @var \app\admin\model\flow\Scheme
     */
    protected $model = null;
    protected $noNeedRight = ['*'];
    protected $runtime = null;
    protected $searchFields = 'id,flowcode,flowname';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\flow\Scheme;
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
        //当前是否为关联查询
        $this->relationSearch = false;
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->where($where)
                ->where("isenable", "1")
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->where($where)
                ->where("isenable", "1")
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            foreach ($list as $row) {
                $row->visible(['id', 'flowcode', 'flowname', 'flowversion', 'weight']);
            }
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    /**
     * 发起
     */
    public function start()
    {
        $this->redirect('/admin/flow/leave/add', ['ids' => 1]);
    }
}
