function popup_course_list(){
            var popup1 = document.getElementById("course_popup");
            /*var popup_checker = document.getElementById("popup_chker");
            popup_checker.checked = !popup_checker.checked;
            if(popup_checker.checked){*/
                return popup1.classList.toggle("hidden");
                
            //}else{
               // popup1.classList.toggle("")
            //}
        }
 function showSnackBarWithManyIcons(msgicon,msg){
            var container = document.getElementById("snc");
            var ele = document.createElement("div");
            var p = document.createElement("p");

            ele.classList.add("snackbar");
            container.appendChild(ele);
            var span = document.createElement("span");
            span.classList.add("material-icons");
            span.textContent="done";
            span.style.verticalAlign="middle";
           p.appendChild(span);
            var newText = document.createTextNode(msg);
            p.appendChild(newText);
            //p.textContent = msg;
            ele.appendChild(p);
            ele.classList.add("snackbar-show");
            setTimeout(function(){
                ele.classList.remove("snackbar-show");
                container.removeChild(ele);
            },2500);
}
function showSnackBar(msg){
    showSnackBarWithManyIcons("done",msg);
}