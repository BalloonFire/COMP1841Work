<?php

## REUSABLE QUERY FUNCTION ##

function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

## QUESTIONS FUNCTIONS ##

function getQuestion($pdo, $id) {
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT * FROM questions WHERE id = :id', $parameters);
    return $query->fetch();
}

function getQuestionContent($pdo, $id) {
    $sql = 'SELECT questions.*, users.Username AS QUsername, users.Email AS QEmail
            FROM questions
            INNER JOIN users ON questions.UserID = users.id
            WHERE questions.id = :id';

    $parameters = [':id' => $id];
    $query = query($pdo, $sql, $parameters);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function totalQuestions($pdo) {
    $query = query($pdo, 'SELECT COUNT(*) FROM questions');
    $row = $query->fetch();
    return $row[0];
}

function allQuestions($pdo, $offset, $questionsPerPage) {
    // Convert offset and questionsPerPage to integers to ensure they are treated as such
    $offset = (int)$offset;
    $questionsPerPage = (int)$questionsPerPage;

    $query = "SELECT questions.id, QTitle, QContent, `image`, questions.UserID, Username, Email, ModuleName, QDate
              FROM questions
              INNER JOIN users ON questions.userid = users.id
              INNER JOIN modules ON questions.moduleid = modules.id
              LEFT JOIN answers ON questions.id = answers.QuestionID
              GROUP BY questions.id, QTitle, QContent, image, Username, Email, ModuleName
              LIMIT $offset, $questionsPerPage";

    $questions = query($pdo, $query);
    return $questions->fetchAll();
}

function insertQuestions($pdo, $QTitle, $QContent, $fileToUpload, $UserID, $ModuleID) {
    $query = 'INSERT INTO questions (QTitle, QContent, `image`, UserID, ModuleID, QDate)
              VALUES (:QTitle, :QContent, :fileToUpload, :UserID, :ModuleID, NOW())';

    $parameters = [
        ':QTitle' => $QTitle,
        ':QContent' => $QContent,
        ':fileToUpload' => $fileToUpload,
        ':UserID' => $UserID,
        ':ModuleID' => $ModuleID
    ];

    return query($pdo, $query, $parameters);
}

function updateQuestions($pdo, $questionId, $QContent, $QTitle, $fileToUpload, $ModuleID) {
    $query = 'UPDATE questions SET QContent = :QContent, QTitle = :QTitle, `image` = :fileToUpload, ModuleID = :ModuleID WHERE id = :id';
    $parameters = [':QContent' => $QContent, ':QTitle' => $QTitle, ':fileToUpload' => $fileToUpload, ':ModuleID' => $ModuleID, ':id' => $questionId];
    return query($pdo, $query, $parameters);
}

function deleteQuestions($pdo, $id) {
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM questions WHERE id = :id', $parameters);
}

## ANSWERS FUNCTIONS ##

function allAnswers($pdo, $questionId) {
    $sql = 'SELECT answers.id, AContent, ADate, users.Username AS AUsername, users.Email AS AEmail, QTitle, QContent, users.Username, users.Email, ModuleName
            FROM answers
            INNER JOIN questions ON answers.questionid = questions.id
            INNER JOIN users ON answers.userid = users.id
            INNER JOIN modules ON questions.moduleid = modules.id
            WHERE questions.id = :questionId';

    $parameters = [':questionId' => $questionId];
    $answers = query($pdo, $sql, $parameters);

    return $answers->fetchAll(PDO::FETCH_ASSOC);
}

function insertAnswers($pdo, $AContent, $UserID, $QuestionID) {
    $sql = 'INSERT INTO Answers (AContent, UserID, QuestionID, ADate) 
            VALUES (:AContent, :UserID, :QuestionID, NOW())';

    $parameters = [
        ':AContent' => $AContent,
        ':UserID' => $UserID,
        ':QuestionID' => $QuestionID
    ];

    return query($pdo, $sql, $parameters);
}

function getRepliesCount($pdo, $questionId) {
    $sql = 'SELECT COUNT(*) FROM answers WHERE QuestionID = :questionId';
    $parameters = [':questionId' => $questionId];
    $query = query($pdo, $sql, $parameters);
    $row = $query->fetch();
    return $row[0]; // Return the count of replies
}

## USERS FUNCTIONS ##

function allUsers($pdo) {
    $query = query($pdo, 'SELECT COUNT(*) FROM users');
    $row = $query->fetch();
    return $row[0];
}

function getUserDetails($pdo, $userId) {
    $query = 'SELECT id, Username, Email, Password, admin FROM users WHERE id = :userId';
    $parameters = [':userId' => $userId];
    $result = query($pdo, $query, $parameters);

    return $result->fetch(PDO::FETCH_ASSOC);
}

function updateProfile($pdo, $userId, $newUsername, $newEmail, $newPassword) {
    $query = 'UPDATE users SET Username = :newUsername, Email = :newEmail, Password = :newPassword WHERE id = :userId';
    $parameters = [
        ':newUsername' => $newUsername,
        ':newEmail' => $newEmail,
        ':newPassword' => $newPassword,
        ':userId' => $userId,
    ];

    return query($pdo, $query, $parameters);
}

function deleteUser($pdo, $userId) {
    $query = 'DELETE FROM users WHERE id = :id';
    $parameters = [':id' => $userId];

    return query($pdo, $query, $parameters);
}

function getUsersInfo($pdo) {
    $query = query($pdo, 'SELECT * FROM users');
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function assignAdminRole($pdo, $userId) {
    $query = 'UPDATE users SET admin = "Y" WHERE id = :userId';
    $parameters = [':userId' => $userId];

    return query($pdo, $query, $parameters);
}

function revokeAdminRole($pdo, $userId) {
    $query = 'UPDATE users SET admin = "N" WHERE id = :userId';
    $parameters = [':userId' => $userId];

    return query($pdo, $query, $parameters);
}

## MODULES FUNCTIONS ##

function allModules($pdo) {
    $modules = query($pdo, 'SELECT * FROM modules');
    return $modules->fetchAll();
}

function addModule($pdo, $moduleName) {
    $sql = 'INSERT INTO modules (ModuleName) VALUES (:module_name)';
    $parameters = [':module_name' => $moduleName];

    return query($pdo, $sql, $parameters);
}

function editModule($pdo, $moduleId, $moduleName) {
    $sql = 'UPDATE modules SET ModuleName = :module_name WHERE id = :module_id';
    $parameters = [':module_name' => $moduleName, ':module_id' => $moduleId];

    return query($pdo, $sql, $parameters);
}

function deleteModule($pdo, $moduleId) {
    $sql = 'DELETE FROM modules WHERE id = :module_id';
    $parameters = [':module_id' => $moduleId];

    return query($pdo, $sql, $parameters);
}

function getModuleById($pdo, $moduleId) {
    $query = 'SELECT * FROM modules WHERE id = :module_id';
    $parameters = [':module_id' => $moduleId];
    $statement = query($pdo, $query, $parameters);

    return $statement->fetch(PDO::FETCH_ASSOC);
}

## ADMIN FUNCTIONS ##

function insertUserMessage($pdo, $MContent, $UserID) {
    $query = 'INSERT INTO usermessages (MContent, UserID, MDate) VALUES (:MContent, :UserID, NOW())';

    $parameters = [':MContent' => $MContent, ':UserID' => $UserID];

    return query($pdo, $query, $parameters);
}

function getAllAdminMessages($pdo) {
    $query = 'SELECT usermessages.MessageID, usermessages.MContent, usermessages.MDate, users.id AS UserID, users.Username
              FROM usermessages
              JOIN users ON usermessages.UserID = users.id';

    $adminMessages = query($pdo, $query);
    return $adminMessages->fetchAll(PDO::FETCH_ASSOC);
}

## FILTER QUESTIONS BY MODULE ##
function filterQuestionsByModule($pdo, $moduleID, $orderBy, $offset, $questionsPerPage) {
    // Convert offset and questionsPerPage to integers to ensure they are treated as such
    $offset = (int)$offset;
    $questionsPerPage = (int)$questionsPerPage;

    // Determine the ORDER BY clause based on the selected order
    $orderByClause = '';
    if ($orderBy == 'newest') {
        $orderByClause = 'QDate DESC';
    } elseif ($orderBy == 'oldest') {
        $orderByClause = 'QDate ASC';
    }

    $sql = "SELECT questions.id, QTitle, QContent, `image`, questions.UserID, Username, Email, ModuleName, QDate
            FROM questions 
            INNER JOIN modules ON questions.ModuleID = modules.id 
            INNER JOIN users ON questions.UserID = users.id 
            WHERE ModuleID = :moduleID ";
            
    if ($orderByClause) {
        $sql .= "ORDER BY $orderByClause ";
    }
    
    $sql .= "LIMIT $offset, $questionsPerPage";

    $parameters = [':moduleID' => $moduleID];
    return query($pdo, $sql, $parameters)->fetchAll(PDO::FETCH_ASSOC);
}

## SEARCH QUESTIONS BY KEYWORDS ##
function searchQuestionsByKeywords($pdo, $keywords, $orderBy, $offset, $questionsPerPage) {
    // Convert offset and questionsPerPage to integers to ensure they are treated as such
    $offset = (int)$offset;
    $questionsPerPage = (int)$questionsPerPage;

    // Determine the ORDER BY clause based on the selected order
    $orderByClause = '';
    if ($orderBy == 'newest') {
        $orderByClause = 'QDate DESC';
    } elseif ($orderBy == 'oldest') {
        $orderByClause = 'QDate ASC';
    }

    $sql = "SELECT questions.id, QTitle, QContent, `image`, questions.UserID, Username, Email, ModuleName, QDate
            FROM questions 
            INNER JOIN modules ON questions.ModuleID = modules.id 
            INNER JOIN users ON questions.UserID = users.id 
            WHERE QTitle LIKE ? OR QContent LIKE ? ";
            
    if ($orderByClause) {
        $sql .= "ORDER BY $orderByClause ";
    }
    
    $sql .= "LIMIT $offset, $questionsPerPage";

    $parameters = ["%$keywords%", "%$keywords%"];
    return query($pdo, $sql, $parameters)->fetchAll(PDO::FETCH_ASSOC);
}

## SORT QUESTIONS BY TIMESTAMP ##
function sortQuestionsByTimestamp($pdo, $orderBy, $offset, $questionsPerPage) {
    // Convert offset and questionsPerPage to integers to ensure they are treated as such
    $offset = (int)$offset;
    $questionsPerPage = (int)$questionsPerPage;

    // Determine the ORDER BY clause based on the selected order
    $orderByClause = '';
    if ($orderBy == 'newest') {
        $orderByClause = 'QDate DESC';
    } elseif ($orderBy == 'oldest') {
        $orderByClause = 'QDate ASC';
    }

    $sql = "SELECT questions.id, QTitle, QContent, `image`, questions.UserID, Username, Email, ModuleName, QDate
            FROM questions 
            INNER JOIN modules ON questions.ModuleID = modules.id 
            INNER JOIN users ON questions.UserID = users.id ";
            
    if ($orderByClause) {
        $sql .= "ORDER BY $orderByClause ";
    }
    
    $sql .= "LIMIT $offset, $questionsPerPage";

    return query($pdo, $sql)->fetchAll(PDO::FETCH_ASSOC);
}
?>
