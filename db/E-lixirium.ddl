-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Fri Dec 27 15:33:42 2024 
-- * LUN file: C:\Users\andre\Documents\PROGRAMMAZIONE\Web\E-lixirium\E-lixirium.lun 
-- * Schema: elixirium/1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database `e-lixirium`;
use `e-lixirium`;


-- Tables Section
-- _____________ 

create table PRODUCT (
     name char(30) not null,
     id_product int not null,
     description varchar(300) not null,
     image_name char(30) not null,
     price int not null,
     amount_left int not null,
     duration int not null,
     constraint ID_PRODUCT_ID primary key (id_product));

create table USER (
     name char(30) not null,
     surname char(30) not null,
     username char(30) not null,
     email char(30) not null,
     password char(30) not null,
     birthday date not null,
     card_number int,
     constraint ID_USER_ID primary key (username));

create table CATEGORY (
     name char(30) not null,
     constraint ID_CATEGORY_ID primary key (name));

create table ADMIN (
     username char(30) not null,
     password char(30) not null,
     constraint ID_ADMIN_ID primary key (username));

create table `ORDER` (
     id_order int not null,
     date date not null,
     username char(30) not null,
     constraint ID_ORDER_ID primary key (id_order));

create table REVIEW (
     id_product int not null,
     username char(30) not null,
     stars int not null,
     constraint ID_REVIEW_ID primary key (id_product, username));

create table NOTIFICATION (
     id_notification int not null,
     title char(30) not null,
     data date not null,
     description varchar(300) not null,
     username char(30),
     SEN_username char(30),
     constraint ID_NOTIFICATION_ID primary key (id_notification));

create table INCLUDES (
     id_order int not null,
     id_product int not null,
     quantity int not null,
     constraint ID_INCLUDES_ID primary key (id_product, id_order));

create table `IS` (
     name char(30) not null,
     id_product int not null,
     constraint ID_IS_ID primary key (name, id_product));

create table WISHES (
     id_product int not null,
     username char(30) not null,
     constraint ID_WISHES_ID primary key (id_product, username));


-- Constraints Section
-- ___________________ 

-- Not implemented
-- alter table PRODUCT add constraint ID_PRODUCT_CHK
--     check(exists(select * from `IS`
--                  where `IS`.id_product = id_product)); 

-- Not implemented
-- alter table `ORDER` add constraint ID_ORDER_CHK
--     check(exists(select * from INCLUDES
--                  where INCLUDES.id_order = id_order)); 

alter table `ORDER` add constraint FKCOMMITS_FK
     foreign key (username)
     references USER (username);

alter table REVIEW add constraint FKWRITES_FK
     foreign key (username)
     references USER (username);

alter table REVIEW add constraint FKHAS
     foreign key (id_product)
     references PRODUCT (id_product);

alter table NOTIFICATION add constraint FKSENT_USER_FK
     foreign key (username)
     references USER (username);

alter table NOTIFICATION add constraint FKSENT_ADMIN_FK
     foreign key (SEN_username)
     references ADMIN (username);

alter table INCLUDES add constraint FKINC_PRO
     foreign key (id_product)
     references PRODUCT (id_product);

alter table INCLUDES add constraint FKINC_ORD_FK
     foreign key (id_order)
     references `ORDER` (id_order);

alter table `IS` add constraint FKIS_PRO_FK
     foreign key (id_product)
     references PRODUCT (id_product);

alter table `IS` add constraint FKIS_CAT
     foreign key (name)
     references CATEGORY (name);

alter table WISHES add constraint FKWIS_USE_FK
     foreign key (username)
     references USER (username);

alter table WISHES add constraint FKWIS_PRO
     foreign key (id_product)
     references PRODUCT (id_product);


-- Index Section
-- _____________ 

create unique index ID_PRODUCT_IND
     on PRODUCT (id_product);

create unique index ID_USER_IND
     on USER (username);

create unique index ID_CATEGORY_IND
     on CATEGORY (name);

create unique index ID_ADMIN_IND
     on ADMIN (username);

create unique index ID_ORDER_IND
     on `ORDER` (id_order);

create index FKCOMMITS_IND
     on `ORDER` (username);

create unique index ID_REVIEW_IND
     on REVIEW (id_product, username);

create index FKWRITES_IND
     on REVIEW (username);

create unique index ID_NOTIFICATION_IND
     on NOTIFICATION (id_notification);

create index FKSENT_USER_IND
     on NOTIFICATION (username);

create index FKSENT_ADMIN_IND
     on NOTIFICATION (SEN_username);

create unique index ID_INCLUDES_IND
     on INCLUDES (id_product, id_order);

create index FKINC_ORD_IND
     on INCLUDES (id_order);

create unique index ID_IS_IND
     on `IS` (name, id_product);

create index FKIS_PRO_IND
     on `IS` (id_product);

create unique index ID_WISHES_IND
     on WISHES (id_product, username);

create index FKWIS_USE_IND
     on WISHES (username);

