<?php
function login($email, $pwd) {
    global $db;
    $query = 'SELECT * FROM user WHERE email = ? AND password = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('ss', $email, $pwd);
        $statement->execute();
        $result = $statement->get_result();
        $res = $result->fetch_assoc();
        $statement->close();
        return $res;
    } catch (Exception $ex) {
        exit;
    }  
}

function signup($fName, $lName, $email, $pwd, $phone){
    global $db;
    $query = 'INSERT INTO user (first_name, last_name, email, password, phone) VALUES (?, ?, ?, ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('sssss', $fName, $lName, $email, $pwd, $phone);
        $statement->execute();
        $statement->close();

        // Get the last user ID that was inserted
        $usr_id = $db->insert_id;
        return $usr_id;
    } catch (Exception $ex) {
        exit;
    }
}

function historySelectAll($user_id) {
    global $db;
    $query = 'SELECT course_name, DATE_FORMAT(DATE(party_etime), "%M %d %Y") AS date_played, TIMEDIFF(party_etime, party_stime) AS tot_time,
        SUM(CASE WHEN hole_number = 1 THEN stroke else 0 END) AS hole_1,
        SUM(CASE WHEN hole_number = 2 THEN stroke else 0 END) AS hole_2,
        SUM(CASE WHEN hole_number = 3 THEN stroke else 0 END) AS hole_3,
        SUM(CASE WHEN hole_number = 4 THEN stroke else 0 END) AS hole_4,
        SUM(CASE WHEN hole_number = 5 THEN stroke else 0 END) AS hole_5,
        SUM(CASE WHEN hole_number = 6 THEN stroke else 0 END) AS hole_6,
        SUM(CASE WHEN hole_number = 7 THEN stroke else 0 END) AS hole_7,
        SUM(CASE WHEN hole_number = 8 THEN stroke else 0 END) AS hole_8,
        SUM(CASE WHEN hole_number = 9 THEN stroke else 0 END) AS hole_9,
        SUM(CASE WHEN hole_number = 10 THEN stroke else 0 END) AS hole_10,
        SUM(CASE WHEN hole_number = 11 THEN stroke else 0 END) AS hole_11,
        SUM(CASE WHEN hole_number = 12 THEN stroke else 0 END) AS hole_12,
        SUM(CASE WHEN hole_number = 13 THEN stroke else 0 END) AS hole_13,
        SUM(CASE WHEN hole_number = 14 THEN stroke else 0 END) AS hole_14,
        SUM(CASE WHEN hole_number = 15 THEN stroke else 0 END) AS hole_15,
        SUM(CASE WHEN hole_number = 16 THEN stroke else 0 END) AS hole_16,
        SUM(CASE WHEN hole_number = 17 THEN stroke else 0 END) AS hole_17,
        SUM(CASE WHEN hole_number = 18 THEN stroke else 0 END) AS hole_18
        from history
        JOIN Score ON Score_score_id = Score.score_id
	JOIN Hole ON Hole_hole_id = Hole.hole_id
	JOIN Party ON Party_party_id = Party.party_id
        JOIN Course ON Course.course_id = Score_Hole_course_id
        WHERE user_id = ?
        GROUP BY course_name, date_played, tot_time 
	ORDER BY party_etime;';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('i', $user_id);
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