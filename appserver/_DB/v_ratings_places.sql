DROP VIEW v_ratings_places;
CREATE VIEW v_ratings_places AS  
    SELECT r.rating_id, r.item_id, i.owner_id, i.name, i.zone_id, r.email, r.newsletter, r.text, r.date, r.state, r.grade_average, r.grade_pqratio, r.grade_personal, r.grade_services, r.grade_location, r.grade_confort, r.grade_cleanliness
    FROM    ratings r, items i
    WHERE r.item_id = i.item_id
