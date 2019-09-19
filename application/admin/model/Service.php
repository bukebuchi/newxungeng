<?php

namespace app\admin\model;

use think\Model;


class Service extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'service';
    
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
 
 public function addressname()
    {
        return $this->belongsTo("app\common\model\Category", "addressname_ids", 'id', [], 'LEFT')->setEagerlyType(0);
    }   
    public function mesh()
    {
        return $this->belongsTo("app\common\model\Category", "mesh_ids", 'id', [], 'LEFT')->setEagerlyType(0);
    }   
public function street()
    {
        return $this->belongsTo("app\common\model\Category", "Street_ids", 'id', [], 'LEFT')->setEagerlyType(0);
    } 


}
