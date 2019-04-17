<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 12.07.2018
 * Time: 18:32
 */

namespace App\Repository;

use App\Model\Candidate;
use App\Model\Interviewer;

class Appointment
{
    /**
     * @var Candidate
     */
    private $candidate;

    /**
     * @var array
     */
    private $interviewers = [];

    /**
     * Appointment constructor.
     * @param Candidate $candidate
     */
    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }

    /**
     * @param Interviewer $interviewer
     */
    public function addInterviewer(Interviewer $interviewer): void
    {
        $this->interviewers[] = $interviewer;
    }

    /**
     * @return array
     */
    public function query(): array
    {
        if(empty($this->interviewers)){
            throw new \InvalidArgumentException('Must set minimum 1 interviewer', 1002);
        }

        $dateCollection = $this->candidate->getCollection();
        foreach ($this->interviewers as $interviewer){
            $result = [];
            foreach ($dateCollection as $dates) {
                $hours = $interviewer->checkAvailability($dates[0], $dates[1]);
                if (!empty($hours)) {
                    $result = array_merge($result, $hours);
                }
            }

            $dateCollection = $result;
        }

        return $dateCollection;
    }
}