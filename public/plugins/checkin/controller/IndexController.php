<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace plugins\checkin\controller; //Demo插件英文名，改成你的插件英文就行了
use cmf\controller\PluginBaseController;
use plugins\Checkin\Model\MeetingCheckinModel;
use plugins\Checkin\Model\MeetingModel;
use think\Db;

class IndexController extends PluginBaseController
{
    function index()
    {

    }


    function detail()
    {
        $id = $this->request->param('id');
        $meetingData       = new MeetingModel();
        $meeting = $meetingData->where('id','=',$id)->select();
        $this->assign("meeting",$meeting);

        $data = new MeetingCheckinModel();
        $obj = $data->where('meetingId', '=', $id)->select();
        $this->assign("obj",$obj);
        return $this->fetch("/detail");

    }
}
