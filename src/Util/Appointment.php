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
use App\Exception\ErrorHandler;

class Appointment
{
    use ErrorHandler;

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
     * @return array|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function query()
    {
        if(! $this->candidate instanceof Candidate){
            return $this->validationError(['code' => 1001, 'message' => 'candidate has to be instanceof Candidate Class']);
        }
        if(empty($this->interviewers)){
            return $this->validationError(['code' => 1002, 'message' => 'Must set minimum one interviewer']);
        }

        $firstInterviewerDate = current($this->interviewers)->getSchedule();
        next($this->interviewers);

        foreach ($this->interviewers as $interviewer){
            $interviewerAvailable = $interviewer->getSchedule();

            foreach ($firstInterviewerDate as $key => $firstDate){
                $matched = false;
                foreach ($interviewerAvailable as $date){
                    if($firstDate[0] >= $date[0] && $firstDate[0] <= $date[1]){
                        $matched = true;
                        break;
                    }
                }

                if(! $matched){
                    unset($firstInterviewerDate[$key]);
                }
            }
        }

        $availableCandidate = $this->candidate->getSchedule();
        foreach ($availableCandidate as $key => $firstDate){
            $matched = false;
            foreach ($firstInterviewerDate as $date){
                if($firstDate[0] >= $date[0] && $firstDate[0] <= $date[1]){
                    $matched = true;
                    $firstDate[1] = clone $firstDate[0];
                    $firstDate[1]->modify("+1 hour");
                    break;
                }
            }

            if(! $matched){
                unset($availableCandidate[$key]);
            }
        }

        return $availableCandidate;
    }
}