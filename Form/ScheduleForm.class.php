<?php
/**
 * Created by PhpStorm.
 * User: yezhilie
 * Date: 2018/6/28
 * Time: 11:01
 */
namespace Schedule\Form;

class scheduleForm
{
    private $id;
    private $schedule_type;
    private $target_type;
    private $target;
    private $add_time;
    private $ruleList;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getScheduleType()
    {
        return $this->schedule_type;
    }

    /**
     * @param mixed $schedule_type
     */
    public function setScheduleType($schedule_type)
    {
        $this->schedule_type = $schedule_type;
    }

    /**
     * @return mixed
     */
    public function getTargetType()
    {
        return $this->target_type;
    }

    /**
     * @param mixed $target_type
     */
    public function setTargetType($target_type)
    {
        $this->target_type = $target_type;
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param mixed $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * @return mixed
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * @param mixed $add_time
     */
    public function setAddTime($add_time)
    {
        $this->add_time = $add_time;
    }

    /**
     * @return mixed
     */
    public function getRuleList()
    {
        return $this->ruleList;
    }

    /**
     * @param mixed $ruleList
     */
    public function setRuleList($ruleList)
    {
        $this->ruleList = $ruleList;
    }


    /**
     * @param $where
     * @return $this
     */
    public function getSchedule($where){
        $schedule = D('Schedule/Schedule')->where($where)->find();
        $this->setId($schedule['id']);
        $this->setScheduleType($schedule['schedule_type']);
        $this->setTargetType($schedule['target_type']);
        $this->setTarget($schedule['target']);
        $this->setAddTime($schedule['add_time']);

        $ruleList = [];
        $list = D('Schedule/Rule')->where(['schedule_id' => $schedule['id']])->select();
        foreach($list as $v){
            $ruleList[] = new RuleForm($v);
        }
        $this->setRuleList($ruleList);
        return $this;
    }

    public function updateSchedule(){
        $id = $this->getId();
        $data = [
            'schedule_type' => $this->getScheduleType(),
            'target_type' => $this->getTargetType(),
            'target' => $this->getTarget()
        ];
        if($id){
            D('Schedule/Schedule')->where(['id' => $id])->save($data);
        }else{
            $data['add_time'] = time();
            $id = D('Schedule/Schedule')->add($data);
        }
        D('Schedule/Rule')->where(['schedule_id' => $id])->delete();
        $ruleList = $this->getRuleList();
        foreach($ruleList as $v){
            $data = [
                'schedule_id' => $id,
                'start_time' => $v->getStartTime(),
                'end_time' => $v->getEndTime(),
                'year' => $v->getYear(),
                'month' => $v->getMonth(),
                'day' => $v->getDay(),
                'week' => $v->getWeek(),
            ];
            D('Schedule/Rule')->add($data);
        }
    }
}