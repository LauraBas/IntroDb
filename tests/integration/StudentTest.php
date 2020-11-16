<?php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use App\Models\Student;


class StudentTest extends TestCase
{
    private $db;
    private function initDB()
    {
        $db = new Database();
        $db->mysql->query("DELETE * FROM 'students'");
        $db->mysql->query("ALTER 'students' AUTO_INCREMENT = 1");
        $this->db = $db;

    }
}
