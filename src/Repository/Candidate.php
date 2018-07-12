<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 12.07.2018
 * Time: 18:26
 */

namespace App\Repository;


class Candidate extends User
{
    protected $type = "C";

    public function __construct($name)
    {
        parent::__construct($name);
    }
}