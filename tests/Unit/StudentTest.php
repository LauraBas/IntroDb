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
}