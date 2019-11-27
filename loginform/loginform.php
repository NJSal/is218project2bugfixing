<?php
error_reporting(E_ALL);
ini_set('display_errors','1');

require('../modelpdo/pdo.php');
require('../modelpdo/pdomethods.php');

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$email = (isset($email)) ? $email : '';
$password = (isset($password)) ? $password : '';

$j = strpos($email, '@');
if($j == false){print "<br> no @ characters found<br>";}
if(empty($email)){print "<br> Error in Email field: you must enter your email<br>";}


$plen = strlen($password);
if($plen < 8) {echo "<br>Error in Password Field: invalid password length: ".$password." is not at least 8 characters long<br>";}
if(empty($password)){print"<br>Error in Password Field: you must enter your password<br>";}


$query = 'SELECT * FROM accountsIS218 WHERE email = :email AND password = :password';

$statement = $dbtest->prepare($query);
$statement->bindValue(':email', $email);
$statement->bindValue(':password', $password);
$statement->execute();
$user= $statement->fetch();
$statement->closeCursor();

$userId= $user['id'];
$firstname = $user['fname'];
$lastname = $user['lname'];
//$email = $user['email'];
$userexists = count($user) > 0;
/*
$fnamevalue = $values['fname'];
$lnamevalue = $values['lname'];
*/
if(count($user)>0){

    header("Location: displayquestion.php?fname=$firstname&lname=$lastname&email=$email&userId=$userId");
}
else{
    header("Location: ../registrationform/registrationform.html");
}
/*

if(count($values) == 0 OR (($email == NULL) AND ($password == NULL))){
    header("Location: ../registrationform/registrationform.html");
}
*/
?>

<!DOCTYPE html>
<html lang = "en">

<label>First Name: </label>
<span><?php echo htmlspecialchars($firstname);?></span>
<br>

<label>Last Name: </label>
<span><?php echo htmlspecialchars($lastname);?></span>
<br>

<label>Email: </label>
<span><?php echo htmlspecialchars($email);?></span>
<br>

<label>Password: </label>
<span><?php echo htmlspecialchars($password);?></span>
<br>

</html>
