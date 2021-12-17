## UNIVERSITY SERVER

SELECT * FROM users LIMIT 10;
SELECT * FROM users WHERE forename = "Admin" LIMIT 50;
SELECT * FROM users WHERE forename = "Lauren" LIMIT 50;
SELECT * FROM users WHERE id > 120 ORDER BY id DESC LIMIT 50;
SELECT * FROM packages;

SELECT * FROM packages LIMIT 10;
SELECT * FROM packages WHERE id = 371; # RU728428658KL

SELECT * FROM packages ORDER BY id DESC LIMIT 20;

SELECT * FROM statuses LIMIT 20;

SELECT * FROM userpackages WHERE userid = 137 ORDER BY id DESC LIMIT 10;
SELECT * FROM userpackages ORDER BY id DESC LIMIT 20;
INSERT INTO userpackages VALUES (NULL, 104, 40000);
SELECT * FROM userpackages LIMIT 10;

SELECT * from userpackages WHERE userid = 104 AND packageid = 998;

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
WHERE trackingnumber = 'AB123456789CD' ORDER BY p.orderdate, p.trackingnumber LIMIT 10;

SELECT 
	p.trackingnumber as 'Tracking No.',
	p.orderdate as 'Order Date',
	s.description as 'Status',
	p.city as 'City',
	p.country as 'Country'
FROM packages p
	INNER JOIN statuses s on p.status = s.id
WHERE trackingnumber = 'AB123456789CD' ORDER BY p.orderdate, p.trackingnumber LIMIT 10;