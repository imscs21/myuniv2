/*
name : Hwang se hyeon, ID: 2016004011, year: 2
*/
window.onload = function() {
	/* Create a 'div' element with id "orange" under the existing 'div' element with id "orangearea"
	 * The 'div' element with id "orange" should be : 
	 * 	- assigned an appropriate class (see CSS selectors in 'orange.css') to be visible inside the dotted box  
	 * 	- attached with the 'clickOrange' event-handler function that handles element's mouse click event
	 * 
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
	 */
	
	/* Afterh 0.5second, the Orange image should move to the next random position within the dotted box 
	 * 	- call 'moveOrange' function after 0.5 second
	 * 
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
	 */	
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
	var ch = runningbox.clientHeight || runningbox.getHeight();
	var cw = runningbox.clientWidth || runningbox.getWidth();
	var h = org.getHeight();
	var w = org.getWidth(); 
	var rx = randInt(0,cw-w);
	var ry = randInt(0,ch-h);
	
	org.style.left=rx+"px";
	org.style.top=ry+"px";
    
    
    
}