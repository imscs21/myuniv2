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

csv같은 일정한 규칙으로 작성된 데이터를 가져오고자 할때,
data 객체구조안에서 infile "file full path as virtual folder or file" [many opts]; 을 사용한다

infile의 옵션은 다음과 같고 옵션구분은 띄어쓰기로 구분하고 각각의 옵션은 [optattr]=[val] 의 형식으로 표현됨

| 옵션명 | 기능 | 값 타입| 옵션축약명 |
| --- | --- | --- | --- |
| delimiter | 불러올때 컬럼을 구분하는 문자를 따로 지시 | string | dlm |
| missover | 빈곳이 있으면 무시하고 끝까지 읽음 | 단순지시옵션 html의 disabled처럼 | |
| dsd | 구분자들 사이에 값이 없으면 손실된 값으로 가정하고 결측치로 처리 | 단순지시옵션 | |
| lrecl | 읽어들일 파일의 크기를 강제적으로 제한 | int | |
| firstobs | 데이터를 몇째줄(행) 부터 읽을 것인지 지시 | int | |