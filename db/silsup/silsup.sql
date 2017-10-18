create table  jack(
    name varchar2(30) not null,
    dept varchar2(40) not null,
    s_id number(11),
    sex varchar2(6) check(sex='Female' or sex='Male')
);
insert into jack values('Hwang sehyeon','Comp. Sci.',2016004011,'Male');
select * from jack;