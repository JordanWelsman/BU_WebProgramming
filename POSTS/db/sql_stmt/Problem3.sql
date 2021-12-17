DELETE FROM MEDICALRECORD (SELECT *);

INSERT INTO MEDICALRECORD VALUES (NULL, "2019-07-16", "Chest pain.");
INSERT INTO MEDICALRECORD VALUES (NULL, "2020-04-28", "Brain damage");
INSERT INTO MEDICALRECORD VALUES (NULL, "2020-11-05", "Missing hand");
INSERT INTO MEDICALRECORD VALUES (NULL, "2021-06-21", "Broken ankle");

SELECT * FROM MEDICALRECORD;



-- Final work
ALTER TABLE MEDICALRECORD DROP PRIMARY KEY,
ADD PRIMARY KEY (Record_id, Date_examination);
ALTER TABLE MEDICALRECORD PARTITION BY RANGE (YEAR (Date_examination)) (
	PARTITION mr_2018 VALUES LESS THAN (2019),
	PARTITION mr_2019 VALUES LESS THAN (2020),
	PARTITION mr_2020 VALUES LESS THAN (2021),
	PARTITION mr_CURRENT VALUES LESS THAN MAXVALUE);

SELECT * FROM MEDICALRECORD PARTITION (mr_2020);



-- Final work
SELECT * FROM DOCTOR;

CREATE TABLE doctorspublic AS (
SELECT D_id, D_name, Qualification FROM DOCTOR);
CREATE TABLE doctorsprivate AS (
	SELECT D_id, Salary FROM DOCTOR);
DROP TABLE DOCTOR;

SELECT * FROM doctorspublic;
SELECT * FROM doctorsprivate;



CREATE TABLE MEDICALRECORD_2019 AS (SELECT * FROM MEDICALRECORD WHERE Date_examination BETWEEN "2019-01-01" AND "2019-12-31");
CREATE TABLE MEDICALRECORD_2020 AS (SELECT * FROM MEDICALRECORD WHERE Date_examination BETWEEN "2020-01-01" AND "2020-12-31");
CREATE TABLE MEDICALRECORD_2021 AS (SELECT * FROM MEDICALRECORD WHERE Date_examination BETWEEN "2021-01-01" AND "2021-12-31");

ALTER TABLE MEDICALRECORD PARTITION BY RANGE (YEAR(Date_examination)) (
    PARTITION MR_2019 VALUES LESS THAN (2020),
    PARTITION MR_2020 VALUES LESS THAN (2021),
    PARTITION MR_CURRENT VALUES LESS THAN MAXVALUE
);


CREATE TABLE `s5117801`.`DOCTOR` (
  `D_id` INT NOT NULL,
  `D_Name` VARCHAR(45) NOT NULL,
  `Qualification` VARCHAR(45) NOT NULL,
  `Salary` INT NOT NULL,
  PRIMARY KEY (`D_id`));

INSERT INTO DOCTOR VALUES (20471, "Adele Small", "MBChB", 58400);
INSERT INTO DOCTOR VALUES (18237, "Aimee Todd", "BMBS", 53500);
INSERT INTO DOCTOR VALUES (24619, "Rogan Dyer", "MRCGP", 47200);
INSERT INTO DOCTOR VALUES (16773, "Russell Mueller", "BmedSci", 68300);

SELECT * FROM DOCTOR;

CREATE TABLE DOCTORPUBLIC AS (SELECT D_id, D_Name, Qualification FROM DOCTOR);
CREATE TABLE DOCTORPRIVATE AS (SELECT D_id, Salary FROM DOCTOR);

SELECT * FROM DOCTORPRIVATE;

