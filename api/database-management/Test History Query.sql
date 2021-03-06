	SELECT course_name, DATE_FORMAT(DATE(party_etime), "%M %d %Y") AS date_played, TIMEDIFF(party_etime, party_stime) AS tot_time,
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
    from score
	JOIN Score ON Score_score_id = Score.score_id
	JOIN Hole ON Hole_hole_id = Hole.hole_id
	JOIN Party ON Party_party_id = Party.party_id
    JOIN Course ON Course.course_id = Score_Hole_course_id
    WHERE user_id = 2
    GROUP BY course_name, date_played, tot_time 
	ORDER BY party_etime;
    

select user_id, Golf_Game_game_id, hole_number, stroke, course_name, DATE_FORMAT(DATE(party_etime), "%M %d %Y"), TIMEDIFF(party_etime, party_stime) AS tot_time  
from history
JOIN Score ON Score_score_id = Score.score_id
JOIN Hole ON Hole_hole_id = Hole.hole_id
JOIN Party ON Party_party_id = Party.party_id
JOIN Course ON Course.course_id = Score_Hole_Course_id
where user_id = 1
order by party_etime, hole_number;


SELECT hole_number, hole_par, tee1_dist, tee2_dist, tee3_dist, tee4_dist, tee5_dist, tee6_dist
FROM Hole
WHERE course_id = 2 AND tee1_dist <> 0 OR tee6_dist <> 0;

select * from hole where tee1_dist <> 0 or tee2_dist <> 0;

SELECT * FROM hole where Course_course_id = 1 AND hole_number between 1 AND 9;

SELECT hole_number, hole_par, avg_pop,
SUM(CASE WHEN tee_name = "tee1" THEN distance_to_pin else 0 END) as tee_1,
SUM(CASE WHEN tee_name = "tee2" THEN distance_to_pin else 0 END) as tee_2,
SUM(CASE WHEN tee_name = "tee3" THEN distance_to_pin else 0 END) as tee_3
FROM hole join tee on hole_id = Hole_hole_id
where Course_course_id = 1 AND hole_number BETWEEN 1 AND 9
group by hole_id;

SELECT course_name, DATE_FORMAT(party.date, "%M %d %Y") as date_played, TIMEDIFF(end_time, start_time) as tot_time,
SUM(CASE WHEN tee_name = "tee1" THEN distance_to_pin else 0 END) as tee_1,
SUM(CASE WHEN tee_name = "tee2" THEN distance_to_pin else 0 END) as tee_2,
SUM(CASE WHEN tee_name = "tee3" THEN distance_to_pin else 0 END) as tee_3,
hole_number, hole_par, stroke, avg_pop
FROM hole
JOIN tee ON hole_id = tee.Hole_hole_id
JOIN score ON hole_id = score.Hole_hole_id
JOIN player ON player_id = score.Player_player_id
JOIN party ON party_id = player.Party_party_id
JOIN course ON party.Course_course_id = course_id
WHERE player.User_user_id = 2
group by hole_id, date_played, start_time
ORDER BY hole_number, date_played, end_time;

SELECT party_id, course_name, DATE_FORMAT(party.date, "%M %d %Y") as date_played, TIMEDIFF(end_time, start_time) as tot_time,
SUM(CASE WHEN hole_number < "10" THEN stroke ELSE 0 END) as front_nine,
SUM(CASE WHEN hole_number >= "10" THEN stroke ELSE 0 END) as back_nine,
SUM(stroke) as total_score
FROM party
JOIN player ON party_id = Party_party_id
JOIN course ON Course_course_id = course_id
JOIN score ON player_id = score.Player_player_id
JOIN hole ON hole.hole_id = score.Hole_hole_id
WHERE player.User_user_id = 2
GROUP BY player.User_user_id
ORDER BY date_played, end_time;

SELECT SUM(CASE WHEN tee_name = "tee1" THEN distance_to_pin else 0 END) as tee_1,
SUM(CASE WHEN tee_name = "tee2" THEN distance_to_pin else 0 END) as tee_2,
SUM(CASE WHEN tee_name = "tee3" THEN distance_to_pin else 0 END) as tee_3,
hole_number, hole_par, stroke, avg_pop
FROM hole
JOIN tee ON hole_id = tee.Hole_hole_id
JOIN score ON hole_id = score.Hole_hole_id
JOIN player ON player_id = score.Player_player_id
JOIN party ON party_id = player.Party_party_id
WHERE player.User_user_id = 2
group by hole_id, party.date, start_time
ORDER BY hole_number, party.date, end_time;

select distinct(tee_name) from tee
join hole on hole_id = Hole_hole_id
where Course_course_id = 1;


select *
from user
join employee
on user_id = User_user_id;

SELECT DISTINCT(tee_name)
FROM tee
JOIN hole ON hole_id = Hole_hole_id
JOIN course on course_id = Course_course_id
WHERE course_id = 1;

set @g = "polygon((1 1, 3 3, 3 5, 4 5, 1 1))";

UPDATE `mydb`.`hole`
 SET perimeter = PolygonFromText("polygon((1 1, 3 3, 3 5, 1 1))")
 WHERE hole_id = 1;

select perimeter from hole
where hole_id = 1;

