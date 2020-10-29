<?php
function insert($course_id, $party_id) {
    global $db;
    $query = 'INSERT INTO golf_game (Course_course_id, Party_party_id) VALUES (?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('i', $course_id, $party_id);
        $statement->execute();
        $row_num = $statement->insert_id;
        $statement->close();

        return $row_num;
    } catch (Exception $ex) {
        exit;
    }
}

function select($game_id) {
    global $db;
    $query = 'SELECT * FROM golf_game WHERE game_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('i', $game_id);
        $statement->execute();
        $result = $statement->get_result();
        $res = array();
        while($row = $result->fetch_assoc()){
            array_push($res, $row);
        }
        $statement->close();
        return $res;
    } catch (Exception $ex) {
        exit;
    }
}

function getID(){
    global $db;
    $query = 'SELECT LAST_INSERT_ID();';
    
    try{
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->get_result();
        $res = array();
        while($row = $result->fetch_assoc()){
            array_push($res, $row);
        }
        $statement->close();
        return $result;

    } catch (Exception $ex) {
        exit;
    }
}

function partyInsert($size) {
    global $db;
    $query = 'INSERT INTO party (size, party_stime) VALUES (?, NOW());';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('i', $size);
        $statement->execute();
        $row_num = $statement->insert_id;
        $statement->close();

//        return $row_num;
        
        
        return getID();
    } catch (Exception $ex) {
        exit;
    }
}

function playerInsert($party_id, $user_id, $handicap){
    global $db;
    $query = 'INSERT INTO player (Party_party_id, User_user_id, handicap) VALUES (?, ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('iii', $party_id, $user_id, $handicap);
        $statement->execute();
        $row_num = $statement->insert_id;
        $statement->close();

        return $row_num;
    } catch (Exception $ex) {
        exit;
    }
}
