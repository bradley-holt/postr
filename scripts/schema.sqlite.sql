
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

CREATE INDEX "entry_id" ON "entry" ("id");


--
-- Definition of table `entry_tag`
--

CREATE TABLE entry_tag (
    entry_id INTEGER NOT NULL,
    tag VARCHAR(255) NOT NULL,
    PRIMARY KEY (entry_id, tag)
);

CREATE INDEX "entry_tag_entry_id" ON "entry_tag" ("entry_id");
CREATE INDEX "entry_tag_tag" ON "entry_tag" ("tag");
