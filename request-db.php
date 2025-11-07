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

function deleteRequest($reqId)
{
    global $db;
    $stmt = $db->query("DELETE FROM requests WHERE reqId=$reqId");
}

?>