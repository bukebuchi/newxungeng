<?php

namespace app\admin\model;

use think\Model;


class Society extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'society';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'genderdata_text',
        'flag_text'
    ];
    

    
    public function getGenderdataList()
    {
        return ['male' => __('Genderdata male'), 'female' => __('Genderdata female')];
    }

    public function getFlagList()
    {
        return ['weifa' => __('Flag weifa'), 'anquan' => __('Flag anquan'), 'shiping' => __('Flag shiping'), 'weiwen' => __('Flag weiwen'), 'qita' => __('Flag qita')];
    }


    public function getGenderdataTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['genderdata']) ? $data['genderdata'] : '');
        $list = $this->getGenderdataList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getFlagTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['flag']) ? $data['flag'] : '');
        $valueArr = explode(',', $value);
        $list = $this->getFlagList();
        return implode(',', array_intersect_key($list, array_flip($valueArr)));
    }

    protected function setFlagAttr($value)
    {
        return is_array($value) ? implode(',', $value) : $value;
    }


}
