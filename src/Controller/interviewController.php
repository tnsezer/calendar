<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 12.07.2018
 * Time: 18:50
 */
namespace App\Controller;

use App\Util\Schedule;
use App\Util\Appointment;
use App\Repository\Candidate;
use App\Repository\Interviewer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Exception\ErrorHandler;

class interviewController extends AbstractController
{
    use ErrorHandler;
    /**
     * Matches /interview exactly
     *
     * @Route("/interview", name="interview")
     */
    public function index(){
        try {
            $candidate = new Candidate("Carl");
            $candidate->setSchedule(new Schedule());
            $candidate->schedule
                ->setSlot([Schedule::MONDAY, Schedule::TUESDAY, Schedule::WEDNESDAY, Schedule::THURSDAY, Schedule::FRIDAY], [9, 10])
                ->setSlot(Schedule::WEDNESDAY, [10, 12]);

            $interviewer1 = new Interviewer("Philipp");
            $interviewer1->setSchedule(new Schedule());
            $interviewer1->schedule
                ->setSlot([Schedule::MONDAY, Schedule::TUESDAY, Schedule::WEDNESDAY, Schedule::THURSDAY, Schedule::FRIDAY], [9, 16]);

            $interviewer2 = new Interviewer("Sarah");
            $interviewer2->setSchedule(new Schedule());
            $interviewer2->schedule
                ->setSlot([Schedule::MONDAY, Schedule::WEDNESDAY], [12, 18])
                ->setSlot([Schedule::TUESDAY, Schedule::THURSDAY], [9, 12]);

        }catch (\Exception $e){
            return $this->validationError(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }
        $appointment = new Appointment();
        $appointment->setCandidate($candidate);
        $appointment->setInterviewers($interviewer1);
        $appointment->setInterviewers($interviewer2);

        try {
            $result = $appointment->query();
        }catch (\Exception $e){
            return $this->validationError(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }

        return  $this->json($result);
    }
}