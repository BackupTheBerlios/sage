insert into sage_address_type (description) values ('Privat Adresse');
insert into sage_address_type (description) values ('Geschäftliche Adresse');

insert into sage_user (user_id, loginname,password,firstname,surname, description,user_id_parent) values (1, '@root','','admin','group', '@root', NULL);
insert into sage_user (user_id, loginname,password,firstname,surname, description,user_id_parent) values (2, 'kf0fhomer','$1$nXrb36T2$kOXNi6itV4p8EpISmiFfB0','Homer','Simpson', 'Superuser...juhu!', 1);
insert into sage_user (user_id, loginname,password,firstname,surname, description,user_id_parent) values (3, '@kf0f','','kf0f','group', '@kf0f', NULL);
insert into sage_user (user_id, loginname,password,firstname,surname, description,user_id_parent) values (4, 'kf0flisa','','Lisa','Simpson', '', 3);
insert into sage_user (user_id, loginname,password,firstname,surname, description,user_id_parent) values (5, 'kf0fmaggie','','Maggie','Simpson', '', 3);
insert into sage_user (user_id, loginname,password,firstname,surname, description,user_id_parent) values (6, 'kf0fbart','Hasst Homer und Schule','Bart','Simpson','',3);

insert into sage_acl (user_id, path_id, delete_path, write_path, read_path, rename_path, read_file, write_file, delete_file, rename_file) values(1, 1, '1', '1', '1', '1', '1', '1', '1', '1');
insert into sage_acl (user_id, path_id, delete_path, write_path, read_path, rename_path, read_file, write_file, delete_file, rename_file) values(1, 2, '1', '1', '1', '1', '1', '1', '1', '1');
insert into sage_acl (user_id, path_id, delete_path, write_path, read_path, rename_path, read_file, write_file, delete_file, rename_file) values(1, 3, '1', '1', '1', '1', '1', '1', '1', '1');
insert into sage_acl (user_id, path_id, delete_path, write_path, read_path, rename_path, read_file, write_file, delete_file, rename_file) values(1, 4, '1', '1', '1', '1', '1', '1', '1', '1');
insert into sage_acl (user_id, path_id, delete_path, write_path, read_path, rename_path, read_file, write_file, delete_file, rename_file) values(1, 5, '1', '1', '1', '1', '1', '1', '1', '1');
insert into sage_acl (user_id, path_id, delete_path, write_path, read_path, rename_path, read_file, write_file, delete_file, rename_file) values(1, 6, '1', '1', '1', '1', '1', '1', '1', '1');
insert into sage_acl (user_id, path_id, delete_path, write_path, read_path, rename_path, read_file, write_file, delete_file, rename_file) values(1, 7, '1', '1', '1', '1', '1', '1', '1', '1');
insert into sage_acl (user_id, path_id, delete_path, write_path, read_path, rename_path, read_file, write_file, delete_file, rename_file) values(1, 8, '1', '1', '1', '1', '1', '1', '1', '1');
insert into sage_acl (user_id, path_id, delete_path, write_path, read_path, rename_path, read_file, write_file, delete_file, rename_file) values(1, 9, '1', '1', '1', '1', '1', '1', '1', '1');
insert into sage_acl (user_id, path_id, delete_path, write_path, read_path, rename_path, read_file, write_file, delete_file, rename_file) values(3, 1, '0', '0', '1', '0', '0', '0', '0', '0');
insert into sage_acl (user_id, path_id, delete_path, write_path, read_path, rename_path, read_file, write_file, delete_file, rename_file) values(3, 2, '0', '1', '1', '0', '1', '1', '1', '1');
insert into sage_acl (user_id, path_id, delete_path, write_path, read_path, rename_path, read_file, write_file, delete_file, rename_file) values(3, 3, '0', '0', '1', '0', '1', '1', '1', '1');
insert into sage_acl (user_id, path_id, delete_path, write_path, read_path, rename_path, read_file, write_file, delete_file, rename_file) values(3, 4, '0', '1', '1', '0', '1', '1', '1', '1');

insert into sage_path (path_id,loginname,pathname,description,insert_at, path_id_parent) values (1,'kf0fhomer','/','root','4.4.2002', NULL);
insert into sage_path (path_id,loginname,pathname,description,insert_at, path_id_parent) values (2,'kf0fhomer','/kf0f','Ordner der Klasse KF0F','4.4.2002', 1);
insert into sage_path (path_id,loginname,pathname,description,insert_at, path_id_parent) values (3,'kf0fbart','/kf04','Ordner der Klasse KF04','14.12.2001', 1);
insert into sage_path (path_id,loginname,pathname,description,insert_at, path_id_parent) values (4,'kf0fhomer','/austausch','Austauschordner fuer alle ','1.1.1999', 1);
insert into sage_path (path_id,loginname,pathname,description,insert_at, path_id_parent) values (5,'nobody','BROWSER','Der Dateibrowser','1.1.1999', NULL);
insert into sage_patfh (path_id,loginname,pathname,description,insert_at, path_id_parent) values (6,'nobody','MAIL','Das Mailsystem','1.1.1999', NULL);
insert into sage_path (path_id,loginname,pathname,description,insert_at, path_id_parent) values (7,'nobody','CALENDAR','Der Kalender','1.1.1999', NULL);
insert into sage_path (path_id,loginname,pathname,description,insert_at, path_id_parent) values (8,'nobody','ADMIN','Administrationstools','1.1.1999', NULL);
insert into sage_path (path_id,loginname,pathname,description,insert_at, path_id_parent) values (9,'nobody','HILFE','Das Hilfesystem','1.1.1999', NULL);

insert into sage_user_calendar_map (user_id,calendar_id) values (1,1);
insert into sage_user_calendar_map (user_id,calendar_id) values (1,3);
insert into sage_user_calendar_map (user_id,calendar_id) values (2,1);
insert into sage_user_calendar_map (user_id,calendar_id) values (2,2);
insert into sage_user_calendar_map (user_id,calendar_id) values (3,1);
insert into sage_user_calendar_map (user_id,calendar_id) values (3,3);

insert into sage_calendar (initiator,date,begin,duration,description,place) values (1,'3.12.2002','15:30','30','Mr. Burnes Büro','Kantine');
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