<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 12.07.2018
 * Time: 18:30
 */

namespace App\Util;

class Schedule
{
    public $collection = [];
    public const MONDAY = "1";
    public const TUESDAY = "2";
    public const WEDNESDAY = "3";
    public const THURSDAY = "4";
    public const FRIDAY = "5";

    public function __construct()
    {

    }

    /**
     * @return array
     */
    public function getCollection(): array
    {
        return $this->collection;
    }

    /**
     * @param $days
     * @param array $hours
     * @return Schedule
     * @throws \Exception
     */
    public function setSlot($days, array $hours): self
    {
        if(count($hours) <> 2){
            throw new \Exception('hours format is wrong', 2001);
        }
        if($hours[0] >= $hours[1]){

            throw new \Exception('First hour must be smaller then second', 2002);
        }

        if($hours[0] < 1 || 24 < $hours[1]){
            throw new \Exception('Hours cannot be smaller then 1 or bigger then 24', 2003);
        }

        if(!is_array($days)){
            $days = [$days];
        }

        foreach ($days as $day) {
            $this->collection[$day][] = $hours;
        }

        return $this;
    }
}