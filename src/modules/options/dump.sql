
# Options entity
CREATE TABLE IF NOT EXISTS options
(
  namespace VARCHAR(64) DEFAULT 'default' NOT NULL,
  `key` VARCHAR(255) NOT NULL,
  value LONGTEXT NOT NULL,
  description LONGTEXT,
  created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  updated TIMESTAMP NOT NULL,
  CONSTRAINT options_key_namespace_pk PRIMARY KEY (`key`, namespace)
);

REPLACE INTO `acl_privileges` (`roleId`, `module`, `privilege`)
VALUES (2,'options','Management');
