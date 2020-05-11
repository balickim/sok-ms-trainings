BEGIN;

create table trainings (
	trainingid SERIAL PRIMARY KEY,
	poolid INT,
	startdate TIMESTAMP,
	enddate TIMESTAMP,
	description VARCHAR(50)
);

COMMIT;