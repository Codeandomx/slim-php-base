create table Tb_Roles(
	id_role int auto_increment,
    name varchar(50) not null,
    date_register datetime default now(),
    date_update datetime default null,
    primary key(id_role)
) engine = innodb;