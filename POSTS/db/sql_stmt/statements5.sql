create table statuses (
	id VARCHAR(2),
	description VARCHAR(20),
	comment VARCHAR(50)
);

insert into statuses (id, description, comment) values
('P1', 'Postage paid', 'Sender has paid for postage'),
('P2', 'Dispatched', 'Package has been dispatched from source'),
('P3', 'In transit', 'Package is en-route to destination'),
('P4', 'Out for delivery', 'Package is being delivered shortly'),
('D1', 'Delivered', 'Package was delivered to addressee'),
('D2', 'With neighbor', 'Package was left with neighbour'),
('D3', 'Ready for pickup', 'Package must be collected from destination'),
('R1', 'Returned to sender', 'Package was returned to sender'),
('R2', 'Returned to depot', 'Package was returned to depot'),
('C1', 'Withheld', 'Import fee to be paid'),
('C2', 'Seized', 'Package contained illegal contents'),
('U1', 'Undelivered', 'Package could not be delivered'),
('U2', 'Lost in transit', 'No recent updates have been given'),
('X1', 'Expired', 'Tracking number has expired');

SELECT
	p.trackingnumber as "Tracking No.",
	s.description as "Status"
FROM packages p
	INNER JOIN statuses s ON p.status = s.id
ORDER BY s.id LIMIT 300;