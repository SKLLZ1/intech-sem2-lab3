<?php
$dsn = "mysql:host=127.0.0.1;dbname=university";
$user = "root";
$pass = "";
$db = new PDO($dsn, $user, $pass);

function groups($db): void
{
    $statement = $db->query("SELECT DISTINCT * FROM groups");
    while ($data = $statement->fetch()) {
        echo "<option value='$data[0]'>$data[1]</option>";
    }
}

function teachers($db): void
{
    $statement = $db->query("SELECT DISTINCT * FROM teacher");
    while ($data = $statement->fetch()) {
        echo "<option value='$data[0]'>$data[1]</option>";
    }
}

function auditoriums($db): void
{
    $statement = $db->query("SELECT DISTINCT auditorium FROM lesson");
    while ($data = $statement->fetch()) {
        echo "<option value='$data[0]'>$data[0]</option>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LB3</title>
    <script src="script.js"></script>
</head>

<body>
<form action="" method="post" id="group">
    <p><strong> Groups` lessons </strong>
        <select name='group'>
            <option>Group</option>
            <?php
            groups($db);
            ?>
        </select>
        <input type="submit" value="Submit">
    </p>
</form>

<form action="" method="post" id="teacher">
    <p><strong> Teachers` lessons </strong>
        <select name='teacher'>
            <option>Teacher</option>
            <?php
            teachers($db);
            ?>
        </select>
        <input type="submit" value="Submit">
    </p>

</form>

<form action="" method="post" id="auditorium">
    <p><strong> Lessons by auditoriums </strong>
        <select name='auditorium'>
            <option>Auditoriums</option>
            <?php
            auditoriums($db);
            ?>
        </select>
        <input type="submit" value="Submit">
    </p>
</form>
</body>
<div id="content"></div>
</html>