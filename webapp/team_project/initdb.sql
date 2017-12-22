create database if not exists waproj character set utf8 collate utf8_general_ci;
use mysql;
CREATE USER 'webapp'@'localhost' IDENTIFIED BY 'hyuwebapp2016~2017~~~'; 
#공동 관리자 계정
CREATE USER  'webappro'@'localhost' IDENTIFIED BY 'waro';
 #읽기전용계정
CREATE USER  'webappuser'@'localhost' IDENTIFIED BY 'warw'; 
#사용자가요청하는작업을하는계정
revoke all on *.* from 'webappro'@'localhost';
revoke all on *.* from 'webappuser'@'localhost';
flush privileges;
grant all privileges on waproj.* to 'webapp'@'localhost' IDENTIFIED BY 'hyuwebapp2016~2017~~~';
grant SELECT, SHOW VIEW, INDEX  on waproj.* to 'webappro'@'localhost' IDENTIFIED BY 'waro';
grant SELECT, INSERT, UPDATE, DROP  on waproj.* to 'webappuser'@'localhost' IDENTIFIED BY 'warw';
flush privileges;
use waproj;
#mysql의 커멘드에 접속후 오른쪽 따옴표 사이에 있는 커멘트 실행 "source <sql파일의 절대경로>" 혹은 "\. <sql파일의 절대경로>"
#위의 커멘드가 제대로 적용안되면 1줄씩 수동적용
