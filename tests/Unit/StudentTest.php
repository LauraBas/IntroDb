<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Student;


class StudentTest extends TestCase
{

	public function test_return_student_data()
	{
        $student = new Student("Juan", "16/11/20");

		$this->assertEquals("Juan", $student->getName());
		$this->assertIsString($student->getId());
		$this->assertEquals("16/11/20", $student->getCreatedAt());
	}
}