<!DOCTYPE html>
<html>
<head>
@include("mobileview.init")
{{HTML::style('css/studypage2.css')}}
{{HTML::style('css/flex_layout.css')}}
{{HTML::style('css/fluid_layout.css')}}
{{HTML::style('css/show_hidden.css')}}
</head>
<body>
<header id="mheader" class="hidden-xsm hidden-sm">
<img src="https://images.google.com/images/branding/googleg/1x/googleg_standard_color_128dp.png" alt="logo image"/>
<h1>Jr. CHAP</h1>
</header>
@include("mpgnav")
<section class="flex-layout flex-layout-horizontal">
    <div id="leftcontent" class="flex-item-md-lv1 flex-item-lg-lv1 flex-item-xlg-lv1">
        <aside id="sdrbr">
            <div>목차</div>
            <div id="content">
            </div>
        </aside>
    </div>
    <div class="flex-item-md-lv3 flex-item-lg-lv3 flex-item-xlg-lv3 demo">
    abssdasdsdddd
    </div>
</section>
<script>
        if (typeof(window.pageYOffset) == 'number') {
			var getTop = function() {
				return window.pageYOffset;
			}
		} else if (typeof(document.documentElement.scrollTop) == 'number') {
			var getTop = function() {
				return Math.max(document.documentElement.scrollTop, document.body.scrollTop);
			}
		} else {
			var getTop = function() {
				return 0;
			}
		}
        function addEvent(obj, type, fn) {
			if (obj.addEventListener) {
				obj.addEventListener(type, fn, false);
			} else if (obj.attachEvent) {
				obj['e' + type + fn] = fn;
				obj[type + fn] = function() {
					obj['e' + type + fn](window.event);
				}
				obj.attachEvent('on' + type, obj[type + fn]);
			}
		}
        function move(contid){
            document.getElementById(contid).appendChild(document.getElementById("sdrbr"));
        }
        addEvent(window,"scroll",function(){
            var navbar = document.getElementById("navbar");
            if(window.matchMedia("(min-width:768px)").matches){
                var hdr = document.getElementById("mheader");
                if(getTop()<hdr.offsetHeight+hdr.clientHeight){
                    navbar.style.position = 'static';
                    navbar.style.top = "0px";
                }
                else{
                    navbar.style.position = 'absolute';
                    navbar.style.top=getTop()+"px";
                }
                move("leftcontent");
            }
            else{
                navbar.style.position="fixed";
                navbar.style.top = "0px";
                move("navaddtionalbar1");
            }
        });
</script>
</body>
</html>