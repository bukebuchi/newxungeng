<?php

namespace app\admin\model;

use think\Model;


class Maodun1 extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'maodun1';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'hobbydata_text',
        'genderdata_text'
    ];
    

    
    public function getHobbydataList()
    {
        return ['music' => __('Hobbydata music'), 'reading' => __('Hobbydata reading'), 'swimming' => __('Hobbydata swimming')];
    }

    public function getGenderdataList()
    {
        return ['male' => __('Genderdata male'), 'female' => __('Genderdata female')];
    }


    public function getHobbydataTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['hobbydata']) ? $data['hobbydata'] : '');
        $valueArr = explode(',', $value);
        $list = $this->getHobbydataList();
        return implode(',', array_intersect_key($list, array_flip($valueArr)));
    }


    public function getGenderdataTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['genderdata']) ? $data['genderdata'] : '');
        $list = $this->getGenderdataList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setHobbydataAttr($value)
    {
        return is_array($value) ? implode(',', $value) : $value;
    }

public function admin()
    {
        return $this->belongsTo("app\admin\model\Admin", "admin_ids", 'id', [], 'LEFT')->setEagerlyType(0);
    }
    
}
