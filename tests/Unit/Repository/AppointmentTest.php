<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 18.04.2019
 * Time: 00:21
 */

namespace App\Tests\Unit\Repository;

use App\Repository\Appointment;
use App\Model\Candidate;
use App\Model\Interviewer;
use PHPUnit\Framework\TestCase;

class AppointmentTest extends TestCase
{
    /**
     * @var Candidate
     */
    private $candidate;

    /**
     * @var Interviewer
     */
    private $interviewer;

    public function setUp()
    {
        $this->candidate = new Candidate('Candidate');
        $this->interviewer = new Interviewer('Interviewer1');
    }
    
    public function testQuery()
    {
        $date1 = new \DateTime("2018-07-17 09:00");
        $date2 = new \DateTime("2018-07-17 10:00");

        $this->candidate->addAvailability($date1, $date2);
        $this->interviewer->addAvailability($date1, $date2);

        $appointment = new Appointment($this->candidate);
        $appointment->addInterviewer($this->interviewer);

        $this->assertEquals([[$date1, $date2]], $appointment->query());
    }

    public function testQueryException()
    {
        $appointment = new Appointment($this->candidate);
        $this->expectException(\InvalidArgumentException::class);
        $appointment->query();
    }
}