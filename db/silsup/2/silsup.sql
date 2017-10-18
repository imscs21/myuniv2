SET ECHO OFF
set line 100
set pagesize 24
SET FEEDBACK OFF
ttitle EMPLOYEE-REPORT;
btitle Confidential;
column sal format $9999.00;
column ename format a8 heading NAME temp;
column deptno heading DEPARTMENT temp;
update emp set empno=7499 where ename='WADD';
update emp set empno=7499 where ename='ALIS';

select * from emp;