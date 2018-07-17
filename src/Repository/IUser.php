<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 12.07.2018
 * Time: 01:10
 */

namespace App\Repository;

use App\DependencyInjection\Schedule;

interface IUser
{
    public function create(string $name);
    public function setSchedule(Schedule $schedule);
    public function getSchedule();
}