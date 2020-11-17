<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Student;
use App\Logger\Log;
use phpDocumentor\Reflection\Location;

class StudentController
{

    public function __construct()
    {
        if (isset($_GET) && ($_GET["action"] == "create")) {
            $this->create();
            return;
        }

        if (isset($_GET) && ($_GET["action"] == "store")) {
            $this->store($_POST);
            return;
        }

        if (isset($_GET) && ($_GET["action"] == "edit")) {
            $this->edit($_GET["id"]);
            return;
        }

        if (isset($_GET) && ($_GET["action"] == "update")) {
            $this->update($_POST, $_GET["id"]);
            return;
        }

        if (isset($_GET) && ($_GET["action"] == "delete")) {

            $this->delete($_GET["id"]);
            return;
        }
        if (isset($_GET) && ($_GET["action"] == "done")) {
            $this->done($_GET["id"]);
            return;
        }
        if (isset($_GET) && ($_GET["action"] == "savedone")) {
            $this->savedone($_GET["id"]);
            return;
        }
        if (isset($_GET) && ($_GET["action"] == "archived")) {
            $this->archived($_GET["id"]);
            return;
        }

        $this->index();
    }

    public function index(): void
    {
        $studentsList = Student::all();

        new View("StudentsList", [
            "students" => $studentsList,
        ]);
    }

    public function create(): void
    {
        new View("CreateStudent");
    }

    public function store(array $request): void
    {    
        $newStudent = new Student($request["name"]);
        $newStudent->save();
        $log = new Log("Create","Created a new student", $newStudent->getId());
        $log->LogInFile();
        

        $this->index();
    }

    public function delete($id)
    {
        $studentToDelete = Student::findById($id);
        $studentToDelete->delete();
        $log = new Log("Delete","Delete a student", $id);
        $log->LogInFile();

        $this->index();
    }

    public function edit($id)
    {
        $studentToEdit = Student::findById($id);
        new View("EditStudent", ["student" => $studentToEdit]);
    }

    public function update(array $request, $id)
    {
        $studentToUpdate = Student::findById($id);
        $studentToUpdate->rename($request["name"]);
        $studentToUpdate->Update();
        $log = new Log("Update","Update a student", $id);
        $log->LogInFile();

        $this->index();
    }
    public function done($id)
    {    
        $studentDone = Student::findById($id);
    
        new View("DoneStudent", ["student" => $studentDone]);
    }

    public function savedone($id)
    {
        $studentDoneSave = Student::findById($id);
        $studentDoneSave->done();
        $studentsList = Student::allStudentDone();
        $log = new Log("Archive","Archive a student", $id);
        $log->LogInFile();

        new View("ListDoneStudents", [
            "students" => $studentsList,
        ]);

    }
    public function archived()
        {
            $studentsList = Student::allStudentDone();
            new View("ListDoneStudents", [
                "students" => $studentsList,
            ]);

        }

}
