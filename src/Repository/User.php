<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 12.07.2018
 * Time: 18:16
 */

namespace App\Repository;

use App\DependencyInjection\Schedule;

abstract class User implements IUser
{
    protected $type;
    public $name;
    public $schedule;

    public function __construct(string $name)
    {
        $this->create($name);
    }

    /**
     * @param string $name
     */
    public function create(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param Schedule $schedule
     */
    public function setSchedule(Schedule $schedule): void
    {
        $this->schedule = $schedule;
    }

    /**
     * @return array
     */
    public function getSchedule(): array
    {
        return $this->schedule->getCollection();
    }

}