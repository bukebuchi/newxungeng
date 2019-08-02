<?php

namespace addons\flow;

use app\common\library\Menu;
use think\Addons;
use think\Exception;

/**
 * 工作流插件
 */
class Flow extends Addons
{

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        $menu = [
            [
                'name'    => 'flow',
                'title'   => '流程中心',
                'icon'    => 'fa fa-list',
                'sublist' => [
                    [
                        'name'   => 'flow/start',
                        'title'  => '发起流程',
                        'icon'   => 'fa fa-arrow-circle-o-right',
                        'weigh'  => 100,
                        'ismenu' => 1
                    ],
                    [
                        'name'   => 'flow/myworkitem',
                        'title'  => '待办任务',
                        'icon'   => 'fa fa-circle-o',
                        'weigh'  => 90,
                        'ismenu' => 1
                    ],
                    [
                        'name'   => 'flow/finishworkitem',
                        'title'  => '已办任务',
                        'icon'   => 'fa fa-gavel',
                        'weigh'  => 80,
                        'ismenu' => 1
                    ],
                    [
                        'name'   => 'flow/instance',
                        'title'  => '实例管理',
                        'icon'   => 'fa fa-apple',
                        'weigh'  => 70,
                        'ismenu' => 1
                    ],
                    [
                        'name'   => 'flow/scheme',
                        'title'  => '流程设计',
                        'icon'   => 'fa fa-database',
                        'weigh'  => 60,
                        'ismenu' => 1
                    ],
                ],
                'remark'  => ''
            ],
        ];
        Menu::create($menu);
        $this->appendcommand();
        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
        Menu::delete('flow');
        return true;
    }

    /**
     * 插件启用方法
     * @return bool
     */
    public function enable()
    {
        Menu::enable('flow');
        return true;
    }

    /**
     * 插件禁用方法
     * @return bool
     */
    public function disable()
    {
        Menu::disable('flow');
        return true;
    }

    public function appendcommand()
    {
        $config = require(APP_PATH . 'command.php');
        if (!in_array('app\admin\command\FlowCrud', $config)) {
            $file = APP_PATH . 'command.php';
            array_push($config, 'app\admin\command\FlowCrud');
            if (!is_really_writable($file)) {
                throw new Exception("文件没有写入权限,需要手动添加配置");
            }
            if ($handle = fopen($file, 'w')) {
                fwrite($handle, "<?php\n\n" . "return " . var_export($config, true) . ";\n");
                fclose($handle);
            } else {
                throw new Exception("文件没有写入权限");
            }
        }
    }
}
