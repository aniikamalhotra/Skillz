<?php

include 'connect-db.php';

function addRequests($reqDate, $roomNumber, $reqBy, $repairDesc, $reqPriority)
{
    global $db;
    $sql = "INSERT INTO requests (reqDate, roomNumber, reqBy, repairDesc, reqPriority) VALUES ('$reqDate', '$roomNumber', '$reqBy', '$repairDesc', '$reqPriority')";
    $db->query($sql);
}

function getAllRequests()
{
    global $db;
    $stmt = $db->query("SELECT * FROM requests");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getRequestById($id)  
{
    global $db;
    $stmt = $db->query("SELECT * FROM requests WHERE reqId=$id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateRequest($reqId, $reqDate, $roomNumber, $reqBy, $repairDesc, $reqPriority)
{
    global $db;
    $stmt = $db->query("UPDATE requests SET reqDate=$reqDate, roomNumber=$roomNumber, reqBy=$reqBy, repairDesc=$repairDesc, reqPriority=$reqPriority WHERE reqId=$reqId");
}


function deleteUser($userId)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
}

function deleteVote()
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Vote WHERE is_down = FALSE AND is_up = FALSE");
    $stmt->execute();
}

function deleteFavorite($userId, $articleId)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Favorite WHERE user_id = :user_id AND article_id = :article_id");
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':article_id', $articleId);
    $stmt->execute();
}

function deleteReview($userId, $articleId)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Review WHERE user_id = :user_id AND article_id = :article_id");
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':article_id', $articleId);
    $stmt->execute();
}

function deleteArticle($articleId)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Article WHERE article_id = :article_id");
    $stmt->bindParam(':article_id', $articleId);
    $stmt->execute();
}

function deleteFriend($user1Id, $user2Id)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Friend WHERE user_1_id = :user_1_id AND user_2_id = :user_2_id");
    $stmt->bindParam(':user_1_id', $user1Id);
    $stmt->bindParam(':user_2_id', $user2Id);
    $stmt->execute();
}

function deleteRequest($senderId, $receiverId)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM Request WHERE sender_id = :sender_id AND receiver_id = :receiver_id");
    $stmt->bindParam(':sender_id', $senderId);
    $stmt->bindParam(':receiver_id', $receiverId);
    $stmt->execute();
}

?>