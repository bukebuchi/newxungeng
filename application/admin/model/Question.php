<?php

namespace app\admin\model;

use think\Model;


class Question extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'question';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'genderdata_text'
    ];
    

    
    public function getGenderdataList()
    {
        return ['male' => __('Genderdata male'), 'female' => __('Genderdata female')];
    }


    public function getGenderdataTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['genderdata']) ? $data['genderdata'] : '');
        $list = $this->getGenderdataList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function admin()
    {
        return $this->belongsTo("app\admin\model\Admin", "admin_ids", 'id', [], 'LEFT')->setEagerlyType(0);
    }
    


}
