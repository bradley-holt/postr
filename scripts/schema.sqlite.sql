
--
-- Definition of table `entry`
--

CREATE TABLE entry (
    id INTEGER NOT NULL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    summary TEXT NULL,
    updated DATETIME NOT NULL,
    published DATETIME NOT NULL
);

CREATE INDEX "id" ON "entry" ("id");
