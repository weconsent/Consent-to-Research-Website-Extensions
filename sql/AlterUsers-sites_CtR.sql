ALTER TABLE aiki_users ADD COLUMN dob varchar(255) NOT NULL AFTER full_name;
ALTER TABLE aiki_users ADD COLUMN mother varchar(255) NOT NULL AFTER dob;
ALTER TABLE aiki_users ADD COLUMN movie varchar(255) NOT NULL AFTER mother;
