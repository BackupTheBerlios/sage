-- ---------------------------------------------
-- Skript zur Erstellung der Datenbank fuer Sage
-- Datenmodell Version: 1.0.0-1
-- Autor: Daniel Dietze
-- Stand: 22.05.2002
-- ---------------------------------------------
--
--
-- erstele SAGE_USER
CREATE TABLE sage_user (
   user_id           INT          NOT NULL auto_increment,
   loginname         VARCHAR(40)  NOT NULL,
   password          VARCHAR(255) NOT NULL,
   firstname         VARCHAR(40)  NOT NULL,
   surname           VARCHAR(40)  NOT NULL,
   description       VARCHAR(255),
   homepage          VARCHAR(40),
   e_mail            VARCHAR(40),
   is_su             SET('0','1') NOT NULL DEFAULT '0',
   user_id_parent    INT  NULL,
   PRIMARY KEY (user_id),
   UNIQUE sage_user$loginname (loginname),
   INDEX sage_user$user_id_parent (user_id_parent)
   )
   COMMENT = "Zentrale Tabelle zur Userverwaltung"
   ;

-- erstelle sage_user_calendar_map
CREATE TABLE sage_user_calendar_map (
   user_id           INT     NOT NULL,
   calendar_id       INT     NOT NULL,
   PRIMARY KEY (user_id,calendar_id)
   )
   COMMENT = "Mapping Tabelle fuer User zu Kalendar"
   ;

-- erstelle sage_calendar
CREATE TABLE sage_calendar (
   calendar_id       INT            NOT NULL auto_increment,
   initiator         INT            NOT NULL,
   date              DATE           NOT NULL,
   begin             TIME           NOT NULL,
   duration          TINYINT        NOT NULL,
   description       VARCHAR(255)   NOT NULL,
   place             VARCHAR(255)   NOT NULL,
   PRIMARY KEY (calendar_id),
   INDEX sage_calendar$initiator (initiator)
   )
   COMMENT = "Kalender eines jeden Users"
   ;

-- erstelle sage_acl
CREATE TABLE sage_acl (
   acl_id      INT          NOT NULL auto_increment,
   user_id     INT          NOT NULL,
   path_id     INT          NOT NULL,
   delete_path SET('0','1') NOT NULL DEFAULT '0',
   write_path  SET('0','1') NOT NULL DEFAULT '0',
   read_path   SET('0','1') NOT NULL DEFAULT '0',
   rename_path SET('0','1') NOT NULL DEFAULT '0',
   read_file   SET('0','1') NOT NULL DEFAULT '0',
   write_file  SET('0','1') NOT NULL DEFAULT '0',
   delete_file SET('0','1') NOT NULL DEFAULT '0',
   rename_file SET('0','1') NOT NULL DEFAULT '0',
   PRIMARY KEY (acl_id),
   INDEX sage_acl$user_id (user_id),
   INDEX sage_acl$path_id (path_id)
   )
   COMMENT = "Tabelle fuer die Rechteverwaltung"
   ;

-- erstelle sage_addrbook
CREATE TABLE sage_addrbook (
   addr_book_id   INT   NOT NULL auto_increment,
   user_id        INT   NOT NULL,
   user_profil_id INT,
   surname        VARCHAR(40),
   firstname      VARCHAR(40),
   e_mail         VARCHAR(40),
   telephone      VARCHAR(20),
   mobile         VARCHAR(20),
   homepage       VARCHAR(40),
   PRIMARY KEY (addr_book_id),
   INDEX sage_addrbook$user_id (user_id),
   INDEX sage_addrbook$surname (surname),
   INDEX sage_addrbook$firstname (firstname)
   )
   COMMENT = "Adressbuchdaten fuer jeden User"
   ;

-- erstelle sage_address
CREATE TABLE sage_address (
   addr_id           INT         NOT NULL auto_increment,
   user_id           INT         NOT NULL,
   address_type_id   INT         NOT NULL,
   name              VARCHAR(40) NULL,
   street            VARCHAR(40) NOT NULL,
   house_nr          VARCHAR(40) NOT NULL,
   city              VARCHAR(40) NOT NULL,
   zip_code          VARCHAR(10) NOT NULL,
   telephone         VARCHAR(20) NULL,
   mobile            VARCHAR(20) NULL,
   fax               VARCHAR(20) NULL,
   e_mail            VARCHAR(20) NULL,
   PRIMARY KEY (addr_id),
   INDEX sage_address$user_id (user_id),
   INDEX sage_address$address_type_id (address_type_id)
   )
   COMMENT = "Tabelle fuer verschiedene Adressdaten des Users"
   ;

-- erstelle sage_address_type
CREATE TABLE sage_address_type (
   address_type_id   INT          NOT NULL auto_increment,
   description       varchar(255) NOT NULL,
   PRIMARY KEY (address_type_id)
   )
   COMMENT = "Typ Tabelle fuer die verschiedenen Adresstypen"
   ;

-- erstelle sage_guest
CREATE TABLE sage_guest (
   account_id        INT          NOT NULL auto_increment,
   invited_by        INT          NOT NULL,
   invited_at        TIMESTAMP    NOT NULL,
   name              VARCHAR(40)  NOT NULL,
   code              VARCHAR(255) NOT NULL,
   PRIMARY KEY  (account_id),
   INDEX sage_guest$invited_by$invited_by (invited_by)
   )
   COMMENT = "Tabelle fuer eingeladene User"
   ;

-- erstelle sage_mailing_list
CREATE TABLE sage_mailing_list (
   mailing_list_id   INT            NOT NULL auto_increment,
   e_mail            VARCHAR(255)   NOT NULL,
   PRIMARY KEY (mailing_list_id)
   )
   COMMENT = "Tabelle zur Verwaltung von Mailinglisten"
   ;

-- erstelle sage_mail_user_map
CREATE TABLE sage_mail_user_map (
   user_id           INT            NOT NULL,
   mailing_list_id   INT            NOT NULL,
   PRIMARY KEY (mailing_list_id,user_id)
   )
   COMMENT = "Mapping von User zu Mailingliste"
   ;

-- erstelle sage_dm_version
CREATE TABLE sage_dm_version (
   datamodel_version VARCHAR(15) NOT NULL
   )
   COMMENT = "Tabelle mit der Datenmodellversion"
   ;
-- erstelle sage_files
CREATE TABLE sage_files (
   file_id           INT          NOT NULL auto_increment,
   path_id           INT          NOT NULL,
   loginname         VARCHAR(40)  NOT NULL,
   filename          VARCHAR(255) NOT NULL,
   description       VARCHAR(255) NOT NULL,
   insert_at         DATE         NOT NULL,
   modified_at       DATE         NULL,
   PRIMARY KEY (file_id),
   INDEX sage_files$path_id (path_id),
   INDEX sage_files$loginname (loginname)
   )
   COMMENT = "Tabelle fuer die Zuordnung von Dateien zu Verzeichnissen auf dem Dateisystem"
   ;

-- erstelle sage_path
CREATE TABLE sage_path (
   path_id           INT          NOT NULL auto_increment,
   loginname         VARCHAR(40)  NOT NULL,
   pathname          VARCHAR(255) NOT NULL,
   description       VARCHAR(255) NOT NULL,
   insert_at         DATE         NOT NULL,
   modified_at       DATE         NULL,
   path_id_parent    INT          NULL,
   PRIMARY KEY (path_id),
   INDEX sage_path$loginname (loginname),
   INDEX sage_path$path_id_parent (path_id_parent)
   )
   COMMENT = "Tabelle fuer die Zuordnung von Verzeichnissen zu Usern und zu deren Rechten an dem Verzeichnis"
   ;

-- fuegt die aktuelle Datenmodellversion ein
insert into sage_dm_version (datamodel_version) values ('1.0.0-1');

-- End Script