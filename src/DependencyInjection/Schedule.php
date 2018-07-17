<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 12.07.2018
 * Time: 18:30
 */

namespace App\DependencyInjection;

class Schedule
{
    public $collection = [];

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
     * @param \DateTime $time1
     * @param \DateTime $time2
     * @return Schedule
     * @throws \Exception
     */
    public function setSlot(\DateTime $time1, \DateTime $time2): self
    {
        if($time1 >= $time2){
            throw new \Exception("time1 cannot bigger then time2");
        }

        $this->collection[] = [$time1, $time2];

        return $this;
    }
}