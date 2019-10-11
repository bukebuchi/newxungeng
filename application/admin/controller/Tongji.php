<?php

namespace app\admin\controller;

use app\common\controller\Backend;

/**
 * 测试管理
 *
 * @icon fa fa-circle-o
 */
class Tongji extends Backend
{
    
    /**
     * Tongji模型对象
     * @var \app\admin\model\Tongji
     */
    protected $model = null;
    protected $noNeedRight = ['selectpage'];
    protected $dataLimit = 'auth';
    protected $dataLimitField = 'admin_id';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Tongji;

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
            // 获取自定义字段
            $filter =  json_decode($this->request->get('filter'),true);

            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            if(empty($filter['activitytime']))
            {
                $total = $this->model 
                    ->with('admin')                    
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->count();

            $list = $this->model 
                    ->with('admin')                   
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();

            //车巡逻公里数
            $sum['totalmiles'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('miles');

            $sum['totalpatrol'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('patrol');
            $sum['totalpatrolcar'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('patrolcar');

            $sum['totalmeshnumber'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('meshnumber');
             $sum['totalpointnumber'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('pointnumber');
            $sum['totalyuanbanumber'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('yuanbanumber');
            $sum['totalquestioncar'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('questioncar');
            $sum['totalquestionpeople'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('questionpeople');
             $sum['totalcapturepeople'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('capturepeople');
             $sum['totaldispute'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('dispute');
            $sum['totaldanger'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('danger');
            $sum['totalsociety'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('society');
            $sum['totalservice'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('service');
              $sum['totalrelief'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('relief');
              $sum['totaloutfire'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('outfire');
            $sum['totalmafeng'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('mafeng');
            $sum['totalhelp'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('help');
            $sum['totalxuanchuan'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('xuanchuan');
            $sum['totalfangfanxuanchuan'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('fangfanxuanchuan');
             $sum['totalhuxiao'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('huxiao');
            $sum['totalinhuxiao'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('inhuxiao');
            $sum['totalinfish'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('infish');
           $sum['totalfishpeople'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('fishpeople');
            $sum['totaldianping'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('dianping');
            $sum['totalyuju'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('yuju');
            $sum['totalclear'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('clear');
              $sum['totalsongzheng'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('songzheng');
               $sum['totalgoodthing'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    ->whereTime('createtime', 'today')
                    ->order($sort, $order)
                    ->sum('goodthing');
                   
            }
            else
            {
                
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

            //车巡逻公里数
            $sum['totalmiles'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('miles');

            $sum['totalpatrol'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                   
                    ->order($sort, $order)
                    ->sum('patrol');
            $sum['totalpatrolcar'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('patrolcar');

            $sum['totalmeshnumber'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('meshnumber');
             $sum['totalpointnumber'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('pointnumber');
            $sum['totalyuanbanumber'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                
                    ->order($sort, $order)
                    ->sum('yuanbanumber');
            $sum['totalquestioncar'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('questioncar');
            $sum['totalquestionpeople'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                   
                    ->order($sort, $order)
                    ->sum('questionpeople');
             $sum['totalcapturepeople'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('capturepeople');
             $sum['totaldispute'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('dispute');
            $sum['totaldanger'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('danger');
            $sum['totalsociety'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                   
                    ->order($sort, $order)
                    ->sum('society');
            $sum['totalservice'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('service');
              $sum['totalrelief'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                   
                    ->order($sort, $order)
                    ->sum('relief');
              $sum['totaloutfire'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('outfire');
            $sum['totalmafeng'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                   
                    ->order($sort, $order)
                    ->sum('mafeng');
            $sum['totalhelp'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('help');
            $sum['totalxuanchuan'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                 
                    ->order($sort, $order)
                    ->sum('xuanchuan');
            $sum['totalfangfanxuanchuan'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('fangfanxuanchuan');
             $sum['totalhuxiao'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('huxiao');
            $sum['totalinhuxiao'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('inhuxiao');
            $sum['totalinfish'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('infish');
           $sum['totalfishpeople'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                   
                    ->order($sort, $order)
                    ->sum('fishpeople');
            $sum['totaldianping'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('dianping');
            $sum['totalyuju'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('yuju');
            $sum['totalclear'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('clear');
              $sum['totalsongzheng'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('songzheng');
               $sum['totalgoodthing'] = $this->model 
                     ->with('admin')                     
                    ->where($where)
                    
                    ->order($sort, $order)
                    ->sum('goodthing');
            }
            
            $sum['miles']=0;
            $sum['patrol']=0;
            $sum['patrolcar']=0;
            $sum['meshnumber']=0;
            $sum['pointnumber']=0;
             $sum['yuanbanumber']=0;
            $sum['questioncar']=0;
            $sum['questionpeople']=0;
            $sum['capturepeople']=0;
            $sum['dispute']=0;
             $sum['danger']=0;
            $sum['society']=0;
            $sum['service']=0;
            $sum['relief']=0;
            $sum['outfire']=0;
            $sum['mafeng']=0;
            $sum['help']=0;
            $sum['xuanchuan']=0;
            $sum['fangfanxuanchuan']=0;
            $sum['huxiao']=0;
            $sum['inhuxiao']=0;
            $sum['fishpeople']=0;
            $sum['dianping']=0;
            $sum['yuju']=0;
            $sum['clear']=0;
            $sum['songzheng']=0;
            $sum['goodthing']=0;
           foreach ($list as $row) {
                $row->visible(['id', 'admin_nicknames','miles','patrol','patrolcar','meshnumber','pointnumber','yuanbanumber','questioncar','questionpeople','capturepeople','dispute','danger','society','service','relief','outfire','mafeng','help','xuanchuan','fangfanxuanchuan','huxiao','inhuxiao','infish','fishpeople','dianping','yuju','clear','songzheng','goodthing','activitytime']);
                $sum['miles']+=$row['miles'];
                $sum['patrol']+=$row['patrol'];
                $sum['patrolcar']+=$row['patrolcar'];
                $sum['meshnumber']+=$row['meshnumber'];
                $sum['pointnumber']+=$row['pointnumber'];
                $sum['yuanbanumber']+=$row['yuanbanumber'];
                $sum['questioncar']+=$row['questioncar'];
                $sum['questionpeople']+=$row['questionpeople'];
                $sum['miles']+=$row['capturepeople'];
                $sum['patrol']+=$row['patrol'];
                $sum['patrolcar']+=$row['patrolcar'];
                $sum['meshnumber']+=$row['meshnumber'];
                $sum['pointnumber']+=$row['pointnumber'];
                $sum['yuanbanumber']+=$row['yuanbanumber'];
                $sum['questioncar']+=$row['questioncar'];
                $sum['questionpeople']+=$row['questionpeople'];
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
            ]
            
        ]);
        $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list, "sum" => $sum);

            return json($result);
        }

        return $this->view->fetch();
    }

}
