insert into sage_address_type (description) values ('Privat Adresse');
insert into sage_address_type (description) values ('Gesch�ftliche Adresse');

insert into sage_user (loginname,password,firstname,surname) values ('kf0fhomer','','Homer','Simpson');
insert into sage_user (loginname,password,firstname,surname) values ('kf0flisa','','Lisa','Simpson');
insert into sage_user (loginname,password,firstname,surname) values ('kf0fmaggie','','Maggie','Simpson');
insert into sage_user (loginname,password,description,firstname,surname,user_id_parent) values ('kf0fbart','','Hasst Homer und Schule','Bart','Simpson',2);

insert into sage_acl (user_id,path_id,read_path,read_file,rename_path) values (1,1,'1','0','1');
insert into sage_acl (user_id,path_id,read_path,read_file,rename_path) values (1,2,'0','1','1');
insert into sage_acl (user_id,path_id,read_path,read_file,rename_path) values (1,3,'1','1','1');
insert into sage_acl (user_id,path_id,read_path,read_file,rename_path) values (2,1,'0','0','1');
insert into sage_acl (user_id,path_id,read_path,read_file,rename_path) values (3,1,'0','1','1');
insert into sage_acl (user_id,path_id,read_path,read_file,rename_path) values (3,3,'1','0','1');

insert into sage_path (path_id,loginname,pathname,description,insert_at, path_id_parent) values (1,'kf0fhomer','/','root','4.4.2002', NULL);
insert into sage_path (path_id,loginname,pathname,description,insert_at, path_id_parent) values (2,'kf0fhomer','/KF0F','Ordner der Klasse KF0F','4.4.2002', 1);
insert into sage_path (path_id,loginname,pathname,description,insert_at, path_id_parent) values (3,'kf0fbart','/KF04','Ordner der Klasse KF04','14.12.2001', 1);
insert into sage_path (path_id,loginname,pathname,description,insert_at, path_id_parent) values (4,'kf0fhomer','/AUSTAUSCH','Austauschordner fuer alle ','1.1.1999', 1);

insert into sage_user_calendar_map (user_id,calendar_id) values (1,1);
insert into sage_user_calendar_map (user_id,calendar_id) values (1,3);
insert into sage_user_calendar_map (user_id,calendar_id) values (2,1);
insert into sage_user_calendar_map (user_id,calendar_id) values (2,2);
insert into sage_user_calendar_map (user_id,calendar_id) values (3,1);
insert into sage_user_calendar_map (user_id,calendar_id) values (3,3);

insert into sage_calendar (initiator,date,begin,duration,description,place) values (1,'3.12.2002','15:30','30','Mr. Burnes B�ro','Kantine');
insert into sage_calendar (initiator,date,begin,duration,description,place) values (4,'4.12.2002','17:30','120','Kwicki Markt','Kantine');
insert into sage_calendar (initiator,date,begin,duration,description,place) values (3,'7.12.2002','17:30','120','Springfield Bibliothek','Kantine');

insert into sage_addrbook (user_id,user_profil_id) values (1,3);
insert into sage_addrbook (user_id,surname,firstname,e_mail) values (1,'Hans','Maulwurf','hans.maulwurf@springfield.com');
insert into sage_addrbook (user_id,surname,firstname,e_mail) values (2,'Homer','Simpson','homer.simpson@@springfield.com');
insert into sage_addrbook (user_id,surname,firstname,e_mail) values (3,'Hans','Maulwurf','hans.maulwurf@@springfield.com');

insert into sage_address (user_id,address_type_id,street,house_nr,city,zip_code,e_mail) values (2,1,'Die gleiche wie Homer',3,'Springfield','51134','lisa@homers-house.com');
insert into sage_address (user_id,address_type_id,name,house_nr,city,zip_code,e_mail) values (3,2,'Kwicki Markt',3,'Springfield','51134','abu@kwicki-markt.com');
insert into sage_address (user_id,address_type_id,street,house_nr,city,zip_code,e_mail) values (2,1,'Schule von Springfield',5,'Springfield','52134','schule@springfield.com');
insert into sage_address (user_id,address_type_id,name,house_nr,city,zip_code,e_mail) values (4,1,'sagt er nicht','','Springfield','51134','bart@homers-house.com');

insert into sage_mailing_list (e_mail) values ('homer@springfield.com');
insert into sage_mailing_list (e_mail) values ('lisa@springfield.com');
insert into sage_mailing_list (e_mail) values ('bart@springfield.com');
insert into sage_mailing_list (e_mail) values ('mr.burnes@springfield.com');
insert into sage_mailing_list (e_mail) values ('knechtrubrecht@springfield.com');

insert into sage_mail_user_map (user_id,mailing_list_id) values (1,1);
insert into sage_mail_user_map (user_id,mailing_list_id) values (1,2);
insert into sage_mail_user_map (user_id,mailing_list_id) values (1,3);
insert into sage_mail_user_map (user_id,mailing_list_id) values (1,4);
insert into sage_mail_user_map (user_id,mailing_list_id) values (1,5);
insert into sage_mail_user_map (user_id,mailing_list_id) values (2,2);
insert into sage_mail_user_map (user_id,mailing_list_id) values (2,3);
insert into sage_mail_user_map (user_id,mailing_list_id) values (3,1);
insert into sage_mail_user_map (user_id,mailing_list_id) values (4,5);