<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 12.07.2018
 * Time: 18:27
 */

namespace App\Repository;


class Interviewer extends User
{
    protected $type = "I";

    public function __construct($name)
    {
        parent::__construct($name);
    }
}