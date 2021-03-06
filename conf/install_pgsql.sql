create sequence #prefix#faq_id_seq;

create table #prefix#faq (
	id integer not null default nextval('#prefix#faq_id_seq') primary key,
	question char(128) not null,
	answer text not null,
	sort int not null,
	category int not null default 0
);

create index #prefix#faq_sort on #prefix#faq (category, sort);

create sequence #prefix#faq_category_id_seq;

create table #prefix#faq_category (
	id integer not null default nextval('#prefix#faq_category_id_seq') primary key,
	name char(72) not null
);

create index #prefix#faq_category_name on #prefix#faq_category (name);
