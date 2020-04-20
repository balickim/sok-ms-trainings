BEGIN;

create table trainings (
	trainingid SERIAL PRIMARY KEY,
	poolid INT,
	startdate TIMESTAMP,
	enddate TIMESTAMP,
	description VARCHAR(50)
);

create table pools (
	poolid INT PRIMARY KEY,
	length INT,
	name VARCHAR(50)
);

insert into pools (poolid, length, name) values (0, 0, '-');
insert into pools (poolid, length, name) values (1, 25, 'small');
insert into pools (poolid, length, name) values (2, 50, 'big');

ALTER TABLE trainings
	ADD FOREIGN KEY (poolid) REFERENCES pools (poolid);

COMMIT;