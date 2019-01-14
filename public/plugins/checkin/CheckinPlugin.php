<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace plugins\checkin;//Demo插件英文名，改成你的插件英文就行了
use plugins\Checkin\Model\MeetingModel;
use cmf\lib\Plugin;

//Demo插件英文名，改成你的插件英文就行了
class CheckinPlugin extends Plugin
{

    public $info = [
        'name'        => 'Checkin',//Demo插件英文名，改成你的插件英文就行了
        'title'       => 'Checkin',
        'description' => 'Checkin',
        'status'      => 1,
        'author'      => 'ThinkCMF',
        'version'     => '1.0',
        'demo_url'    => 'http://demo.thinkcmf.com',
        'author_url'  => 'http://www.thinkcmf.com'
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

    //实现的before_head_end钩子方法
    public function beforeHeadEnd($param)
    {
        $data       = new MeetingModel();
        $meeting = $data->getMeeting();
        $this->assign("meeting", $meeting);
        echo $this->fetch('widget');
    }

}