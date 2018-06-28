<?php
/**
 * Created by PhpStorm.
 * User: yezhilie
 * Date: 2018/6/28
 * Time: 11:01
 */
namespace Schedule\Form;

class RuleForm
{
    private $id;
    private $schedule_id;
    private $start_time = 0;
    private $end_time = 0;
    private $year = 0;
    private $month = 0;
    private $day = 0;
    private $week = 0;

    public function __construct($data = [])
    {
        if($data){
            $this->setId($data['id']);
            $this->setScheduleId($data['id']);
            $this->setStartTime($data['start_time']);
            $this->setEndTime($data['end_time']);
            $this->setYear($data['year']);
            $this->setMonth($data['month']);
            $this->setDay($data['day']);
            $this->setWeek($data['week']);
        }
        return $this;
    }

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
    public function getScheduleId()
    {
        return $this->schedule_id;
    }

    /**
     * @param mixed $schedule_id
     */
    public function setScheduleId($schedule_id)
    {
        $this->schedule_id = $schedule_id;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * @param mixed $start_time
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @param mixed $end_time
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param mixed $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @return mixed
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * @param mixed $week
     */
    public function setWeek($week)
    {
        $this->week = $week;
    }


}