<?php
function selectall() {
    global $db;
    $query = 'SELECT * FROM course';
    try {
        $statement = $db->prepare($query);
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

function select($course_id) {
    global $db;
    $query = 'SELECT * FROM course WHERE course_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('s', $course_id);
        $statement->execute();
        $result = $statement->get_result();
        $result = $result->fetch_assoc();
        $statement->close();
        
        return $result;
    } catch (Exception $ex) {
        exit;
    }  
}

function delete($course_id) {
    global $db;
    $query = 'DELETE FROM course WHERE course_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('s', $course_id);
        $statement->execute();
        $num_rows = $statement->affected_rows;
        $statement->close();

        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}

function insert($course_name, $address, $phone) {
    global $db;
    $query = 'INSERT INTO course (course_name, address, phone) VALUES (?, ?, ?)';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('sss', $course_name, $address, $phone);
        $statement->execute();
        $row_num = $statement->insert_id;
        $statement->close();

        return $row_num;
    } catch (Exception $ex) {
        exit;
    }
}

function update($course_name, $address, $phone, $course_id) {
    global $db;
    $query = 'UPDATE course SET course_name = ?, address = ?, phone = ? WHERE course_id = ?';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('ssss', $course_name, $address, $phone, $course_id);
        $statement->execute();
        $num_rows = $statement->affected_rows;  
        $statement->close();
     
        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}

function gameSelect($course_id, $start_hole, $end_hole) {
    global $db;
    $query = 'SELECT hole_number, hole_par, tee1_dist, tee2_dist, tee3_dist, tee4_dist, tee5_dist, tee6_dist
        FROM Hole
        WHERE course_id = ? AND hole_number BETWEEN ? AND ?;';
    try {
        $statement = $db->prepare($query);
        $statement->bind_param('iii', $course_id, $start_hole, $end_hole);
        $statement->execute();
        $num_rows = $statement->affected_rows;
        $statement->close();
     
        return $num_rows;
    } catch (Exception $ex) {
        exit;
    }
}
