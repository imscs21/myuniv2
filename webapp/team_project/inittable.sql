use waproj;
create table if not exists loginserviceprovider(provider varchar(20) not null primary key);
create table if not exists userlist(loginprovider varchar(15) not null , id varchar(30) not null,virtual_coin int(100) default 1500, lastest_logined_date datetime default now(),storage_session_id varchar(255) not null, primary key(loginprovider,id),foreign key(loginprovider) references loginserviceprovider(provider) on delete cascade on update cascade,unique(storage_session_id));
create table if not exists user_storage (stor_sess varchar(255) not null,path varchar(255) ,filename varchar(100) not null,filemimetype varchar(30),filecontent text(65534), primary key(stor_sess,path,filename),foreign key(stor_sess) references userlist(storage_session_id) on delete cascade on update cascade );
create table if not exists course_list(course_id int(10) primary key auto_increment ,cost int(15) default 0,course_displayed_name varchar(100) not null,course_desc text(8192),course_rate int(5),course_add_date datetime default now() , course_update_date datetime default now(),check(cost>=0));
create table if not exists supported_mime_type_list(
    mime_type varchar(50) primary key
);
create table if not exists course_detail_list(
    course_id int(10) not null,page int(10) not null,page_goal text(1024),page_instruct text(16384) not null,
    page_earn int(10) default 100,page_price int(10) not null default 0,req_mime_type varchar(50) not null,default_form varchar(8192), answer_form text(16384),
    primary key(course_id,page),check(page>=0 and page_price>=0 and page_earn>=0),
    foreign key(course_id) references course_list(course_id) on delete cascade on update cascade,
    foreign key(req_mime_type) references supported_mime_type_list(mime_type) on delete cascade on update cascade
);
create table if not exists user_registered_courses(loginprovider varchar(15) not null , id varchar(15) not null ,course_id int(10) not null,completed_pages_count int(10) default 0, modify_date datetime default now(),primary key(loginprovider,id,course_id), foreign key(loginprovider,id) references userlist(loginprovider,id) on delete cascade on update cascade,foreign key(course_id) references course_list(course_id) on delete cascade on update cascade);
create table if not exists notice_board(notice_id int(30) auto_increment primary key ,notice_title varchar(200),notice_content text(10240),added_by varchar(30),add_date datetime default now(),update_date datetime default now());
create table if not exists course_storage(
stor_sess varchar(255) not null,course_id int(10) not null,course_page int(10) not null,
passed int(1) not null default 0,
filemime varchar(30) not null,content text(16384)  ,
primary key(stor_sess,course_id,course_page),
check(course_page>=0 ),check(passed between 0 and 1),
foreign key(stor_sess) references userlist(storage_session_id) on delete cascade on update cascade,
foreign key(course_id) references course_list(course_id) on delete cascade on update cascade,
foreign key(filemime) references supported_mime_type_list(mime_type) on delete cascade on update cascade
);
/*
create table if not exists user_completed_course_list(
    loginprovider varchar(15) not null ,
 id varchar(15) not null,
 course_id int(10) not null,
 course_page int(10) not null,
 check (not exists(select cdl.* from course_detail_list as cdl where cdl.course_id=course_id and cdl.course_page=course_page) ),
 primary key(loginprovider,id,course_id,course_page),
  foreign key(loginprovider,id) references userlist(loginprovider,id) on delete cascade on update cascade,
foreign key(course_id) references course_list(course_id) on delete cascade on update cascade );
*/