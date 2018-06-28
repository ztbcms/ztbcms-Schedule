<?php
/**
 * Created by PhpStorm.
 * User: yezhilie
 * Date: 2018/6/28
 * Time: 9:27
 */

namespace Schedule\Model;

use Common\Model\Model;

class ScheduleModel extends Model{

    /**
     * 预约类型
     */
    const SCHEDULE_TYPE_WEEK = 1;   //每周某天
    const SCHEDULE_TYPE_MONTH = 2;  //每月某天
    const SCHEDULE_TYPE_DAY = 3;    //具体某天

}