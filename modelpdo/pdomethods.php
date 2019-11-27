<?php
function get_questions($userid)
{
    global $dbtest;
    $query = 'SELECT * FROM QUESTIONS WHERE ownerid = :id';

    $statement = $dbtest->prepare($query);
    $statement->bindValue(':id', $userid);
    $statement->execute();
    $accountquestion = $statement->fetchAll();
    $statement->closeCursor();

    return $accountquestion;
}

?>