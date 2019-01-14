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
namespace app\meeting\model;

use think\Model;

class MeetingCheckinModel extends Model
{
    protected $table = 'meetingcheckin';
    public function AddMeeting($data)
        {
            $this->allowField(true)->data($data, true)->isUpdate(false)->save();
            return $this;
        }

   public function getMeeting()
        {
            return $this->select();
        }


}