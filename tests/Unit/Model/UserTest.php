<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 18.04.2019
 * Time: 00:10
 */

namespace App\Tests\Unit\Model;

use App\Model\Candidate;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /* @var User */
    private $user;

    public function setUp()
    {
        $this->user = new Candidate('test');
    }

    public function testGetName()
    {
        $this->assertEquals('test', $this->user->getName());
    }

    public function testGetCollection()
    {
        $this->assertEmpty($this->user->getCollection());

        $date1 = new \DateTime("2018-07-17 09:00");
        $date2 = new \DateTime("2018-07-17 10:00");

        $this->user->addAvailability($date1, $date2);

        $this->assertEquals([[$date1, $date2]], $this->user->getCollection());
    }

    public function testGetCollectionException1()
    {
        $date1 = new \DateTime("2018-07-17 10:00");
        $date2 = new \DateTime("2018-07-17 09:00");

        $this->expectException(\InvalidArgumentException::class);

        $this->user->addAvailability($date1, $date2);
    }

    public function testGetCollectionException2()
    {
        $date1 = new \DateTime("2018-07-17 09:00");
        $date2 = new \DateTime("2018-07-18 10:00");

        $this->expectException(\InvalidArgumentException::class);

        $this->user->addAvailability($date1, $date2);
    }

    public function testCheckAvailability()
    {
        $date1 = new \DateTime("2018-07-17 09:00");
        $date2 = new \DateTime("2018-07-17 10:00");

        $this->user->addAvailability($date1, $date2);

        $this->assertEquals([[$date1, $date2]], $this->user->checkAvailability($date1, $date2));
    }
}