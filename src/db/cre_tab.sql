-- erstele SAGE_USER
CREATE TABLE sage_user (
   user_id INT NOT NULL auto_increment,
   loginname VARCHAR(40) NOT NULL,
   password  VARCHAR(255) NOT NULL,
   firstname VARCHAR(40) NOT NULL,
   surname VARCHAR(40) NOT NULL,
   user_id_parent INT  NULL,
   PRIMARY KEY (user_id),
   INDEX sage_user$loginname (loginname)
   )
   COMMENT = "Zentrale Tabelle zur Userverwaltung"
   ;
   
-- erstelle sage_calendar
CREATE TABLE sage_calendar (
   calendar_id INT NOT NULL auto_increment,
   user_id     INT NOT NULL,
   date        DATE NOT NULL,
   start       TIME NOT NULL,
   duration    TINYINT NOT NULL,
   description text NOT NULL,
   place       text NOT NULL,
   PRIMARY KEY (calendar_id),
   INDEX sage_calendar$user_id (user_id)
   )
   COMMENT = "Kalender eines jeden Users"
   ; 

-- erstelle sage_acl   
CREATE TABLE sage_acl (
   acl_id      INT NOT NULL auto_increment,
   user_id     INT NOT NULL,
   path        VARCHAR(255) NOT NULL,
   recht1      SET('0','1') NOT NULL,
   recht2      SET('0','1') NOT NULL,
   recht3      SET('0','1') NOT NULL,
   PRIMARY KEY (acl_id),
   INDEX sage_acl$acl_id (acl_id)
   )
   COMMENT = "Tabelle fuer die Rechteverwaltung"
   ;

-- erstelle sage_addrbook
CREATE TABLE sage_addrbook (
   addr_book_id   INT NOT NULL auto_increment,
   user_id        INT NOT NULL,
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
   addr_id           INT NOT NULL auto_increment,
   profil_id         INT NOT NULL,
   address_type_id   INT NOT NULL,
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
   INDEX sage_address$profil_id (profil_id),
   INDEX sage_address$address_type_id (address_type_id)
   )
   COMMENT = "Tabelle fuer verschiedene Adressdaten des Users"
   ;
   
-- erstelle sage_address_type
CREATE TABLE sage_address_type (
   address_type_id   INT NOT NULL auto_increment,
   description       varchar(255),
   PRIMARY KEY (address_type_id)
   )
   COMMENT = "Typ Tabelle fuer die verschiedenen Adresstypen"
   ;
   
-- erstelle sage_profil
CREATE TABLE sage_profil (
   profil_id         INT NOT NULL auto_increment,
   user_id           INT NOT NULL,
   description       VARCHAR(255),
   homepage          VARCHAR(40),
   e_mail            VARCHAR(40),
   PRIMARY KEY (profil_id),
   INDEX sage_profil$user_id (user_id)
   )
   COMMENT = "Profil des Users"
   ;

-- erstelle sage_guest
CREATE TABLE sage_guest (
   account_id        INT NOT NULL auto_increment,
   invited_by        INT NOT NULL,
   invited_at        TIMESTAMP NOT NULL,
   name              VARCHAR(40) NOT NULL,
   code              VARCHAR(255) NOT NULL,
   PRIMARY KEY  (account_id)
   )
   COMMENT = "Tabelle fuer eingeladene User"
   ;

-- erstelle sage_dm_version
CREATE TABLE sage_dm_version (
   datamodel_version VARCHAR(15) NOT NULL
   )
   COMMENT = "Datenmodell Version"
   ;