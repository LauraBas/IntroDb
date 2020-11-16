<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Student;


class StudentTest extends TestCase
{

	public function test_return_student_name()
	{
        $student = new Student("Juan");

		$this->assertEquals("Juan", $student->getName());
	}
	public function test_return_student_data()
	{
        $student = new Student("Juan", 1, "16/11/20");

		$this->assertEquals("Juan", $student->getName());
		$this->assertEquals(1, $student->getId());
		$this->assertEquals("16/11/20", $student->getCreatedAt());
	}
}