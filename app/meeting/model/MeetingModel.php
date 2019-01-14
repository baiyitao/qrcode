<?php

namespace app\meeting\model;
use think\Model;

class MeetingModel extends Model
{
    protected $table = 'meeting';

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