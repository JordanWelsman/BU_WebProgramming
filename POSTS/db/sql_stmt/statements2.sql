SELECT * FROM packages where country = "US" LIMIT 0, 100;

SELECT
	s.description as "Status",
    COUNT(status) as "Frequency"
FROM packages p
	INNER JOIN statuses s ON p.status = s.id
GROUP BY s.description ORDER BY Frequency DESC LIMIT 20;

SELECT country, COUNT(country) as quantity
FROM packages
GROUP BY country LIMIT 500;

SELECT userid, COUNT(userid) as quantity
FROM userpackages
GROUP BY userid ORDER BY quantity DESC LIMIT 128;

create table userpackages;

DELETE FROM userpackages WHERE userid = 107;

SELECT * FROM users ORDER BY id ASC LIMIT 150;
SELECT * FROM packages LIMIT 30;
SELECT * FROM userpackages ORDER BY id ASC LIMIT 1000;
SELECT * FROM statuses LIMIT 20;

SELECT * FROM packages WHERE trackingnumber = "UK614118867RS";

SELECT 
	p.trackingnumber as "Tracking No.",
    p.orderdate as "Order Date",
    s.description as "Status",
    p.name as "Name",
    p.destination as "Destination",
    p.city as "City",
    p.country as "Country",
    p.postcode as "Postcode"
FROM packages p
	INNER JOIN statuses s on p.status = s.id
ORDER BY p.orderdate, p.trackingnumber LIMIT 10;

SELECT 
	p.trackingnumber as 'Tracking No.',
	p.orderdate as 'Order Date',
	s.description as 'Status',
	p.name as 'Name',
	p.destination as 'Destination',
	p.city as 'City',
	p.country as 'Country',
	p.postcode as 'Postcode'
FROM packages p
	INNER JOIN statuses s on p.status = s.id
WHERE trackingnumber = "UK614118867RS" ORDER BY p.orderdate, p.trackingnumber LIMIT 10;

SELECT
	p.trackingnumber as "Tracking No.",
    p.orderdate as "Order Date",
    s.description as "Status",
    u.forename as "First Name",
	u.surname as "Last Name",
    u.email as "Email",
    p.destination as "Destination",
    p.city as "City",
    p.country as "Country"
FROM users u
	INNER JOIN userpackages up ON u.id = up.userid
	INNER JOIN packages p ON up.packageid = p.id
    INNER JOIN statuses s ON p.status = s.id
WHERE u.id = 88
ORDER BY p.trackingnumber, u.forename LIMIT 10;

INSERT INTO userpackages VALUES (NULL, 107, 69);

SELECT id FROM users;
SELECT id FROM packages;

SELECT * FROM users WHERE email = "ss@ss.com";

SELECT * FROM users where id > 100 ORDER by id DESC;
INSERT INTO users (id, forename, surname, email, password, admin) VALUES (NULL, "Jordan", "Welsman", "jordan.welsman@hotmail.co.uk", "Bruh", false);

UPDATE users SET password = "x" WHERE id = "x";

SELECT * FROM userpackages WHERE id > 120 ORDER BY id DESC;
SELECT * FROM users WHERE forename = "Jordan";
SELECT * FROM users WHERE id > 100 ORDER BY id DESC LIMIT 50;

INSERT INTO userpackages VALUES (NULL, 104, 420), (NULL, 104, 999), (NULL, 104, 383), (NULL, 104, 666);