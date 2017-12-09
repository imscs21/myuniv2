window.onload = function() {
    $("b_xml").onclick=function(){
      console.log("called");
      var cat = getCheckedRadio($$("input[name='category']"));
      new Ajax.Request("./books.php?category="+cat,{
        method:"GET",
        onSuccess:showBooks_XML,
        onFailure:ajaxFailed,
        onException:ajaxFailed
      });
    	    //construct a Prototype Ajax.request object
    }
    $("b_json").onclick=function(){
      var cat = getCheckedRadio($$("input[name='category']"));
      new Ajax.Request("./books_json.php?category="+cat,{
        method:"GET",
        onSuccess:showBooks_JSON,
        onFailure:ajaxFailed,
        onException:ajaxFailed
      });
    	    //construct a Prototype Ajax.request object
    }
};

function getCheckedRadio(radio_button){
	for (var i = 0; i < radio_button.length; i++) {
		if(radio_button[i].checked){
			return radio_button[i].value;
		}
	}
	return undefined;
}

function showBooks_XML(ajax) {
	alert(ajax.responseText);
  var eleroot = $("books");
  var ele = eleroot.firstChild;
  while(ele){
    eleroot.removeChild(ele);
    ele = eleroot.firstChild;
  }
  var xmlnodes = ajax.responseXML.firstChild;
  ele = xmlnodes.firstChild.nextSibling;
  while(ele){

    var title = ele.getElementsByTagName("title")[0].textContent;
    var author = ele.getElementsByTagName("author")[0].textContent;
    var year = ele.getElementsByTagName("year")[0].textContent;
    var str = title+", by "+author+" ("+year+")";
    var li = document.createElement("li");
    li.update(str);
    eleroot.appendChild(li);
    for(var k=0;k<2;k++)
    ele = ele.nextSibling;
  }
}

function showBooks_JSON(ajax) {
	alert(ajax.responseText);
  var eleroot = $("books");
  var ele = eleroot.firstChild;
  while(ele){
    eleroot.removeChild(ele);
    ele = eleroot.firstChild;
  }
  var json = JSON.parse(ajax.responseText);
  var bookdt = json.books;
  for(var i = 0;i<bookdt.length;i++){
    var book = bookdt[i];
    var title = book.title;
    var author = book.author;
    var year = book.year;
    var str = title+", by "+author+" ("+year+")";
    var li = document.createElement("li");
    li.update(str);
    eleroot.appendChild(li);
  }
}

function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText +
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}
