<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require('../modelpdo/pdo.php');
require('../modelpdo/pdomethods.php');

$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$birthday = filter_input(INPUT_POST, 'birthday');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$firstname = (isset($firstname)) ? $firstname : '';
$lastname = (isset($lastname)) ? $lastname : '';
$birthday = (isset($birthday)) ? $birthday : '';
$email = (isset($email)) ? $email : '';
$password = (isset($password)) ? $password : '';

$query = 'INSERT INTO accountsIS218(email, fname, lname, birthday, password)
          VALUES(:email, :fname, :lname, :birthday, :password)';

$statement = $dbtest->prepare($query);

$statement->bindValue(':email', $email);
$statement->bindValue(':fname', $firstname);
$statement->bindValue(':lname', $lastname);
$statement->bindValue(':birthday', $birthday);
$statement->bindValue(':password', $password);

$statement->execute();

$statement->closeCursor();

if(empty($firstname)){
    print "<br>Error in Firstname Field: you must enter your firstname<br>";
}

if(empty($lastname)){
    print "<br>Error in Lastname Field: you must enter your lastname<br>";
}
if(empty($birthday)){
    print "<br>Error in Firstname Field: you must enter your birthday<br>";
}

if(empty($email)){
    print "<br>Error in Firstname Field: you must enter your email<br>";
}

$j = strpos($email, '@');
if($j == false){print "<br>Error in Email Field: no @ characters found<br>";}


if(empty($password)){
    print "<br>Error in Password Field: you must enter your password<br>";
}

$passlen = strlen($password);
if($passlen < 8) {
    echo "<br>Error is Password Field: invalid password length: ".$password."is not at least 8 characters long<br>";
}


?>

<?php

$firstname = filter_input(INPUT_POST, 'fname');
$lastname = filter_input(INPUT_POST, 'lname');
$birthday = filter_input(INPUT_POST, 'birthday');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

header("Location: ../loginform/displayquestion.php?fname=$firstname&lname=$lastname&birthday=$birthday&email=$email&password=$password");

?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <title> Question Form </title>
    <link rel = "stylesheet" type = "text/css" href = "../css/formcss.css">
</head>

<body>
<main>
    <h1> Question Form Answers </h1>

    <label> First Name: </label>
    <span><?php echo htmlspecialchars($firstname);?></span>
    <br>

    <label> First Name: </label>
    <span><?php echo htmlspecialchars($lastname);?></span>
    <br>

    <label> First Name: </label>
    <span><?php echo htmlspecialchars($birthday);?></span>
    <br>

    <label> First Name: </label>
    <span><?php echo htmlspecialchars($email);?></span>
    <br>

    <label> First Name: </label>
    <span><?php echo htmlspecialchars($password);?></span>
    <br>

</main>
</body>
</html>
