/*
name : Hwang se hyeon, ID: 2016004011, year: 2
*/
window.onload = function() {
	/* Create a 'div' element with id "orange" under the existing 'div' element with id "orangearea"
	 * The 'div' element with id "orange" should be : 
	 * 	- assigned an appropriate class (see CSS selectors in 'orange.css') to be visible inside the dotted box  
	 * 	- attached with the 'clickOrange' event-handler function that handles element's mouse click event
	 * 
	 * 'orange.html'내에 "orangearea"라는 id를 가진 element에 아래에 'orange'라는 id를 가진 'div' element를 생성하시오
	 * 'orange'라는 id를 가진 'div' element에는 : 
	 * 	- 점선 박스안에 보여지기 위하여 ()'orange.css'에서 CSS Selector로 사용된 class 중) 적합한 class가 지정되어야 한다
	 * 	- 마우스 클릭 event를 처리하기 위하여 'clickOrange' event-handler function이 첨부되어야 한다
	 */
	var runningbox = $("orangearea");
	var orange = document.createElement("div");
	orange.id = "orange";
	orange.addClassName("inorangearea");
	orange.onclick=clickOrange;
    runningbox.appendChild(orange);
    
    
    
    moveOrange();
}

function clickOrange() {
	/* When user clicks the Orange image the background color of the image should turn red 
	 * 	- use 'this' here and do NOT use obtrusive styling!
	 * 
	 * 사용자가 Orange 이미지를 클릭하면 이미지의 바탕색이 빨간색으로 바뀌어야 한다
	 * 	- 'this'를 사용하고 obtrusive styling은 사용 금지! 
	 */
	
	/* Afterh 0.5second, the Orange image should move to the next random position within the dotted box 
	 * 	- call 'moveOrange' function after 0.5 second
	 * 
	 * 0.5초 이후, Orange 이미지는 점선 박스 안의 랜덤한 포지션으로 이동해야 한다
	 * 	- 0.5초 이후 'moveOrange' function을 부르시오
	 */
	
	 var clsnm = "highlight";
	var hl = this.hasClassName(clsnm);
	if(!hl){
		this.addClassName(clsnm);
	}
	setTimeout(moveOrange,500);
    
}

function moveOrange() {
	/* Remove the red background color of the Orange image and move the image to new postiion within the dotted box
	 *	- to set the new x / y position of the image obtrusive styling is allowed! (in this function only!)
	 * 	- hint: after generating random x / y position use 'Math.floor' function to round it down
	 * 
	 * Orange 이미지의 배경색을 없애고 점선 박스 안에 새로운 포지션으로 옮기시오
	 * 	- 이미지의 새로운 x / y 포지션을 지정하기 위해서 obtrusive styling의 사용을 허용한다 (이 함수 내에서만)
	 * 	- 힌트: 랜덤 x / y 포지션을 생성하였다면 'Math.floor' function을 사용하여 내림하시오
	 */	
	//var hl = this.hasClassName(clsnm);
	var clsnm = "highlight";
	var org = $("orange");
	var hl = org.hasClassName(clsnm);
	if(hl){
		org.removeClassName(clsnm);
	}
	var runningbox = $("orangearea");
	function randInt(start,end){
		
		if(start>end){
			return randInt(end,start);
		}
		else{
			var st = parseInt(start);
			var ed = parseInt(end);
			return ((parseInt(Math.floor(Math.random()*(st*ed+st+ed))))%(ed-st+1))+st;
		}
	}
	var ch = runningbox.clientHeight || runningbox.getHeight(); //runningbox.clientHeight;
	var cw = runningbox.clientWidth || runningbox.getWidth();//runningbox.clientWidth;
	var h = org.getHeight(); //org.clientHeight;
	var w = org.getWidth(); //org.clientWidth;
	var rx = randInt(0,cw-w);
	var ry = randInt(0,ch-h);
	
	org.style.left=rx+"px";
	org.style.top=ry+"px";
	/*
	console.log(org.style);
	
	console.log(org);
	console.log("chw: "+ch+"   "+cw);
	console.log("hw: "+h+"   "+w);
	console.log("rxy: "+rx+"   "+ry);
*/
    
    
    
}