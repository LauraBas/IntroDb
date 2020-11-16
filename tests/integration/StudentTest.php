<?php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use App\Models\Student;
use App\Database;


class StudentTest extends TestCase
{
    private $db;
    private function initDB() :void
    {
        $db = new Database();
        $db->mysql->query("DELETE FROM `students`");
        $db->mysql->query("ALTER TABLE`students` AUTO_INCREMENT = 1");
        $db->mysql->query("ALTER TABLE`students` AUTO_INCREMENT = 1");
        $this->db = $db;

    }

    public function setUp() :void
    {
        $this->initDB();
    }
    
    public function test_return_student_list()
    {
        $this->db->mysql->query("INSERT INTO `students` (`name`) VALUES ('Andres')");
        $this->db->mysql->query("INSERT INTO `students` (`name`) VALUES ('Moni')");

        $studentList = Student::all();

        $this->assertEquals('Andres', $studentList[0]->getName());
        $this->assertEquals(1, $studentList[0]->getId());
        $this->assertIsString($studentList[0]->getCreatedAt());
        $this->assertEquals('Moni', $studentList[1]->getName());
        $this->assertEquals(2, $studentList[1]->getId());
        $this->assertIsString($studentList[1]->getCreatedAt());

    }

    public function test_return_update_student()
    {
        $this->setUp();
        
        $this->db->mysql->query("INSERT INTO `students` (`name`) VALUES ('Andres')");
        $this->db->mysql->query("UPDATE `students` SET `name` =  'Juan' WHERE `id` = 1");

        $studentList = Student::all();
        $this->assertEquals('Juan', $studentList[0]->getName());
    }

    public function test_return_archives_students()
    {
        $this->setUp();
        
        $this->db->mysql->query("INSERT INTO `students` (`name`) VALUES ('Andres')");
        $this->db->mysql->query("INSERT INTO `students` (`name`) VALUES ('Moni')");
        $this->db->mysql->query("UPDATE `students` SET `done` = true WHERE `id` = 1");

        $studentDoneList = Student::allStudentDone();
        $studentList = Student::all();
        $this->assertEquals('Andres', $studentDoneList[0]->getName());
        $this->assertEquals('Moni', $studentList[0]->getName());
    }
}
