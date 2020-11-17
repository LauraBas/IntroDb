<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Student;


class StudentTest extends TestCase
{

	public function test_return_student_data()
	{
        $student = new Student("Juan");

		$this->assertEquals("Juan", $student->getName());
		$this->assertIsString($student->getId());
		$this->assertIsString($student->getCreatedAt());
	}

	public function test_return_saved_student()
	{
		$student = new Student("Juan");
		$student->save();

		$this->assertEquals("Juan", $student->getName());
		$this->assertIsString($student->getId());
		$this->assertIsString($student->getCreatedAt());
		
	}
	public function test_return_completed_student()
	{
		$student = new Student("Juan");
		$student->completeStudent("1234","12/12/12");

		$this->assertEquals("Juan", $student->getName());
		$this->assertEquals("1234",$student->getId());
		$this->assertEquals("12/12/12",$student->getCreatedAt());
		
	}

	public function test_can_update_student()
	{
		$student = new Student("Juan");
		$student->rename("Pedro");

		$this->assertEquals("Pedro", $student->getName());
	}

}