설치법
==========
1. 라라벨 5.4를 설치한다 
    * 설치법은 하위 링크 참조: http://l5.appkr.kr/lessons/02-hello-laravel.html
2. 콘솔창에서 쉽게 쓰일 수 있도록 명령어 'php' 와 'composer'를 시스템 환경 변수에 등록한다
3.  clean.bat 파일을 실행한다.
4. '.env' 파일을 열고 DB_PORT 값을 사용자 컴퓨터에 맞게끔 바꾸어준다 
5. 또한 ./config/database.php 파일을 열어 mysql 부분의 port' => env('DB_PORT', ...  부분의 포트 번호를 사용자 컴퓨터에 맞게 수정한다
6. 다시한번 clean.bat를 실행한다
7.  (mysql의 특정 사용자를 추가하는 명령어가 포함된 initdb.sql) 과 inittable.sql 파일을 우리의 프로젝트환경에 맞게끔 db에 실행해 적용시켜준다 
8. 이 프로젝트 폴터를 htdocs같은 서버의 문서 폴터의 최상으로 옮긴다. 즉, htdocs/<프로젝트폴터이름> 같은 형태가 되어야한다
9. 서버의 http포트를 8888로 변경한다
10. 관리자 권한으로 (link.bat 이나 link.sh 이나 link_comp.sh)파일을 실행한다
11. 브라우저를 실행하고 http://127.0.0.1:8888/webproj 를 방문한다
11.  We don`t recommend url is http://localhost:8888 because of github oauth callback link which is static or manual link

## Our Project
    > 현재 오픈소스로 등록되어 있으며 at https://github.com/HYUeWebAppPROj 에서 보실 수 있습니다

## 오픈소스
* responsiveslides.js - MIT license
* jquery - MIT license
* AngularJS - MIT license
* Laravel - MIT license
* material-icons - Apache 2.0
