## SAS핵심기초 (~17.9.4)

> LIBNAME [name] "name path";  
> /* 일종의 c++의 namespace같은 놈으로 namespace기능을 할뿐만아니라 해당 wd 경로도 포함된다 */

data 구조 안의 input(즉, 변수혹은 헤더명)의 데이터 타입이 문자열이라면 반드시 해당하는 변수명을 넣은뒤 쓴 변수명 뒤에 '$'변수를 써줘야한다
>  input str_name $ int_name;  

해당 sas스크립트안에 run;이 없으면 실행 불가
> data [name];  
>       defs...  
> /* class혹은 struct와 유사함 */  
> /* libname이 정의되어있으면 data libname.clsname; 같은 형식으로도 선언가능 */  