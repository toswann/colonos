drop view v_items_users;
CREATE VIEW v_items_users AS 
SELECT       
        i.item_id AS 'item_id',
        i.cruser_id AS 'cruser_id',
        u.user_id AS 'owner_id',
        i.task_id AS 'task_id',
        i.name AS 'name',
        i.averagegrade AS 'averagegrade',
        u.email AS 'email',
        u.name AS 'owner_name',
        i.state AS 'state',
        i.city_id AS 'city_id',
        i.zone_id AS 'zone_id', 
FROM items i 
LEFT JOIN users u ON (u.user_id = i.owner_id) 

