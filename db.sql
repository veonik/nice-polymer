USE polymer;

DROP TABLE IF EXISTS messages;

CREATE TABLE messages (
	id       INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	uid      INT(11)          NOT NULL,
	text     TEXT             NOT NULL,
	username VARCHAR(50)      NOT NULL,
	avatar   VARCHAR(100)     NOT NULL,
	favorite TINYINT(1)       NOT NULL DEFAULT 0,
	PRIMARY KEY (id)
);

INSERT INTO messages (id, uid, text, username, avatar, favorite)
VALUES
	(1,1,'Have you heard about the Web Components revolution?','Eric','images/avatar-01.svg',0),
	(2,2,'Loving this Polymer thing.','Rob','images/avatar-02.svg',0),
	(3,3,'So last year...','Dimitri','images/avatar-03.svg',0),
	(4,4,'Pretty sure I came up with that first.','Ada','images/avatar-07.svg',0),
	(5,5,'Yo, I heard you like components, so I put a component in your component.','Grace','images/avatar-08.svg',0),
	(6,6,'Centralize, centrailize.','John','images/avatar-04.svg',0),
	(7,7,'Has anyone seen my cat?','Zelda','images/avatar-06.svg',0),
	(8,8,'Decentralize!','Norbert','images/avatar-05.svg',0);
