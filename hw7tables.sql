create table users (

	userid varchar(80),	-- 
	password varchar(80),
	name varchar(80)

);

create table contact (

	contactid varchar(80),	-- 
	name varchar(80),
	address varchar(80),
	city varchar(80),
	state varchar(80),
	zip varchar(80),
	userid varchar(80)

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

	otherid varchar(80),	-- 
	contactid varchar(80),
	type varchar(80),
	other varchar(80)

);

create table organization (

	orgid varchar(80),	-- 
	orgname varchar(80),
	address varchar(80),
	description varchar(80)

);

create table contactorg (

	contactid varchar(80),	-- 
	orgid varchar(80),
	role varchar(80)

);

insert into users values ( '001', 'passwd', 'Joe Bob');
insert into users values ( '002', 'passwd', 'The Dude');
insert into users values ( '003', 'passwd', 'Some Guy');
insert into users values ( '004', 'passwd', 'Some Other Guy');

insert into contact values ( '001', 'Komrade Joe', '9000 S Somewhere St.', 'City of Elephants', 'KY', '38313', '001');
insert into contact values ( '002', 'Komrade Mac', '9100 S Somewhere St.', 'City of Dinosaurs', 'NJ', '38213', '001');
insert into contact values ( '003', 'Komrade Karl', '9200 S Somewhere St.', 'City of Flies', 'OK', '38333', '003');
insert into contact values ( '004', 'Komrade Sigmund', '9300 S Somewhere St.', 'City of Piggies', 'OK', '48313', '003');
insert into contact values ( '005', 'Komrade Stork', '9400 S Somewhere St.', 'City of Brambles', 'OK', '78313', '002');
insert into contact values ( '006', 'Komrade Eddie', '9500 S Somewhere St.', 'City of Lights', 'NH', '38613', '002');
insert into contact values ( '007', 'Komrade Steve', '9600 S Somewhere St.', 'City of Beer', 'NH', '38353', '004');
insert into contact values ( '008', 'Komrade Bill', '9700 S Somewhere St.', 'City of Potato Chips', 'DC', '39313', '004');

insert into phone values ( '15555555', '001', 'home');
insert into phone values ( '15555555', '002', 'home');
insert into phone values ( '15555555', '002', 'cell');
insert into phone values ( '15555555', '002', 'work');
insert into phone values ( '15555555', '003', 'home');
insert into phone values ( '15555555', '003', 'cell');
insert into phone values ( '15555555', '003', 'work');
insert into phone values ( '15555555', '004', 'cell');
insert into phone values ( '15555555', '004', 'work');
insert into phone values ( '15555555', '005', 'cell');
insert into phone values ( '15555555', '006', 'cell');
insert into phone values ( '15555555', '007', 'cell');
insert into phone values ( '15555555', '008', 'home');
insert into phone values ( '15555555', '008', 'cell');
insert into phone values ( '15555555', '008', 'work');

insert into email values ( 'joe@spammail.com', '001');
insert into email values ( 'mac@spammail.com', '002');
insert into email values ( 'karl@spammail.com', '003');
insert into email values ( 'sigmund@spammail.com', '004');
insert into email values ( 'stork@spammail.com', '005');
insert into email values ( 'eddie@spammail.com', '006');
insert into email values ( 'steve@spammail.com', '007');
insert into email values ( 'bill@spammail.com', '008');

insert into other values ( '001', '001', 'wave', 'joe@spamwave.com');

insert into organization values ( '001', 'intel', '9001 S Nowhere Ave.', 'Intel corp.');

insert into contactorg values ( '001', '001', 'Supervisor');

grant all on users, contact, phone, email, other, organization, contactorg to zacharyp;
grant all on users, contact, phone, email, other, organization, contactorg to arik182;
