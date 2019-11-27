<?php
require('../modelpdo/pdo.php');
require('../modelpdo/pdomethods.php');

$firstname = filter_input(INPUT_GET, 'fname');
$lastname = filter_input(INPUT_GET, 'lname');
$email = filter_input(INPUT_GET, 'email');
$userId = filter_input(INPUT_GET, 'userId');

$firstname = (isset($firstname)) ? $firstname : '';
$lastname = (isset($lastname)) ? $lastname : '';
$email = (isset($email)) ? $email : '';
$userId = (isset($userId)) ? $userId : '';

echo "First Name: $firstname <br>";
echo "Last Name: $lastname <br>";
echo "Email: $email<br>";
echo "UserId: $userId<br>";


?>
<!DOCTYPE html>
<html>

<?php
$questions = get_questions($userId);
?>

<table class="table">
    <tr>
        <th scope = "col">Email</th>
        <th scope = "col">Id</th>
        <th scope = "col">Title</th>
        <th scope = "col">Body</th>
        <th scope = "col">Skills</th>
    <tr>
    <?php foreach($questions as $question) : ?>
        <tr scope = "row">
            <td><?php echo $question['owneremail']; ?></td>
            <td><?php echo $question['ownerid']; ?></td>
            <td><?php echo $question['title']; ?></td>
            <td><?php echo $question['body']; ?></td>
            <td><?php echo $question['skills']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>



<a href = "../questionform/questionform.php? user=<?php echo $userId; ?>"><button>Add Question</button></a>



</html>