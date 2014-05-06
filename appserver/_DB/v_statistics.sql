CREATE VIEW v_statistics AS 
SELECT count(user_id) as users, count(item_id) as items, AVG (averagegrade) as averagegrade, zone_id 
FROM v_users_items_ownership 
WHERE user_id IS NOT NULL OR item_id IS NOT NULL 
GROUP BY zone_id
