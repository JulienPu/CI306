create table hd_category(
	cid int(11) unsigned not null auto_increment,
	cname varchar(32) not null default '',
	primary key (cid)
)ENGINE=innodb default charset=utf8;
create table hd_article(
	id mediumint(8) unsigned not null auto_increment,
	cid tinyint(8) unsigned not null ,
	title char(20) not null default '',
	type enum('1','2') comment '类型 1普通 2 热点',
	thumb varchar(70) not null default '' comment '缩略图',
	abstract text not null comment '摘要',
	content text not null comment '内容',
	pubdate int unsigned not null default 0 comment '发表时间',
	primary key (id),
	unique key (title)
)ENGINE=innodb default charset=utf8;