<?php
/**
 * Created by PhpStorm.
 * User: yezhilie
 * Date: 2018/6/25
 * Time: 15:47
 */

namespace Schedule\Service;

use Schedule\Form\RuleForm;
use Schedule\Form\scheduleForm;
use System\Service\BaseService;

class ScheduleService extends BaseService{

    /**
     * 添加/修改 预约
     *
     * @param $id
     * @param $type
     * @param $target_type
     * @param $target
     * @param $years
     * @param $months
     * @param $days
     * @param $weeks
     * @param int $start_time
     * @param int $end_time
     * @return array
     */
    static function addEditSchedule($id, $type, $target_type, $target, $years, $months, $days, $weeks, $start_time = 0, $end_time = 0){
        $schedule = new scheduleForm();
        $schedule->setId($id);
        $schedule->setScheduleType($type);
        $schedule->setTargetType($target_type);
        $schedule->setTarget($target);
        $ruleList = [];
        for($i = 0;$i < count($years); $i++){
            $rule = new RuleForm();
            $rule->setYear($years[$i]);
            $rule->setMonth($months[$i]);
            $rule->setDay($days[$i]);
            $rule->setWeek($weeks[$i]);
            $rule->setStartTime($start_time);
            $rule->setEndTime($end_time);
            $ruleList[] = $rule;
        }
        $schedule->setRuleList($ruleList);
        $schedule->updateSchedule();
        return self::createReturn(true, null, '操作成功');
    }

    /**
     * 获取预约
     *
     * @param $id
     * @return array
     */
    static function getSchedule($id){
        $data = D('Schedule/Schedule')->where(['id' => $id])->find();
        $data['ruleList'] = D('Schedule/Rule')->where(['schedule_id' => $id])->select();
        return self::createReturn(true, $data, '获取成功');
    }

    /**
     * 删除预约
     *
     * @param $id
     * @return array
     */
    static function delSchedule($id){
        D('Schedule/Schedule')->where(['id' => $id])->delete();
        D('Schedule/Rule')->where(['schedule_id' => $id])->delete();
        return self::createReturn(true, null, '操作成功');
    }

    /**
     * 检测某个时间是否在预约时间内
     *
     * @param $type
     * @param $target_type
     * @param $target
     * @param $time
     * @param bool $ignore_time 是否忽略时间区间
     * @return bool
     */
    static function isExistSchedule($type, $target_type, $target, $time, $ignore_time = true){
        $schedule_ids = D('Schedule/Schedule')->where([
            'schedule_type' => $type,
            'target_type' => $target_type,
            'target' => $target
        ])->getField('id', true);
        if($schedule_ids){
            $year = date('Y', $time);
            $month = date('m', $time);
            $day = date('d', $time);
            $week = date('w', $time);
            if($week == 0) $week = 7; //0是周日，改为7

            $where = ['schedule_id' => ['IN', $schedule_ids]];
            if(!$ignore_time){
                $where['start_time'] = ['ELT', $time];
                $where['end_time'] = ['EGT', $time];
            }
            $str_where = '(`year` = 0 or `year` = '.$year.')and(`month` = 0 or `month` = '.$month.')and(`day` = 0 or `day` = '.$day.')and(`week` = 0 or `week` = '.$week.')';
            $count = D('Schedule/Rule')->where($where)->where($str_where)->count();
            if($count){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}