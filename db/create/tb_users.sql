create table tb_users(
	id_user int auto_increment,
    name varchar(100) not null,
    last_name varchar(100) not null,
    email varchar(200) not null,
    username varchar(50) not null,
    pass varchar(50) not null,
    id_role int not null,
    date_register datetime default now(),
    date_update datetime default null,
    last_activity datetime default now(),
    sessions int default 0,
    index(id_role),
    foreign key(id_role) references tb_roles(id_role),
    primary key(id_user)
) engine = innodb;

SELECT t0.name,t0.last_name,t0.email,t0.username,t0.last_activity,t0.sessions,t0.date_register,t0.date_update,t1.id_role,t1.name
FROM tb_users t0 INNER JOIN tb_roles t1 ON t0.id_role = t1.id_role
WHERE t0.id_user = 1
GROUP BY t0.name
ORDER BY t0.name ASC