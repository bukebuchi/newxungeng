<?php

namespace app\admin\model;

use think\Model;


class Dispute extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'dispute';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'genderdataA_text',
        'genderdataB_text'
    ];
    

    
    public function getGenderdataaList()
    {
        return ['male' => __('Genderdataa male'), 'female' => __('Genderdataa female')];
    }

    public function getGenderdatabList()
    {
        return ['male' => __('Genderdatab male'), 'female' => __('Genderdatab female')];
    }


    public function getGenderdataaTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['genderdataA']) ? $data['genderdataA'] : '');
        $list = $this->getGenderdataaList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getGenderdatabTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['genderdataB']) ? $data['genderdataB'] : '');
        $list = $this->getGenderdatabList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
