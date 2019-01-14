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

class MeetingModel extends Model
{
    protected $table = 'meeting';
    public function AddMeeting()
        {
            $list =  ['date' => '2019-01-20','name' => '地下矿工','location' => 'nu space','category' => '音乐'];
            $this->allowField(true)->data($list, true)->isUpdate(false)->save();
            return $this;
        }

   public function getMeeting()
        {
            return $this->select();
        }


}