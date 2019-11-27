<?php
error_reporting(E_ALL);
ini_set('display_errors','1');

require('../modelpdo/pdo.php');
require('../modelpdo/pdomethods.php');

$name = filter_input(INPUT_POST, 'name');
$about = filter_input(INPUT_POST, 'about');
$skills = filter_input(INPUT_POST, 'skills');
$userId = filter_input(INPUT_POST, 'userId');

$name = (isset($name)) ? $name : '';
$about = (isset($name)) ? $about : '';
$skills= (isset($name)) ? $skills : '';
$userId = (isset($name)) ? $userId : '';

$namelength = strlen($name);
if($namelength < 3){echo "<br>Error in Name Field: Invalid name length: ".$name." is not at least 3 characters long<br>";}
if(empty($name)){print "<br>Error in Name Field: you must enter your name<br>";}

$aboutlength = strlen($about);
if($aboutlength > 500){print "<br>Error in About Field: the number of words entered is > 500<br>";}
if(empty($about)){print "<br>Error in About Field: you left the second field empty<br>";}

$skillset = explode(',',$skills);
$skillselected = count($skillset);
if($skillselected < 2){print "<br> Error in Skilsl Field: please write down at least two sklls<br>";}


$owneridvalue = filter_input(INPUT_POST, '');

$query = 'SELECT ownermail FROM questions WHERE title = :title AND body =:body';
$statement = $dbtest->prepare($query);
$statement->bindValue(':title', $name);
$statement->bindValue(':body', $about);
$statement->execute();
$questions = $statement->fetch();
$email = $questions['owneremail'];

$title = $name;
$body = $about;

$query = 'INSERT INTO questions
          (ownerid, skills, body, title)
          VALUES
          (:ownerid, :skills, :body, :title)';

$statement = $dbtest->prepare($query);
//$staement->bindValue(':ownerid', $email);
//not sure if this is needed here
$statement->bindValue(':ownerid', $userId);
$statement->bindValue(':skills', $skills);
$statement->bindValue(':body', $body);
$statement->bindValue(':title', $title);
$statement->execute();

$statement->closeCursor();

header("Location: ../loginform/displayquestion.php?ownerid=$userId");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Question Form</title>
    <link rel = "stylesheet" type ="text/css" href = "../css/formcss.css">
</head>

<body>
<main>
    <h1>Question Form</h1>

    <label>Question 1. Name:</label>
    <span><?php echo htmlspecialchars($name);?></span>
    <br>

    <label>Question 2. About You:</label>
    <span><?php echo htmlspecialchars($about);?></span>
    <br>

    <label>Skills (comma separated):</label>
    <span><?php echo htmlspecialchars($skills);?></span>
    <br>

    <!---<input type="hidden" name="userId" value=<php echo $userId; ?>>
    --->

</main>
</body>


</html>
