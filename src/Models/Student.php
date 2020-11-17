<?php


namespace App\Models;


use App\Database;

class Student
{
   
    private string $name;
    private $database;
    private $table = "students";

    public function __construct(string $name = '')
    {
        $this->name = $name;
        $this->id = uniqid();
        $this->created_at = date("Y-m-d H:i:s");

        if (!$this->database) {
            $this->database = new Database();
        }
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function rename($name)
    {
        $this->name = $name;
    }

    public function save(): void
    {
        $this->database->mysql->query("INSERT INTO `{$this->table}` (`name`, `id`, `created_at`) VALUES ('{$this->name}', '{$this->id}', '{$this->created_at}');");
    }

    public static function all()
    {
        $database = new Database();
        $query = $database->mysql->query("SELECT * FROM students WHERE `done` LIKE false");
        $studentsArray = $query->fetchAll();
        $studentList = [];
        foreach ($studentsArray as $student) {
            $studentItem = new self($student["name"]);
            $studentItem->completeStudent($student["id"], $student["created_at"]);
            array_push($studentList, $studentItem);
        }

        return $studentList;
    }

    public function completeStudent(string $id, string $created_at) :void
    {    
        $this->id = $id;
        $this->created_at = $created_at;                
    }


    public function delete()
    {
        $query = $this->database->mysql->query("DELETE FROM `students` WHERE `students`.`id` = {$this->id}");
    }

    public static function findById($id): Student
    {
        $database = new Database();
        $query = $database->mysql->query("SELECT * FROM `students` WHERE `id` = {$id}");
        $result = $query->fetchAll();
        $student = new self($result[0]["name"]);
        $student->completeStudent($result[0]["id"],$result[0]["created_at"]);
        return $student;

    }

    public function Update()
    {
        $this->database->mysql->query("UPDATE `students` SET `name` =  '{$this->name}' WHERE `id` = {$this->id}");
    }

    public function done()
    {
        $this->database->mysql->query("UPDATE `students` SET `done` = true WHERE `id` = {$this->id}");
        
    }

    public static function allStudentDone()
    {
        $database = new Database();
        $query = $database->mysql->query("SELECT * FROM students WHERE `done` LIKE true");
        $studentsArray = $query->fetchAll();
        $studentList = [];
        foreach ($studentsArray as $student) {
            $studentItem = new self($student["name"]);
            $studentItem->completeStudent($student["id"], $student["created_at"]);
            array_push($studentList, $studentItem);
        }

        return $studentList;
    }
}
