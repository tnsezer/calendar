<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 12.07.2018
 * Time: 18:16
 */

namespace App\Model;

abstract class User implements IUser
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $collection = [];

    /**
     * User constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param \DateTime $date1
     * @param \DateTime $date2
     * @return array
     */
    public function checkAvailability(\DateTime $date1, \DateTime $date2): array
    {
        $result = [];

        foreach ($this->collection as $dates) {
            if ($date1 < $dates[1] && $date2 > $dates[0]) {
                $collect = [];
                if ($date1 >= $dates[0]) {
                    $collect[] = $date1;
                } else {
                    $collect[] = $dates[0];
                }

                if ($date2 <= $dates[1]) {
                    $collect[] = $date2;
                } else {
                    $collect[] = $dates[1];
                }

                $result[] = $collect;
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getCollection(): array
    {
        return $this->collection;
    }

    /**
     * @param \DateTime $date1
     * @param \DateTime $date2
     */
    public function addAvailability(\DateTime $date1, \DateTime $date2): void
    {
        if ($date1 >= $date2){
            throw new \InvalidArgumentException('Start date cannot be bigger then end date', 1010);
        }

        if ($date1->format('Y-m-d') !== $date2->format('Y-m-d')) {
            throw new \InvalidArgumentException('times must have same date', 1011);
        }

        $this->collection[] = [$date1, $date2];
    }
}