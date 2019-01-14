<?php

namespace app\meeting\controller;

use cmf\controller\HomeBaseController;
use app\meeting\Model\MeetingModel;
use app\meeting\Model\MeetingCheckinModel;


class QrcodeController extends HomeBaseController
{
    public function index()
    {

    }

    public function summary(){
        //需要用户id
        //用户的记录
        //测试使用userid 666 （insert几个数据）
    }

    public function currentmeeting(){
    //扫码后上传，然后跳转这里，
        //url 上跳转
        return $this->fetch("currentmeeting");
    }

    public function checkin(){
        //insert 签到
        //需要meeting id， user id， user phone，当前时间
        //结束后跳转 current meeting页面，带上meeting id

        $meetingId = $this->request->param('id');
        $testData =  ['user' => 'tobyTao','userId' => '666','meetingId' => $meetingId];


                       $checkin       = new MeetingCheckinModel();
                       $checkin   ->   AddMeeting($testData);

        return $this->fetch("currentmeeting");

    }


}