<?php

namespace app\admin\model;

use think\Model;


class Safety extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'safety';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'xingshihobbydata_text',
        'contenthobbydata_text'
    ];
    

    
    public function getXingshihobbydataList()
    {
        return ['kt' => __('Xingshihobbydata kt'), 'ff' => __('Xingshihobbydata ff'), 'yb' => __('Xingshihobbydata yb'), 'xl' => __('Xingshihobbydata xl'), 'zb' => __('Xingshihobbydata zb')];
    }

    public function getContenthobbydataList()
    {
        return ['ff' => __('Contenthobbydata ff'), 'fh' => __('Contenthobbydata fh'), 'yj' => __('Contenthobbydata yj')];
    }


    public function getXingshihobbydataTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['xingshihobbydata']) ? $data['xingshihobbydata'] : '');
        $valueArr = explode(',', $value);
        $list = $this->getXingshihobbydataList();
        return implode(',', array_intersect_key($list, array_flip($valueArr)));
    }


    public function getContenthobbydataTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['contenthobbydata']) ? $data['contenthobbydata'] : '');
        $valueArr = explode(',', $value);
        $list = $this->getContenthobbydataList();
        return implode(',', array_intersect_key($list, array_flip($valueArr)));
    }

    protected function setXingshihobbydataAttr($value)
    {
        return is_array($value) ? implode(',', $value) : $value;
    }

    protected function setContenthobbydataAttr($value)
    {
        return is_array($value) ? implode(',', $value) : $value;
    }


}
