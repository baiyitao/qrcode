<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace plugins\meeting;//Demo插件英文名，改成你的插件英文就行了
use cmf\lib\Plugin;


//Demo插件英文名，改成你的插件英文就行了
class MeetingPlugin extends Plugin
{

    public $info = [
        'name'        => 'Meeting',//Demo插件英文名，改成你的插件英文就行了
        'title'       => '二维码签到',
        'description' => '二维码签到',
        'status'      => 1,
        'author'      => 'tobyrocktao',
        'version'     => '1.0',
        'demo_url'    => '',
        'author_url'  => ''
    ];

    public $hasAdmin = 0;//插件是否有后台管理界面

    // 插件安装
    public function install()
    {
        return true;//安装成功返回true，失败false
    }

    // 插件卸载
    public function uninstall()
    {
        return true;//卸载成功返回true，失败false
    }

    //实现的before_body_end	钩子方法
    public function beforeHeadEnd($param)
    {
        echo $this->fetch('widget');
    }

}