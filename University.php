<?php

class University
{
    private PDO $db;

    public function __construct()
    {
        $dsn = "mysql:host=127.0.0.1;dbname=university";
        $user = "root";
        $pass = "";
        $this->db = new PDO($dsn, $user, $pass);
    }

    public function tableByGroup($group): void
    {
        $statement = $this->db->prepare("SELECT week_day, lesson_number, auditorium, disciple, type 
    FROM lesson INNER JOIN lesson_groups ON ID_Lesson = FID_Lesson2 
    WHERE FID_Groups = ?");
        $statement->execute([$group]);
        echo "<table>";
        echo " <tr>
     <th> Week Day  </th>
     <th> Lesson Number </th>
     <th> Auditorium </th>
     <th> Disciple </th>
     <th> Type </th>
    </tr> ";
        while ($data = $statement->fetch()) {
            echo " <tr>
         <td> {$data['week_day']}  </td>
         <td> {$data['lesson_number']} </td>
         <td> {$data['auditorium']} </td>
         <td> {$data['disciple']} </td>
         <td> {$data['type']} </td>
        </tr> ";
        }
        echo "</table>";
    }

    public function tableByTeacher($teacher): void
    {
        header('Content-Type: application/json');
        header('Cache-Control: no-cache, must-revalidate');
        $statement = $this->db->prepare("SELECT week_day, lesson_number, auditorium, disciple, type 
    FROM lesson INNER JOIN lesson_teacher ON ID_Lesson = FID_Lesson1
    WHERE FID_Teacher = ?");
        $statement->execute([$teacher]);
        $txt = "<table>";
        $txt .= " <tr>
     <th> Week Day  </th>
     <th> Lesson Number </th>
     <th> Auditorium </th>
     <th> Disciple </th>
     <th> Type </th>
    </tr> ";
        while ($data = $statement->fetch()) {
            $txt .= " <tr>
         <td> {$data['week_day']}  </td>
         <td> {$data['lesson_number']} </td>
         <td> {$data['auditorium']} </td>
         <td> {$data['disciple']} </td>
         <td> {$data['type']} </td>
        </tr> ";
        }
        $txt .= "</table>";
        echo json_encode($txt);
    }

    public function tableByAuditorium($auditorium): void
    {
        header('Content-Type: text/xml');
        header('Cache-Control: no-cache, must-revalidate');
        $statement = $this->db->prepare("SELECT week_day, lesson_number, auditorium, disciple, type 
    FROM lesson
    WHERE auditorium = ?");
        $statement->execute([$auditorium]);
        $txt = "<?xml version='1.0' encoding='utf-8'?>";
        $txt .= "<root>";
        while ($data = $statement->fetch()) {
            $txt .= " <raw>
         <day> {$data['week_day']}  </day>
         <number> {$data['lesson_number']} </number>
         <auditorium> {$data['auditorium']} </auditorium>
         <disciple> {$data['disciple']} </disciple>
         <type> {$data['type']} </type>
        </raw> ";
        }
        $txt .= "</root>";
        echo $txt;
    }
}

$university = new University();
if(isset($_REQUEST["group"])) {
    $university->tableByGroup($_REQUEST["group"]);
} else if(isset($_REQUEST["teacher"])) {
    $university->tableByTeacher($_REQUEST["teacher"]);
} else if(isset($_REQUEST["auditorium"])){
    $university->tableByAuditorium($_REQUEST["auditorium"]);
}