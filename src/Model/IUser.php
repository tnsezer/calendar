<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 12.07.2018
 * Time: 01:10
 */

namespace App\Model;

interface IUser
{
    public function getName(): string;
    public function checkAvailability(\DateTime $date1, \DateTime $date2): array;
    public function getCollection(): array;
    public function addAvailability(\DateTime $date1, \DateTime $date2): void;
}