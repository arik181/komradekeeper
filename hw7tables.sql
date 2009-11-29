create table users (

	userid int,	-- 
	password varchar(80),
	name varchar(80)

);

create table contact (

	contactid int,	-- 
	name varchar(80),
	address varchar(80),
	city varchar(80),
	state varchar(80),
	zip varchar(80),
	userid int

);

create table phone (

	phonenumber varchar(80),	-- 
	contactid varchar(80),
	type varchar(80)

);

create table email (

	emailaddr varchar(80),	-- 
	contactid varchar(80)

);

create table other (

	otherid int,	-- 
	contactid varchar(80),
	type varchar(80),
	other varchar(80)

);

create table organization (

	orgid int,	-- 
	orgname varchar(80),
	address varchar(80),
	description varchar(80)

);

create table contactorg (

	contactid varchar(80),	-- 
	orgid varchar(80),
	role varchar(80)

);

create sequence useridseq start 1;
create sequence contactidseq start 1;
create sequence orgidseq start 1;
create sequence otheridseq start 1;

insert into users values ( nextval('useridseq'), 'passwd', 'Joe Bob');
insert into users values ( nextval('useridseq'), 'passwd', 'The Dude');
insert into users values ( nextval('useridseq'), 'passwd', 'Some Guy');
insert into users values ( nextval('useridseq'), 'passwd', 'Some Other Guy');

insert into contact values ( nextval('contactidseq'), 'Komrade Joe', '9000 S Somewhere St.', 'City of Elephants', 'KY', '38313', '1');
insert into contact values ( nextval('contactidseq'), 'Komrade Mac', '9100 S Somewhere St.', 'City of Dinosaurs', 'NJ', '38213', '1');
insert into contact values ( nextval('contactidseq'), 'Komrade Karl', '9200 S Somewhere St.', 'City of Flies', 'OK', '38333', '3');
insert into contact values ( nextval('contactidseq'), 'Komrade Sigmund', '9300 S Somewhere St.', 'City of Piggies', 'OK', '48313', '3');
insert into contact values ( nextval('contactidseq'), 'Komrade Stork', '9400 S Somewhere St.', 'City of Brambles', 'OK', '78313', '2');
insert into contact values ( nextval('contactidseq'), 'Komrade Eddie', '9500 S Somewhere St.', 'City of Lights', 'NH', '38613', '2');
insert into contact values ( nextval('contactidseq'), 'Komrade Steve', '9600 S Somewhere St.', 'City of Beer', 'NH', '38353', '4');
insert into contact values ( nextval('contactidseq'), 'Komrade Bill', '9700 S Somewhere St.', 'City of Potato Chips', 'DC', '39313', '4');

insert into phone values ( '15555555', '1', 'home');
insert into phone values ( '15555555', '2', 'home');
insert into phone values ( '15555555', '2', 'cell');
insert into phone values ( '15555555', '2', 'work');
insert into phone values ( '15555555', '3', 'home');
insert into phone values ( '15555555', '3', 'cell');
insert into phone values ( '15555555', '3', 'work');
insert into phone values ( '15555555', '4', 'cell');
insert into phone values ( '15555555', '4', 'work');
insert into phone values ( '15555555', '5', 'cell');
insert into phone values ( '15555555', '6', 'cell');
insert into phone values ( '15555555', '7', 'cell');
insert into phone values ( '15555555', '8', 'home');
insert into phone values ( '15555555', '8', 'cell');
insert into phone values ( '15555555', '8', 'work');

insert into email values ( 'joe@spammail.com', '1');
insert into email values ( 'mac@spammail.com', '2');
insert into email values ( 'karl@spammail.com', '3');
insert into email values ( 'sigmund@spammail.com', '4');
insert into email values ( 'stork@spammail.com', '5');
insert into email values ( 'eddie@spammail.com', '6');
insert into email values ( 'steve@spammail.com', '7');
insert into email values ( 'bill@spammail.com', '8');

insert into other values ( nextval('otheridseq'), '1', 'wave', 'joe@spamwave.com');

insert into organization values ( nextval('orgidseq'), 'intel', '9001 S Nowhere Ave.', 'Intel corp.');

insert into contactorg values ( '1', '1', 'Supervisor');

grant all on users, contact, phone, email, other, organization, contactorg, orgidseq, contactidseq, otheridseq, useridseq to zacharyp, arik182;

