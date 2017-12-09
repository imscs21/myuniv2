
function bigger_pimpin(){
  //alert("Hello ,World!");
  var obj = $("ta");
  //$("ta").style.fontSize="24pt";
  var val = obj.style.fontSize || "12pt";
    var valInt = parseInt(val,10)+2;
    //console.log(val + " ",valInt);
    obj.style.fontSize = valInt+"pt";
}
function bigger_pimin_continously(){
   isetInterval(bigger_pimpin,500);
}
//$("ta").value="Here is the sample text\nLet's see if the 'bigger pimpin`!` button works!"
function toggleBling(){
  console.log("called"+$("bling").checked);
    var obj = $("ta");
    if($("bling").checked){
    obj.style.fontWeight="bold";
    obj.style.color="green";
    obj.style.textDecoration = "underline";
    document.querySelector('body').style.backgroundImage="url('http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/8/hundred.jpg')";

  }else{
    obj.style.fontWeight="normal";
    obj.style.color="inherit";
    obj.style.textDecoration = "inherit";
    document.querySelector('body').style.backgroundImage="inherit";

  }
}
function Snoopify(){
  var obj = $("ta");
  var ori_value = obj.value;
  var lines = ori_value.split("\n");
  for(var i = 0;i<lines.length;i++){
    lines[i] = lines[i].toUpperCase();
  }
  var combine = lines.join("-izzle.");

  obj.value=combine;
}

function piglatin_inner(str){
  var vowels = ["a",'e','i','o','u'];
  var tmplen = vowels.length;
  for(var i=0;i<tmplen;i++){
    vowels.push(vowels[i].toUpperCase());
  }
  var etc = [];
  var idx = -1;
  for(var i=0;i<vowels.length;i++){

    var ix = str.indexOf(vowels[i])||-1;
    if(ix>=0){
      if(idx==-1){
        idx=ix;
      }
      else{
        idx = Math.min(idx,ix);
      }
    }
  }
  if(idx==-1){
    return str+"ay";
    //etc=str.split("");
  }
  else{
    var first = str.substring(0,idx);
    var second = str.substring(idx+1);
    return str[idx]+second+first+"ay";
  }
  //etc.reverse();
  //return etc.join("")+"ay";
}
function piglatin(){
  var obj = $("ta");
  var strs = obj.value.split(" ");
  var tmp = [];
  for(var i=0;i<strs.length;i++){
    tmp.push(piglatin_inner(strs[i]));
  }
  obj.value = tmp.join(" ");
}
function Malkovitch(){
  var obj = $("ta");
  var str = obj.value;
  var words = str.replace(/([^\s]{5,})/gm,"Malkovitch");
  obj.value=words;
}
window.onload = function(){
var btnobjs = document.getElementsByTagName("button");
for(var i =0;i<btnobjs.length;i++){
  var objs = btnobjs[i];
  if(objs!=null){
    if(objs.textContent=="Bigger Pimpin'!"){
      objs.addEventListener("click",bigger_pimin_continously);
    }
    else if(objs.textContent=="Snoopify"){
      objs.addEventListener("click",Snoopify);
    }
    else if(objs.textContent=="Igpay Atinlay"){
      objs.addEventListener("click",piglatin);
    }
    else if(objs.textContent=="Malkovitch"){
      objs.addEventListener("click",Malkovitch);
    }
  }
}
$("bling").addEventListener("change",toggleBling);
}
