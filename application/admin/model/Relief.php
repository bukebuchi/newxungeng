<?php

namespace app\admin\model;

use think\Model;


class Relief extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'relief';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
'hobbydata_text'
    ];
    
 public function getHobbydataList()
    {
        return ['qd' => __('Hobbydata qd'), 'sd' => __('Hobbydata sd')];
    }
     public function getHobbydataTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['hobbydata']) ? $data['hobbydata'] : '');
        $valueArr = explode(',', $value);
        $list = $this->getHobbydataList();
        return implode(',', array_intersect_key($list, array_flip($valueArr)));
    }
     protected function setHobbydataAttr($value)
    {
        return is_array($value) ? implode(',', $value) : $value;
    }

    
public function admin()
    {
        return $this->belongsTo("app\admin\model\Admin", "admin_ids", 'id', [], 'LEFT')->setEagerlyType(0);
    }
    
public function addressname()
    {
        return $this->belongsTo("app\common\model\Category", "addressname_ids", 'id', [], 'LEFT')->setEagerlyType(0);
    }   
    public function mesh()
    {
        return $this->belongsTo("app\common\model\Category", "mesh_ids", 'id', [], 'LEFT')->setEagerlyType(0);
    }   
public function dname()
    {
        return $this->belongsTo("app\common\model\Category", "dname_ids", 'id', [], 'LEFT')->setEagerlyType(0);
    }




}
