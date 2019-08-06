<?php

return array (
  'autoload' => false,
  'hooks' => 
  array (
    'app_init' => 
    array (
      0 => 'cms',
    ),
    'response_send' => 
    array (
      0 => 'cms',
    ),
    'user_sidenav_after' => 
    array (
      0 => 'cms',
    ),
    'appendcommand' => 
    array (
      0 => 'flow',
    ),
    'testhook' => 
    array (
      0 => 'markdown',
    ),
    'config_init' => 
    array (
      0 => 'nkeditor',
    ),
    'run' => 
    array (
      0 => 'voicenotice',
    ),
  ),
  'route' => 
  array (
    '/$' => 'cms/index/index',
    '/a/[:diyname]' => 'cms/archives/index',
    '/t/[:name]' => 'cms/tags/index',
    '/p/[:diyname]' => 'cms/page/index',
    '/s' => 'cms/search/index',
    '/c/[:diyname]' => 'cms/channel/index',
    '/d/[:diyname]' => 'cms/diyform/index',
    '/special/[:diyname]' => 'cms/special/index',
  ),
);