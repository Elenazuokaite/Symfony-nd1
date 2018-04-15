<?php
namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class StudentController extends Controller {

    const DATA = 'data.json';
    /**
     * @Route("/", name="student_list")
     */
    public function allStudent() {

        return $this->render('student/index.html.twig', array("allStudents" => $this->getStudent()));
    }
    /**
     * @Route("/student/{id}", name="student")
     */
    public function student($id) {

        return $this->render('student/view.html.twig', array("student" => $this->getStudent($id)));
    }

    private function getStudent($id = null){

        $jsonData = file_get_contents(self::DATA);
        $data = json_decode($jsonData, true);
        $allStudents = array();

        foreach ($data as $team => $members){
            foreach ($members["members"] as $student){
                $allStudents[] = array("team" => $team, "mentor" => $members["mentor"], "name" => $student);
            }
        }
        return isset($id) && array_key_exists($id, $allStudents) ? $allStudents[$id] : $allStudents;
    }
}
