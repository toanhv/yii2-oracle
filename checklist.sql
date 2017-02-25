-- table user_ad
CREATE TABLE user_ad
    (id                             NUMBER(10,0) ,
    username                       VARCHAR2(255 BYTE),
    auth_key                       VARCHAR2(32 BYTE),
    password_hash                  VARCHAR2(255 BYTE),
    password_reset_token           VARCHAR2(255 BYTE),
    email                          VARCHAR2(255 BYTE),
    status                         NUMBER(5,0),
    created_at                     TIMESTAMP (6),
    updated_at                     TIMESTAMP (6),
    last_time_login                DATE,
    num_login_fail                 NUMBER(5,0) DEFAULT 0,
    is_first_login                 NUMBER(1,0) DEFAULT 1)
/

ALTER TABLE user_ad
ADD CONSTRAINT user_ad_pk PRIMARY KEY (id)
USING INDEX
/
create sequence user_ad_sequence
/
CREATE TRIGGER user_ad_sequence
 BEFORE
  INSERT
 ON user_ad
REFERENCING NEW AS NEW OLD AS OLD
 FOR EACH ROW
begin   select user_ad_sequence.nextval
  into :new.id   from dual; end;
/
-- insert data to USER_AD
INSERT INTO USER_AD(id, username,auth_key, password_hash, password_reset_token,email,status,is_first_login,created_at, updated_at) 
VALUES(1,'admin','4h-Riu9DiVNtQaleopsrS56nWGuIe7Ou','$2y$13$RUqvvnTJea8Y2cWAShFnGuAeuoUGCYYstXnHFHEHCJlKM7sfNp.CG','4YL8u4mZcU7Wo9prblXifxj9s_aawK0D_1460168031','admin@viettel.com.vn',1,0,sysdate,sysdate);
update user_ad set id = 1;
commit;

-- table menu
create table menu
    (id                          number(10,0) ,
    name                         varchar2(128 byte) ,
    parent                       number(10,0),
    route                        varchar2(256 byte),
    priority                     number(10,0),
    data                         varchar2(256 byte))
/
alter table menu add primary key (id) using index
/
alter table menu  add check (name is not null)
/
alter table menu  add check (id is not null)
/
create sequence menu_sequence
/
create trigger menu_sequence
 before   insert
 on menu referencing new as new old as old
 for each row begin   select menu_sequence.nextval
  into :new.id   from dual; end;
/
alter table menu add foreign key (parent) references menu (id)
/

-- table auth_rule
CREATE TABLE auth_rule
    (name                           VARCHAR2(64 BYTE) ,
    data                           CLOB,
    created_at                     NUMBER(10,0),
    updated_at                     NUMBER(10,0))
  LOB ("DATA") STORE AS SYS_LOB0000161210C00002$$
  (
   NOCACHE LOGGING
   CHUNK 8192
  )
/

ALTER TABLE auth_rule
ADD CHECK (name is not null)
/

ALTER TABLE auth_rule
ADD PRIMARY KEY (name)
USING INDEX
/

-- table auth_item
CREATE TABLE auth_item
    (name                           VARCHAR2(64 BYTE) ,
    type                           NUMBER(10,0),
    description                    CLOB,
    rule_name                      VARCHAR2(64 BYTE),
    data                           CLOB,
    created_at                     NUMBER(10,0),
    updated_at                     NUMBER(10,0))
  LOB ("DESCRIPTION") STORE AS SYS_LOB0000161214C00003$$
  (
   NOCACHE LOGGING
   CHUNK 8192
  )
  LOB ("DATA") STORE AS SYS_LOB0000161214C00005$$
  (
   NOCACHE LOGGING
   CHUNK 8192
  )
/


ALTER TABLE auth_item
ADD CHECK (name is not null)
/

ALTER TABLE auth_item
ADD CHECK (type is not null)
/

ALTER TABLE auth_item
ADD PRIMARY KEY (name)
USING INDEX
/

ALTER TABLE auth_item
ADD FOREIGN KEY (rule_name)
REFERENCES auth_rule (name) ON DELETE SET NULL
/

-- table auth_item_child
CREATE TABLE auth_item_child
    (parent                         VARCHAR2(64 BYTE) ,
    child                          VARCHAR2(64 BYTE) )
/


ALTER TABLE auth_item_child
ADD CHECK (parent is not null)
/

ALTER TABLE auth_item_child
ADD CHECK (child is not null)
/

ALTER TABLE auth_item_child
ADD PRIMARY KEY (parent, child)
USING INDEX
/

ALTER TABLE auth_item_child
ADD FOREIGN KEY (parent)
REFERENCES auth_item (name)
/
ALTER TABLE auth_item_child
ADD FOREIGN KEY (child)
REFERENCES auth_item (name)
/

-- insert into AUTH_ITEM_CHILD
--INSERT INTO AUTH_ITEM_CHILD VALUES('admin','/*');
--INSERT INTO AUTH_ITEM_CHILD VALUES('admin','/admin/*');
--commit;

CREATE TABLE auth_assignment
    (item_name                      VARCHAR2(64 BYTE) ,
    user_id                        VARCHAR2(64 BYTE) ,
    created_at                     NUMBER(10,0))
/


ALTER TABLE auth_assignment
ADD CHECK (item_name is not null)
/

ALTER TABLE auth_assignment
ADD CHECK (user_id is not null)
/

ALTER TABLE auth_assignment
ADD PRIMARY KEY (item_name, user_id)
USING INDEX
/

ALTER TABLE auth_assignment
ADD FOREIGN KEY (item_name)
REFERENCES auth_item (name)
/

--INSERT INTO AUTH_ASSIGNMENT VALUES('admin','1',1463200928);
commit;
