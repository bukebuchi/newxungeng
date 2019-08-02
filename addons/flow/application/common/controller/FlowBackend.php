<?php

namespace app\common\controller;

use app\common\controller\Backend;
use app\admin\model\flow;
use think\Db;
use think\Config;

/**
 * 后台控制器基类
 */
class FlowBackend extends Backend
{

    protected $model = null;
    protected $task = null;
    protected $stepid = null;
    protected $currentNode = null;
    protected $nextNode = null;
    protected $scheme = null;
    protected $instance = null;
    protected $prefix = "";

    public function _initialize()
    {
        $this->task = new \app\admin\model\flow\Task();
        $this->instance = new \app\admin\model\flow\Instance();
        $this->scheme = new \app\admin\model\flow\Scheme();
        parent::_initialize();
        $this->prefix = Config::get('database.prefix');
    }

    /**
     * 保存草稿
     */
    public function save()
    {
        $params = $this->request->post("row/a");
        if ($this->request->isPost()) {
            $instanceid = \fast\Random::uuid();
            $bizobjectid = \fast\Random::uuid();
            $flowTmp = $this->scheme->get($this->request->request("ids"));
            //新建流程实例
            $this->instance = new \app\admin\model\flow\Instance();
            $this->instance->isUpdate(false)->data(array(
                'id'             => $instanceid,
                'originator'     => $this->auth->id,
                'scheme'         => $flowTmp['id'],
                'createtime'     => date("Y-m-d h:i:s"),
                'instancecode'   => time(),
                'bizobjectid'    => $bizobjectid,
                'instancestatus' => 0), true)->save();
            $content = json_decode($flowTmp->flowcontent, true);
            //所有连线信息
            $lines = $content['lines'];
            //所有节点信息
            $nodes = $content['nodes'];
            $rtnNext = null;
            $nextNodeIndex = null;
            //如果是开始节点需要保存开始数据和下一个节点的代办数据
            $rtn = array_search('start', array_column($nodes, 'type'));
            $this->currentNode = $nodes[$rtn];
            $this->stepid = $this->currentNode['id'];
            $this->task->isUpdate(false)->data(array(
                'id'         => \fast\Random::uuid(),
                'flowid'     => $flowTmp['id'],
                'stepname'   => $this->currentNode['name'],
                'stepid'     => $this->currentNode['id'],
                'receiveid'  => $this->auth->id,
                'instanceid' => $instanceid,
                'senderid'   => $this->auth->id,
                'status'     => 0,
                'createtime' => date("Y-m-d H:i:s"),
                'comment'    => '提交'), true)->save();
            $params = $this->request->post("row/a");
            $params['id'] = $bizobjectid;
            if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                $params[$this->dataLimitField] = $this->auth->id;
            }
            try {
                //是否采用模型验证
                if ($this->modelValidate) {
                    $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                    $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                    $this->model->validate($validate);
                }
                $result = $this->model->allowField(true)->save($params);
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error($this->model->getError());
                }
            } catch (\think\exception\PDOException $e) {
                $this->error($e->getMessage());
            } catch (\think\Exception $e) {
                $this->error($e->getMessage());
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }

    /**
     * 直接提交流程
     */
    public function add()
    {
        $params = $this->request->post("row/a");
        $flowTmp = $this->scheme->get($this->request->request("ids"));
        if ($this->request->isPost()) {
            $instanceid = \fast\Random::uuid();
            $bizobjectid = \fast\Random::uuid();

            //新建流程实例
            $this->instance = new \app\admin\model\flow\Instance();
            $this->instance->isUpdate(false)->data(array(
                'id'             => $instanceid,
                'originator'     => $this->auth->id,
                'scheme'         => $flowTmp['id'],
                'createtime'     => date("Y-m-d h:i:s"),
                'instancecode'   => time(),
                'bizobjectid'    => $bizobjectid,
                'instancestatus' => 1), true)->save();
            $content = json_decode($flowTmp->flowcontent, true);
            //所有连线信息
            $lines = $content['lines'];
            //所有节点信息
            $nodes = $content['nodes'];
            $rtnNext = null;
            $nextNodeIndex = null;
            //如果是开始节点需要保存开始数据和下一个节点的代办数据
            $rtn = array_search('start', array_column($nodes, 'type'));
            $this->currentNode = $nodes[$rtn];
            $this->stepid = $this->currentNode['id'];
            $this->task->isUpdate(false)->data(array(
                'id'            => \fast\Random::uuid(),
                'flowid'        => $flowTmp['id'],
                'stepname'      => $this->currentNode['name'],
                'stepid'        => $this->currentNode['id'],
                'receiveid'     => $this->auth->id,
                'instanceid'    => $instanceid,
                'senderid'      => $this->auth->id,
                'status'        => '2',
                'createtime'    => date("Y-m-d H:i:s"),
                'completedtime' => date("Y-m-d H:i:s"),
                'comment'       => '提交'), true)->save();
            $nextNodeArray = array_filter($lines, function ($t) {
                return $t['from'] == $this->stepid;
            });
            foreach ($nextNodeArray as $line) {
                //$this->nextNode=$nodes[$toId];
                $this->nextNode = array_filter($nodes, function ($t) use ($line) {
                    return $t['id'] == $line['to'];

                });
                $this->nextNode = array_values($this->nextNode)[0];
                $nodeType = $this->nextNode['setInfo']['nodeDesignate'];
                $dataset = [];
                $userList = [];
                if ($nodeType == 'user') {
                    if (is_array($this->nextNode['setInfo']['NodeDesignateData']['users'])) {
                        $userList = $this->nextNode['setInfo']['NodeDesignateData']['users'];
                    } else {
                        $userList = explode(',', $this->nextNode['setInfo']['NodeDesignateData']['users']);
                    }
                    foreach ($userList as $user) {
                        $dataset[] = ['id'         => \fast\Random::uuid(),
                                      'flowid'     => $flowTmp['id'],
                                      'stepname'   => $this->nextNode['name'],
                                      'stepid'     => $this->nextNode['id'],
                                      'receiveid'  => $user,
                                      'instanceid' => $instanceid,
                                      'senderid'   => $this->auth->id,
                                      'status'     => '0',
                                      'createtime' => date("Y-m-d H:i:s")];
                    }
                }
                if ($nodeType == 'role') {
                    $role = '';
                    if (is_array($this->nextNode['setInfo']['NodeDesignateData']['role'])) {
                        $role = $this->nextNode['setInfo']['NodeDesignateData']['role'];
                        if (!$role) {
                            $this->error(__('找不到角色', ''));
                        } else {
                            $role = $role[0];
                        }
                    } else {
                        $role = $this->nextNode['setInfo']['NodeDesignateData']['role'];
                    }
                    $userList = $this->getuserbyrole($role);
                    foreach ($userList as $user => $v) {
                        $dataset[] = ['id'         => \fast\Random::uuid(),
                                      'flowid'     => $flowTmp['id'],
                                      'stepname'   => $this->nextNode['name'],
                                      'stepid'     => $this->nextNode['id'],
                                      'receiveid'  => $v['id'],
                                      'instanceid' => $instanceid,
                                      'senderid'   => $this->auth->id,
                                      'status'     => '0',
                                      'createtime' => date("Y-m-d H:i:s")];
                    }
                }
                if (count($userList) == 0) {
                    $dataset[] = ['id'         => \fast\Random::uuid(),
                                  'flowid'     => $flowTmp['id'],
                                  'stepname'   => $this->nextNode['name'],
                                  'stepid'     => $this->nextNode['id'],
                                  'receiveid'  => '',
                                  'instanceid' => $instanceid,
                                  'senderid'   => $this->auth->id,
                                  'status'     => '0',
                                  'createtime' => date("Y-m-d H:i:s")];
                    $this->task->isUpdate(false)->saveAll($dataset);
                }

                $this->task->isUpdate(false)->saveAll($dataset, false);
            }
            $params = $this->request->post("row/a");
            $params['id'] = $bizobjectid;
            if ($params) {
                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validate($validate);
                    }
                    $result = $this->model->allowField(true)->save($params);
                    if ($result !== false) {
                        $this->success();
                    } else {
                        $this->error($this->model->getError());
                    }
                } catch (\think\exception\PDOException $e) {
                    $this->error($e->getMessage());
                } catch (\think\Exception $e) {
                    $this->error($e->getMessage());
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }

        $this->assignconfig('flowCode', $flowTmp['flowcode']);
        return $this->view->fetch();
    }

    /**
     * 寻找下一个审批节点,同意按钮执行的方法
     */
    public function edit($ids = NULL)
    {
        $ids = $this->request->request('ids');
        $row = $this->model->get($ids);
        if (!$row)
            $this->error(__('No Results were found'));
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        $taskid = $this->request->request('taskid');
        $task = null;
        $mode = $this->request->request('mode');
        if ($mode == 'view') {
            $task = $this->task->where(['id' => $taskid])->find();
        } else {
            $task = $this->task->where(['id' => $taskid])->where('status', 0)->find();
        }
        if (!$task)
            $this->error(__('找不到当前任务'));
        $schme = $this->scheme->get($task['flowid']);
        $instance = $this->instance->get($task['instanceid']);
        $instanceid = $task['instanceid'];
        if ($this->request->isPost()) {

            $this->stepid = $task['stepid'];
            //更改当前任务为完成
            $comment = $this->request->post('comment') == '' ? '[同意]' : $this->request->post('comment');
            $this->task->where('id', $taskid)->update(['status' => 2, 'completedtime' => date("Y-m-d H:i:s"), 'comment' => $comment]);
            $unfinishList = $this->task->where(['instanceid' => $instanceid])->where('status', 'in', [0, 1])->find();

            if ($task['stepname'] == '开始') {
                $this->instance->where('id', $task['instanceid'])->update(['instancestatus' => 1]);
                $params = $this->request->post("row/a");
                if ($params) {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                        $row->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);
                }
            }
            if (!$unfinishList) {
                //寻找下一个待办任务
                $flowTmp = $schme;
                $content = json_decode($flowTmp->flowcontent, true);
                //所有连线信息
                $lines = $content['lines'];
                //所有节点信息
                $nodes = $content['nodes'];
                $rtnNext = null;
                $nextNodeIndex = null;
                $nextNodeArray = array_filter($lines, function ($t) {
                    return $t['from'] == $this->stepid;
                });
                foreach ($nextNodeArray as $line) {

                    $this->nextNode = array_filter($nodes, function ($t) use ($line) {
                        return $t['id'] == $line['to'];
                    });
                    $this->nextNode = array_values($this->nextNode)[0];//0表示获取他的value
                    $nodeType = null;
                    $dataset = [];
                    $userList = null;
                    if (count($nextNodeArray) == 1 && $this->nextNode['name'] == '结束') {
                        //更改当前实例为结束
                        $this->instance->where('id', $task['instanceid'])->update(['instancestatus' => 2, 'completedtime' => date("Y-m-d H:i:s")]);
                        //插入结束节点task
                        Db::name("flow_task")->insert([
                            'id'            => \fast\Random::uuid(),
                            'flowid'        => $flowTmp['id'],
                            'stepname'      => $this->nextNode['name'],
                            'stepid'        => $this->nextNode['id'],
                            'receiveid'     => '',
                            'instanceid'    => $instanceid,
                            'senderid'      => $this->auth->id,
                            'status'        => '2',
                            'createtime'    => date("Y-m-d H:i:s"),
                            'completedtime' => date("Y-m-d H:i:s"),
                            'comment'       => '结束'
                        ]);
                    }
                    if ($this->nextNode['name'] != '结束') {
                        $nodeType = $this->nextNode['setInfo']['nodeDesignate'];
                        if ($nodeType == 'user') {
                            if (is_array($this->nextNode['setInfo']['NodeDesignateData']['users'])) {
                                $userList = $this->nextNode['setInfo']['NodeDesignateData']['users'];
                            } else {
                                $userList = explode(',', $this->nextNode['setInfo']['NodeDesignateData']['users']);
                            }
                            foreach ($userList as $user) {
                                $dataset[] = ['id'         => \fast\Random::uuid(),
                                              'flowid'     => $flowTmp['id'],
                                              'stepname'   => $this->nextNode['name'],
                                              'stepid'     => $this->nextNode['id'],
                                              'receiveid'  => $user,
                                              'instanceid' => $instanceid,
                                              'senderid'   => $this->auth->id,
                                              'status'     => '0',
                                              'createtime' => date("Y-m-d H:i:s")];
                            }
                        }
                        if ($nodeType == 'role') {
                            $role = '';
                            if (is_array($this->nextNode['setInfo']['NodeDesignateData']['role'])) {
                                $role = $this->nextNode['setInfo']['NodeDesignateData']['role'];
                                if (!$role) {
                                    $this->error(__('找不到角色', ''));
                                } else {
                                    $role = $role[0];
                                }

                            } else {
                                $role = $this->nextNode['setInfo']['NodeDesignateData']['role'];
                            }
                            $userList = $this->getuserbyrole($role);
                            foreach ($userList as $user => $v) {
                                $dataset[] = ['id'         => \fast\Random::uuid(),
                                              'flowid'     => $flowTmp['id'],
                                              'stepname'   => $this->nextNode['name'],
                                              'stepid'     => $this->nextNode['id'],
                                              'receiveid'  => $v['id'],
                                              'instanceid' => $instanceid,
                                              'senderid'   => $this->auth->id,
                                              'status'     => '0',
                                              'createtime' => date("Y-m-d H:i:s")];
                            }
                        }
                        if (count($userList) == 0) {
                            $dataset[] = ['id'         => \fast\Random::uuid(),
                                          'flowid'     => $flowTmp['id'],
                                          'stepname'   => $this->nextNode['name'],
                                          'stepid'     => $this->nextNode['id'],
                                          'receiveid'  => '',
                                          'instanceid' => $instanceid,
                                          'senderid'   => $this->auth->id,
                                          'status'     => '0',
                                          'createtime' => date("Y-m-d H:i:s")];
                            $this->task->isUpdate(false)->saveAll($dataset);
                        }

                        Db::name("flow_task")->insertAll($dataset);
                    }
                }
            }
            $this->success();
        }
        $history = Db::table($this->prefix . 'flow_task')
            ->alias('main')
            ->join($this->prefix . 'admin admin', 'admin.id=main.receiveid', 'LEFT')
            ->where(['instanceid' => $task['instanceid'], 'main.status' => 2])
            ->field(["main.receiveid", "main.stepname", "main.comment", "admin.nickname", "main.completedtime"])
            ->order('main.createtime asc,main.completedtime asc')
            ->select();

        $this->assignconfig('task', $task);
        $this->assignconfig('flowCode', $schme['flowcode']);
        $this->view->assign("history", $history);
        $this->view->assign("mode", $mode);
        $this->view->assign("instance", $instance);
        $this->view->assign("row", $row);
        $this->view->assign("auth", $this->auth);
        return $this->view->fetch();
    }

    /**
     * 拒绝流程
     */
    public function refuse()
    {
        $params = $this->request->post("row/a");
        if ($this->request->isPost()) {
            $taskid = $this->request->request('taskid');
            $task = $this->task->where(['id' => $taskid, 'status' => 0])->find();
            if (!$task)
                $this->error(__('找不到当前任务,或已处理，请联系管理员'));
            //更改当前流程为拒绝状态
            $comment = $this->request->post('comment') == '' ? '[拒绝]' : $this->request->post('comment');
            Db::name('flow_task')->where('id', $taskid)
                ->update(['status' => 2, 'completedtime' => date("Y-m-d H:i:s"), 'comment' => $comment]);
            //取消其他流程
            Db::name('flow_task')->where(['instanceid' => $task['instanceid'], 'status' => 0])
                ->update(['status' => 3, 'completedtime' => date("Y-m-d H:i:s")]);
            //更改流程实例为草稿状态
            Db::name('flow_instance')->where(['id' => $task['instanceid']])
                ->update(['instancestatus' => 0]);
            //寻找下一个待办任务
            $startNode = $this->task->where(['instanceid' => $task['instanceid'], 'stepname' => '开始'])->find();
            $startNode->status = 0;
            $this->task->insert(['id'         => \fast\Random::uuid(),
                                 'flowid'     => $startNode['flowid'],
                                 'stepname'   => $startNode['stepname'],
                                 'stepid'     => $startNode['stepid'],
                                 'receiveid'  => $startNode['receiveid'],
                                 'instanceid' => $startNode['instanceid'],
                                 'senderid'   => $startNode['senderid'],
                                 'status'     => '0',
                                 'createtime' => date("Y-m-d H:i:s")]);
            $this->success();
        }
        return $this->view->fetch();
    }

    /**
     * 取消流程
     */
    public function cancel()
    {
        $params = $this->request->post("row/a");
        if ($this->request->isPost()) {
            $taskid = $this->request->request('taskid');
            $task = $this->task->get($taskid);
            $comment = $this->request->post('comment') == '' ? '[取消]' : $this->request->post('comment');
            //更改当前流程为取消状态
            $this->task->where(['instanceid' => $task['instanceid']])->where('status', 'in', [0, 1])->update(['status' => 3, 'completedtime' => date("Y-m-d H:i:s"), 'comment' => $comment]);
            $this->instance->where(['id' => $task['instanceid']])->update(['instancestatus' => 3]);
            $this->success();
        }
        return $this->view->fetch();
    }

    public function getuserbyrole($role)
    {
        $sql = "SELECT a.id FROM " . $this->prefix . "admin a 
                LEFT JOIN " . $this->prefix . "auth_group_access b ON a.id = b.uid
                LEFT JOIN " . $this->prefix . "auth_group c ON b.group_id=c.id
                WHERE c.`id`='" . $role . "'";
        $user = Db::query($sql);
        return $user;
    }
}
