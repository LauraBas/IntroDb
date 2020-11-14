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
}