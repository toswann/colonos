drop view v_users_items_ownership;
CREATE ALGORITHM=UNDEFINED DEFINER=root@localhost SQL SECURITY DEFINER VIEW v_users_items_ownership AS 
SELECT       
        u.user_id AS 'user_id',
        u.cruser_id AS 'cruser_id',
        r.RoleId AS 'role_id',
        u.email AS 'email',
        u.name AS 'name',
        u.type AS 'type',
        u.state AS 'state',
        i.item_id AS 'item_id',
        i.name AS 'item_name',
        i.state AS 'item_state',
        i.flatname AS 'flatname',
        i.city_id AS 'city_id',
        i.zone_id AS 'zone_id' 
FROM users u 
LEFT JOIN items i ON (u.user_id = i.owner_id) 
LEFT JOIN rbac_userroles r ON (u.user_id = r.UserId) 
