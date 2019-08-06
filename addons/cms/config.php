<?php

return array (
  0 => 
  array (
    'name' => 'sitename',
    'title' => '站点名称',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '智能巡更系统',
    'rule' => 'required',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  1 => 
  array (
    'name' => 'title',
    'title' => '首页标题',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '首页',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  2 => 
  array (
    'name' => 'keywords',
    'title' => '首页关键字',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '首页',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  3 => 
  array (
    'name' => 'description',
    'title' => '首页描述',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '首页',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  4 => 
  array (
    'name' => 'theme',
    'title' => '皮肤',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => 'default',
    'rule' => 'required',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  5 => 
  array (
    'name' => 'qrcode',
    'title' => '公众号二维码',
    'type' => 'image',
    'content' => 
    array (
    ),
    'value' => '/uploads/20190704/9d116b68a3eb49d3d4dab8cb2f7c1a38.png',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  6 => 
  array (
    'name' => 'wxapp',
    'title' => '小程序二维码',
    'type' => 'image',
    'content' => 
    array (
    ),
    'value' => '/uploads/20190704/9d116b68a3eb49d3d4dab8cb2f7c1a38.png',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  7 => 
  array (
    'name' => 'donateimage',
    'title' => '打赏图片',
    'type' => 'image',
    'content' => 
    array (
    ),
    'value' => '/uploads/20190704/9d116b68a3eb49d3d4dab8cb2f7c1a38.png',
    'rule' => '',
    'msg' => '',
    'tip' => '打赏图片，请使用300*300的图片',
    'ok' => '',
    'extend' => '',
  ),
  8 => 
  array (
    'name' => 'default_archives_img',
    'title' => '文档默认图片',
    'type' => 'image',
    'content' => 
    array (
    ),
    'value' => '/uploads/20190704/9d116b68a3eb49d3d4dab8cb2f7c1a38.png',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  9 => 
  array (
    'name' => 'default_channel_img',
    'title' => '栏目默认图片',
    'type' => 'image',
    'content' => 
    array (
    ),
    'value' => '/uploads/20190704/9d116b68a3eb49d3d4dab8cb2f7c1a38.png',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  10 => 
  array (
    'name' => 'default_block_img',
    'title' => '区块默认图片',
    'type' => 'image',
    'content' => 
    array (
    ),
    'value' => '/uploads/20190704/9d116b68a3eb49d3d4dab8cb2f7c1a38.png',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  11 => 
  array (
    'name' => 'default_page_img',
    'title' => '单页默认图片',
    'type' => 'image',
    'content' => 
    array (
    ),
    'value' => '/uploads/20190704/9d116b68a3eb49d3d4dab8cb2f7c1a38.png',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  12 => 
  array (
    'name' => 'default_special_img',
    'title' => '专题默认图片',
    'type' => 'image',
    'content' => 
    array (
    ),
    'value' => '/uploads/20190704/9d116b68a3eb49d3d4dab8cb2f7c1a38.png',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  13 => 
  array (
    'name' => 'domain',
    'title' => '绑定二级域名前缀',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  14 => 
  array (
    'name' => 'downloadtype',
    'title' => '下载类型字典',
    'type' => 'array',
    'content' => 
    array (
    ),
    'value' => 
    array (
      'baidu' => '百度网盘',
      'local' => '本地',
      'other' => '其它',
    ),
    'rule' => 'required',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  15 => 
  array (
    'name' => 'rewrite',
    'title' => '伪静态',
    'type' => 'array',
    'content' => 
    array (
    ),
    'value' => 
    array (
      'index/index' => '/$',
      'archives/index' => '/a/[:diyname]',
      'tags/index' => '/t/[:name]',
      'page/index' => '/p/[:diyname]',
      'search/index' => '/s',
      'channel/index' => '/c/[:diyname]',
      'diyform/index' => '/d/[:diyname]',
      'special/index' => '/special/[:diyname]',
    ),
    'rule' => 'required',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  16 => 
  array (
    'name' => 'wxappid',
    'title' => '小程序AppID',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '小程序appid',
    'rule' => 'required',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  17 => 
  array (
    'name' => 'wxappsecret',
    'title' => '小程序AppSecret',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '小程序secret',
    'rule' => 'required',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
  18 => 
  array (
    'name' => 'isaudit',
    'title' => '内容审核',
    'type' => 'radio',
    'content' => 
    array (
      1 => '开启',
      0 => '关闭',
    ),
    'value' => '1',
    'rule' => 'required',
    'msg' => '',
    'tip' => '开启内容审核后，违法或广告内容都将发布失败',
    'ok' => '',
    'extend' => '',
  ),
  19 => 
  array (
    'name' => 'audittype',
    'title' => '审核方式',
    'type' => 'radio',
    'content' => 
    array (
      'local' => '本地',
      'baiduyun' => '百度云',
    ),
    'value' => 'local',
    'rule' => 'required',
    'msg' => '',
    'tip' => '如果启用百度云，请输入百度云AI平台应用的AK和SK',
    'ok' => '',
    'extend' => '',
  ),
  20 => 
  array (
    'name' => 'nlptype',
    'title' => '分词方式',
    'type' => 'radio',
    'content' => 
    array (
      'local' => '本地',
      'baiduyun' => '百度云',
    ),
    'value' => 'local',
    'rule' => 'required',
    'msg' => '',
    'tip' => '如果启用百度云，请输入百度云AI平台应用的AK和SK',
    'ok' => '',
    'extend' => '',
  ),
  21 => 
  array (
    'name' => 'aip_appid',
    'title' => '百度AI平台应用Appid',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '',
    'rule' => '',
    'msg' => '',
    'tip' => '百度云AI开放平台应用AppId',
    'ok' => '',
    'extend' => '',
  ),
  22 => 
  array (
    'name' => 'aip_apikey',
    'title' => '百度AI平台应用Apikey',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '',
    'rule' => '',
    'msg' => '',
    'tip' => '百度云AI开放平台应用ApiKey',
    'ok' => '',
    'extend' => '',
  ),
  23 => 
  array (
    'name' => 'aip_secretkey',
    'title' => '百度AI平台应用Secretkey',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '',
    'rule' => '',
    'msg' => '',
    'tip' => '百度云AI开放平台应用Secretkey',
    'ok' => '',
    'extend' => '',
  ),
  24 => 
  array (
    'name' => 'apikey',
    'title' => 'ApiKey',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '',
    'rule' => '',
    'msg' => '',
    'tip' => '用于调用API接口时写入数据权限控制<br>可以为空',
    'ok' => '',
    'extend' => '',
  ),
  25 => 
  array (
    'name' => 'archiveseditmode',
    'title' => '文档编辑模式',
    'type' => 'radio',
    'content' => 
    array (
      'addtabs' => '新选项卡',
      'dialog' => '弹窗',
    ),
    'value' => 'dialog',
    'rule' => '',
    'msg' => '',
    'tip' => '在添加或编辑文档时的操作方式',
    'ok' => '',
    'extend' => '',
  ),
  26 => 
  array (
    'name' => 'channelallocate',
    'title' => '栏目授权',
    'type' => 'radio',
    'content' => 
    array (
      1 => '开启',
      0 => '关闭',
    ),
    'value' => '0',
    'rule' => '',
    'msg' => '',
    'tip' => '开启后可以单独给管理员分配可管理的内容栏目',
    'ok' => '',
    'extend' => '',
  ),
  27 => 
  array (
    'name' => 'conactqq',
    'title' => '联系我们QQ',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '',
    'rule' => '',
    'msg' => '',
    'tip' => '合作伙伴和友情链接的联系QQ',
    'ok' => '',
    'extend' => '',
  ),
  28 => 
  array (
    'name' => 'autolinks',
    'title' => '关键字链接',
    'type' => 'array',
    'content' => 
    array (
    ),
    'value' => 
    array (
      '服务器' => 'https://www.fastadmin.net/go/aliyun',
      '阿里云' => 'https://www.fastadmin.net/go/aliyun',
    ),
    'rule' => 'required',
    'msg' => '',
    'tip' => '对应的关键字将会自动加上链接',
    'ok' => '',
    'extend' => '',
  ),
  29 => 
  array (
    'name' => '__tips__',
    'title' => '温馨提示',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '1.如果需要将CMS绑定到首页,请移除伪静态中的<b>cms/</b><br>2.默认CMS不包含富文本编辑器插件，请在<a href="https://www.fastadmin.net/store.html?category=16" target="_blank">插件市场</a>按需要安装<br>3.如果需要启用付费阅读或付费下载,请务必安装<a href="https://www.fastadmin.net/store/epay.html" target="_blank">微信支付宝</a>整合插件',
    'rule' => '',
    'msg' => '',
    'tip' => '',
    'ok' => '',
    'extend' => '',
  ),
);
