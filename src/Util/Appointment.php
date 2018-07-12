<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 12.07.2018
 * Time: 18:32
 */

namespace App\Util;

use App\Repository\Candidate;
use App\Repository\Interviewer;

class Appointment
{

    public $candidate = null;
    public $interviewers = [];

    /**
     * @param Candidate $candidate
     */
    public function setCandidate(Candidate $candidate): void
    {
        $this->candidate = $candidate;
    }

    /**
     * @param Interviewer $interviewer
     */
    public function setInterviewers(Interviewer $interviewer): void
    {
        $this->interviewers[] = $interviewer;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function query(): array
    {
        if(! $this->candidate instanceof Candidate){
            throw new \Exception('candidate has to be instanceof Candidate Class', 1001);
        }
        if(empty($this->interviewers)){
            throw new \Exception('Must set minimum one interviewer', 1002);
        }

        $firstInterviewerDate = $this->interviewers[0]->getSchedule();
        unset($this->interviewers[0]);

        foreach ($this->interviewers as $interviewer){
            $interviewerAvailable = $interviewer->getSchedule();

            foreach ($firstInterviewerDate as $day => $hours1){
                if(isset($interviewerAvailable[$day])) {
                    foreach ($interviewerAvailable[$day] as $hour2) {
                        foreach ($hours1 as $key => $hour1) {
                            $matched = true;
                            if ($hour2[0] <= $hour1[0] && $hour1[0] < $hour2[1]) {
                                $matched = false;
                            }
                            if($matched){
                                unset($firstInterviewerDate[$day][$key]);
                            }
                        }
                    }
                    if(empty($firstInterviewerDate[$day])){
                        unset($firstInterviewerDate[$day]);
                    }
                }else{
                    unset($firstInterviewerDate[$day]);
                }
            }
        }

        $availableCandidate = $this->candidate->getSchedule();
        $linearTime = array_intersect_key($availableCandidate, $firstInterviewerDate);

        return $linearTime;
    }
}