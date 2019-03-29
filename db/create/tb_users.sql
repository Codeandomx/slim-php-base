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