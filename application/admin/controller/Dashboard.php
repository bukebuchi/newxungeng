<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Config;
use think\Db;

/**
 * 控制台
 *
 * @icon fa fa-dashboard
 * @remark 用于展示当前系统中的统计数据、统计报表及重要实时数据
 */
class Dashboard extends Backend
{

    /**
     * 查看
     */
    public function index()
    {
        $seventtime = \fast\Date::unixtime('day', -7);
        $paylist = $createlist = [];
        for ($i = 0; $i < 7; $i++)
        {
            $day = date("Y-m-d", $seventtime + ($i * 86400));
            $createlist[$day] = mt_rand(20, 200);
            $paylist[$day] = mt_rand(1, mt_rand(1, $createlist[$day]));
        }
        $hooks = config('addons.hooks');
        $uploadmode = isset($hooks['upload_config_init']) && $hooks['upload_config_init'] ? implode(',', $hooks['upload_config_init']) : 'local';
        $addonComposerCfg = ROOT_PATH . '/vendor/karsonzhang/fastadmin-addons/composer.json';
        Config::parse($addonComposerCfg, "json", "composer");
        $config = Config::get("composer");
        $addonVersion = isset($config['version']) ? $config['version'] : __('Unknown');
        $this->view->assign([
            'totaluser'        => 35200,
            'totalviews'       => 219390,
            'totalorder'       => 32143,
            'totalorderamount' => 174800,
            'todayuserlogin'   => 321,
            'todayusersignup'  => 430,
            'todayorder'       => 2324,
            'unsettleorder'    => 132,
            'sevendnu'         => '80%',
            'sevendau'         => '32%',
            'paylist'          => $paylist,
            'createlist'       => $createlist,
            'addonversion'     => $addonVersion,
            'uploadmode'       => $uploadmode,

            'test1'            => 111111,
            'test2'            => 222222,
            'test3'            => 333333,
            'user_count'       => $this->getUser(),
            'duty_count'       => $this->getDuty(),
            'maodun_count'     => $this->getMaodun(),
            'Maoduncivil_count'=> $this->getMaoduncivil(),
            'Maoduncrimi_count'=> $this->getMaoduncriminal(),
            'all_count'        => $this->getMap(),
            'oline_count'      => $this->getMap(),
            'question_count'   => $this->getQuestion(),
            'society_count'    => $this->getSociety(),
            'traffic_count'    => $this->getTraffic(),
            'service_count'    => $this->getService(),
            'admin_count'      => $this->getAdmin(),
            'safety_count'     => $this->getSafety(),
            'Traffic_count'    => $this->getTrafficsafety(),
            'Fire_count'       => $this->getFiresafety(),
            'Production_count' => $this->getProductionsafety(),
            'Natural_count'    => $this->getNaturalsafety(),
            'Etc_count'        => $this->getEtcsafety(),
            'Attachment_count' => $this->getAttachment(),
            'Cmsnews_count'    => $this->getCmsnews(),
            'test3'            => 333333
        ]);

        return $this->view->fetch();
    }

    public function get_general_data(){
        $result = array();
        //$result['number1'] = $buildingHouse['building'];
        //$result['number1'] = $this->getUsername($community_code);
        //$result['number1'] = $this->getUsername();

        return json($result);
    }
    /*测试*/
    private function getUsername() {
        //$count = model('Member')->where($where)->count();
        $result = model('Admin')->where("nickname = '王杰'")->find();
        $count= $result['username'];
        //$count=666666;
        return $count;
    }
    /*交通安全*/
    private function getTraffic() {
        $count = model('Traffic')->count();
        return $count;
    }
    /*admin数量*/
    private function getAdmin() {
        $count = model('Admin')->count();
        return $count;
    }
    /*社情民意*/
    private function getSociety() {
        $count = model('Society')->count();
        return $count;
    }
    /*盘查*/
    private function getQuestion() {
        $count = model('Question')->count();
        return $count;
    }
    /*在线人数*/
    private function getMap() {
        $count = model('Map')->count();
        return $count;
    }
    /*矛盾纠纷*/
    private function getMaodun() {
        $count = model('Maodun')->count();
        return $count;
    }
    /*民事纠纷*/
    private function getMaoduncivil() {
        $count = model('Maodun')->where("hobbydata='music'")->count();
        return $count;
    }
    /*刑事纠纷*/
    private function getMaoduncriminal() {
        $count = model('Maodun')->where("hobbydata='reading'")->count();
        return $count;
    }
    /*执勤守点*/
    private function getDuty() {
        $count = model('Duty')->count();
        return $count;
    }
    /*社员统计*/
    private function getUser() {
        $count = model('User')->count();
        return $count;
    }
    /*服务统计*/
    private function getService() {
        $count = model('Service')->count();
        return $count;
    }
    /*安全隐患排查*/
    private function getSafety() {
        $count = model('Safety')->count();
        return $count;
    }

    /*交通安全隐患排查*/
    private function getTrafficsafety() {
        $count = model('Safety')->where("xingshihobbydata='kt'")->count();
        return $count;
    }
    /*消防安全隐患排查*/
    private function getFiresafety() {
        $count = model('Safety')->where("xingshihobbydata='ff'")->count();
        return $count;
    }
    /*生产安全隐患排查*/
    private function getProductionsafety() {
        $count = model('Safety')->where("xingshihobbydata='yb'")->count();
        return $count;
    }
    /*自然灾害隐患排查*/
    private function getNaturalsafety() {
        $count = model('Safety')->where("xingshihobbydata='xl'")->count();
        return $count;
    }
    /*其他隐患排查*/
    private function getEtcsafety() {
        $count = model('Safety')->where("xingshihobbydata='zb'")->count();
        return $count;
    }
    /*附件数量统计*/
    private function getAttachment() {
        $count = model('Attachment')->count();
        return $count;
    }
    /*附件数量统计*/
    private function getCmsnews() {
        //$count = model('Cms_addonnews')->count();
        $count = 0;
        return $count;
    }
}
