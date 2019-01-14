<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:kane < chengjin005@163.com>
// +----------------------------------------------------------------------
namespace plugins\checkin\model;

use think\Model;

class MeetingCheckinModel extends Model
{
    protected $table = 'meetingcheckin';
    public function AddUser()
        {

            $testData =  ['user' => 'tobyTao','userId' => '666','time' => 'current_timestamp()','meetingId' => '17'];
            $this->allowField(true)->data($testData, true)->isUpdate(false)->save();
            $this->allowField(true)->data($list, true)->isUpdate(false)->save();
            return $this;
        }

   public function getMeeting()
        {
            return $this->select();
        }


}