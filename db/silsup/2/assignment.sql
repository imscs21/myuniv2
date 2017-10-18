set echo off
SET FEEDBACK off
ttitle off
btitle off
set heading on
set pagesize 1000
prompt CREATE NEW EMPLOYEE RECORD
prompt
prompt Enter the employees information:
ACCEPT last_name char format A10 prompt 'Last Name:'
ACCEPT nemp number format '9999' prompt 'Employee #:'
ACCEPT salar number format '99999.99'  default 1000.00 prompt 'Salary [1000]:'
Accept commis number format '9999.99' default 0 prompt 'Commission % [0]:'
Accept hd  date format 'mm/dd/yyyy' prompt 'Hire date (mm/dd/yyyy):'

prompt List of available jobs:
select distinct job from emp order by job;
prompt
Accept job prompt 'Job:'

prompt List of department numbers and names:
select deptno,dname from dept order by deptno;
prompt
Accept deptn number prompt 'Department #:'
SET FEEDBACK on
set echo off
insert into emp(ename,empno,sal,comm,hiredate,job,deptno) values('&last_name', &nemp, &salar, &commis ,to_date('&hd','mm/dd/yyyy') ,'&job' ,&deptn);
SET FEEDBACK off
set echo on
select * from emp;