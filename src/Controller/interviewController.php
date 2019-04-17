<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 12.07.2018
 * Time: 18:50
 */
namespace App\Controller;

use App\Repository\Appointment;
use App\Model\Candidate;
use App\Model\Interviewer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Exception\ErrorHandler;
use Symfony\Component\Routing\Annotation\Route;

class interviewController extends AbstractController
{
    use ErrorHandler;

    /**
     * Matches /interview exactly
     *
     * @Route("/interview", name="interview")
     */
    public function index(){
            $candidate = new Candidate("Carl");
            $interviewer1 = new Interviewer("Philipp");
            $interviewer2 = new Interviewer("Sarah");


        try {
            $candidate->addAvailability(new \DateTime("2018-07-17 09:00"), new \DateTime("2018-07-17 10:00"));
            $candidate->addAvailability(new \DateTime("2018-07-18 09:00"), new \DateTime("2018-07-18 10:00"));
            $candidate->addAvailability(new \DateTime("2018-07-19 09:00"), new \DateTime("2018-07-19 10:00"));
            $candidate->addAvailability(new \DateTime("2018-07-20 09:00"), new \DateTime("2018-07-20 10:00"));
            $candidate->addAvailability(new \DateTime("2018-07-18 10:00"), new \DateTime("2018-07-18 12:00"));

            $interviewer1->addAvailability(new \DateTime("2018-07-16 09:00"), new \DateTime("2018-07-16 16:00"));
            $interviewer1->addAvailability(new \DateTime("2018-07-17 09:00"), new \DateTime("2018-07-17 16:00"));
            $interviewer1->addAvailability(new \DateTime("2018-07-18 09:00"), new \DateTime("2018-07-18 16:00"));
            $interviewer1->addAvailability(new \DateTime("2018-07-19 09:00"), new \DateTime("2018-07-19 16:00"));
            $interviewer1->addAvailability(new \DateTime("2018-07-20 09:00"), new \DateTime("2018-07-20 16:00"));
            $interviewer1->addAvailability(new \DateTime("2018-07-21 09:00"), new \DateTime("2018-07-21 16:00"));
            $interviewer1->addAvailability(new \DateTime("2018-07-22 09:00"), new \DateTime("2018-07-22 16:00"));

            $interviewer2->addAvailability(new \DateTime("2018-07-16 12:00"), new \DateTime("2018-07-16 18:00"));
            $interviewer2->addAvailability(new \DateTime("2018-07-18 12:00"), new \DateTime("2018-07-18 18:00"));
            $interviewer2->addAvailability(new \DateTime("2018-07-17 09:00"), new \DateTime("2018-07-17 12:00"));
            $interviewer2->addAvailability(new \DateTime("2018-07-19 09:00"), new \DateTime("2018-07-19 12:00"));
        }catch (\InvalidArgumentException $e){
            return $this->validationError(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }

        $appointment = new Appointment($candidate);
        $appointment->addInterviewer($interviewer1);
        $appointment->addInterviewer($interviewer2);

        try {
            $result = $appointment->query();
        }catch (\InvalidArgumentException $e){
            return $this->validationError(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }

        if(is_object($result)){
            return $result;
        }

        return  $this->json($result);
    }
}