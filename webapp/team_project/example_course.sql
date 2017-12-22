INSERT INTO `supported_mime_type_list` (`mime_type`) VALUES
('application/javascript'),
('text/css'),
('text/html'),
('text/plain');
INSERT INTO `course_list` (`course_id`, `cost`, `course_displayed_name`, `course_desc`, `course_rate`, `course_add_date`, `course_update_date`) VALUES
(1, 50, 'HTML', 'This is HTML', NULL, '2017-11-16 12:56:18', '2017-11-16 12:56:18'),
(2, 500, 'Java Script', '자바스크립트', NULL, '2017-12-10 17:14:23', '2017-12-10 17:14:23');
INSERT INTO `course_detail_list` (`course_id`, `page`, `page_goal`, `page_instruct`, `page_earn`, `page_price`, `req_mime_type`, `default_form`, `answer_form`) VALUES
(1, 2, 'html title', 'Put Hello World letter', 50, 0, 'text/html', '<html><body></body></html>', '<html><body>Hello World!</body></html>'),
(1, 3, 'html lesson 2', 'Wrap Hello World with P tag', 70, 0, 'text/html', '<html>\r\n  <body>\r\n    Hello World!\r\n</body>\r\n</html>', '<html><body><p>Hello World!</p></body></html>'),
(2, 1, '자바스크립트 OT', '<pre><code class=\"js\">console.log(args)</code></pre> 함수를 사용해 Hello World를 출력하시오', 100, 0, 'application/javascript', '//use console.log function\r\n', 'console.log(\"Hello World\");');

INSERT INTO `course_detail_list` (`course_id`, `page`, `page_goal`, `page_instruct`, `page_earn`, `page_price`, `req_mime_type`, `default_form`, `answer_form`) VALUES
(1,1,'html struct','<h2>html</h2>
HTML은 화면의 레이아웃(뼈대) 를 구성합니다.
웹문서를 구성하는 기본 뼈대이다
hyper text markup language의 약자이다.
확장자는 .html로 끝난다.
기본적인 문법은 태그를 열고 닫는형식으로 구성된다. &lt;p&gt; &lt;/p&gt;
DOCTYPE은 웹표준의 필수 사항이면서 이 문서가 html문서이며 어떤 버젼을 사용했는지 알려주는 지표이다. 기본적으로 html 5에서는 &lt;!DOCTYPE HTML&gt;이라고 선언한다.
meta는 data에 대한 정보를 나타내는 태그이다. 그 html태그의 데이터정보를 나타낸다는 것으로 DOCTYPE과는 차이가 있다.
기본적으로 html은 &lt;head&gt; , &lt;body&gt;로 나누는데 head에는 부가적인 정보를 주고 body에는 주내용을 적어준다. 가독성을 위한 것이기 때문에 꼭 어디에 써야된다는 것은 없다.
semantic tag : html 코드의 정보를 좀 더 잘 표현하기 위해 구역을 나누는 태그로 구조의 의미를 부여한다.</br>
<h2>실습</h2><p>Hello World를 태그 &lt;p&gt; paragraph의 줄임말로 단락을 표현할때 사용합니다. 끝에 &lt;/p&gt;로 닫아 주어야 합니다.
 숫자가 작을 수록 큰 제목이다. p태그에 Hello World를 넣어서 작성하시오.</p>',50,0,'text/html',
'<html><body></body></html>','<html><body><p>Hello World!</p></body></html>'),
(1,2,'html h tag','<h2>html h tag</h2>
-&lt;h1&gt;~&lt;h6&gt; : 제목을 다는 태그로써 h1부터 h6까지 있다. 숫자가 작을 수록 큰 제목이다.</br>
<h2>실습</h2><p>Hello world 문장 6개를 각각 &lt;h1&gt;~&lt;h6&gt 태그로 wrapping 하시오</p>
',70,0,'text/html','<html><body></body></html>','<html><body><h1>Hello World</h1><h1>Hello World</h1><h2>Hello World</h2><h3>Hello World</h3><h4>Hello World</h4><h5>Hello World</h5><h6>Hello World</h6></body></html>'
)