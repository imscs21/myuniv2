<!DOCTYPE <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlightjs-line-numbers.js/2.1.0/highlightjs-line-numbers.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    {{HTML::style('css/codepage.css')}}
    {{HTML::style('css/show_hidden.css')}}
    {{HTML::style('css/flex_layout.css')}}
    {{HTML::style('css/fluid_layout.css')}}
    {{HTML::style('css/hover_table.css')}}

</head>
<body ng-app="codingApp" ng-controller="MainCtrl">
    <input type="checkbox" id="popup_chker" hidden/>
    <input type="checkbox" id="dialogshow" hidden></input>
    <div class="dialogwindow" >
        <section >
            <header class="flex-layout">
                <div class="flex-item-lv1 dialog-title-bar" ><p>제출결과</p></div>
                <p class="dialog-button-close">
                <label for="dialogshow"><strong class="material-icons">close</strong></label>
                </p>
            </header>
            <article id="resultview" class="dialog-content-area y-scrollable flex-item-lv2  flex-layout-md flex-layout-md-horizontal flex-layout-lg flex-layout-lg-horizontal flex-layout-xlg flex-layout-xlg-horizontal">
                
                 <div class="demo flex-item-md-lv1 flex-item-lg-lv1  flex-item-xlg-lv1 " >
                <pre><code class="html" ng-bind="submitResult.code"></code></pre>
                 
                 </div>
                <div class="demo flex-item-md-lv1 result-status-container flex-item-lg-lv1 flex-item-xlg-lv1 flex-layout-xsm flex-layout-xsm-vertical flex-layout-sm flex-layout-sm-vertical flex-layout-md flex-layout-md-vertical flex-layout-lg flex-layout-lg-vertical flex-layout-xlg flex-layout-xlg-vertical">
                <iframe class="flex-item-lv1" style="width:100%" ng-src="<%% makeIframeData(submitResult.code) %%>"></iframe>
                <div class="flex-item-lv1" style="background-color:red;">

                <table class="result-user hover-row-table">
                    <tr>
                        <td>
                            성공 여부:
                        </td>
                        <td >
                            <%% submitResult.user.success?'성공!':'실패' %%>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            얻은 포인트:
                        </td>
                        <td>
                            <%% submitResult.user.earn %%>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            총 포인트:
                        </td>
                        <td >
                            <%% submitResult.user.point %%>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            이수완료까지: 
                        </td>
                        <td>
                            <div>
                                <progress value="<%% submitResult.user.progress %%>" max="100"></progress>
                            </div>
                        </td>
                    </tr>
                </table>
                
                </div>
                </div>
                
                
            </article>
            <footer>
            <button class="demo2" ng-click="goNext($event)" ng-disabled="(!submitResult.user.success)||(course_data.tmphash=='3248bc7547ce97b2a197b2a06cf7283d')" >다음</button>
            <button class="demo2" onclick="goMyPage()" ng-disabled="course_data.tmphash!='3248bc7547ce97b2a197b2a06cf7283d'" ng-show="submitResult.user.progress==100">완료하기</button>
            </footer>
        </section>
    </div>
    <nav>
        <input type="checkbox" id="mbtn" hidden></input>
        <div class="hidden-md hidden-lg hidden-xlg ">
        <!--
        <div class="flex-layout flex-layout-horizontal ">
        -->
            <p class=" mobile-menu-btn" ><label for="mbtn">≡</label></p>
            
            <div class="title-bar" ng-click="courseListPop()">
                <div>
                <p ><%% course_data.title %%></p>
                <p><span>&lt;</span></p>
                </div>
            </div>
            
        
        </div>
       
        <img class="menu-usr-icon" ng-click="popup.userinfo.show=!popup.userinfo.show" style="height:90%;padding:0px;border-radius:50%;cursor:pointer;" src='{{Session::get("logininfo")["avatar"]}}'>
                
            <div class="menu-container">
                <ul class="menu">
                    <li class="controller-in-drawer hidden-md hidden-lg hidden-xlg">
                    <div class="flex-layout flex-layout-horizontal">
                       <div class="flex-item-lv1 hoverable curptr">
                       <strong class="material-icons">arrow_back</strong>
                       </div>
                       <div class="flex-item-lv1 hoverable curptr">
                       <strong class="material-icons">home</strong>
                       </div>
                       <div class="flex-item-lv1 hoverable curptr">
                       <strong class="material-icons">refresh</strong>
                       </div>
                       <div class="flex-item-lv1 hoverable curptr">
                       <strong class="material-icons">person</strong>
                       </div>
                    </div>
                    </li>
                    <li id="back_page_btn" onclick="history.go(-2);" class="hoverable hidden-xsm hidden-sm">
                    <p style="padding-left:1vw;padding-right:1vw;"><span>&lt;</span> 되돌아가기   </p>
                    </li>
   
                    <li class="forceflex1 maintitle hidden-xsm hidden-sm">

                        <div class="title-bar" ng-click="courseListPop()">
                            <div>
                                <p ><%% course_data.title %%></p>
                                <p><span>&lt;</span></p>
                            </div>
                            
                        </div>
                    </li>
                </ul>
            </div>
          <!-- IMPORT POPUP:: BEGIN-->
         

        <div id="course_popup" class="msg hidden" >
        <div class="balloon">
          <div class="popup-course-content-layout flex-layout">
            <div style="flex:2 auto">
            <div class="course-list-card" ng-hide="popup.course.clst.length">
                들을수 있는 강의가 없음
            </div>
              <div class="course-list-card"  ng-repeat="row in popup.course.clst" ng-click="reqCPG($event)">
                <%% row.title %%>
                <input type="text" value="<%% row.chash %%>" hidden>
              </div>
            </div>
            <div class="vertical-divider">

            </div>
            <div style="flex:3;" >
                <div class="course-page-list-card" ng-hide="popup.course.cpglst.length">
                    해당 목록이 없음
                </div>

              <div class="course-page-list-card" ng-repeat="row in popup.course.cpglst" ng-click="goCoursePage($event)">
                <%% row.title %%>
                <input type="text" value="<%% row.chash %%>" hidden>
                <input type="text" value="<%% row.completed %%>" hidden>
              </div>
            </div>
          </div>
        </div>
      </div>
        <!-- IMPORT POPUP:: END --> 
        <!-- IMPORT POPUP2:: START-->
        <div class="msg2" ng-show="popup.userinfo.show">
            <div class="balloon2">
                <div class="balloon2-wrapper">
                    
                    <section class="user-info">
                    
                    </section>
                    
                    <footer class="flex-layout flex-layout-horizontal buttom-user-bar">
                        <div style="flex:1">
                           
                                <a href="./userpage"><p>내 정보/강의실</p></a>
                            
                        </div>
                        <div class="vertical-divider"></div>
                         <div style="flex:1">
                           
                                <a href="./logout"><p>로그아웃</p></a>
                            
                        </div>
                    </footer>
                </div>
            </div>
        </div>
        <!-- IMPORT POPUP2:: END -->
    </nav>
    <section class="contentarea flex-layout-md flex-layout-md-horizontal flex-layout-lg flex-layout-lg-horizontal flex-layout-xlg flex-layout-xlg-horizontal">
     
     <!--
     <div style="position:absolute;left:10%;z-index:50;"> <%% makeIframeData(editor.demodata) %%>
     </div>
     -->

        <input type="checkbox" id="mobile_ref_show"  checked hidden></input>
        <div class="mobile-ref-win demo flex-item-md-lv3 flex-item-lg-lv3  flex-item-xlg-lv3">
        <div class="coding-toolbar ">
        <p class="hidden-md hidden-lg hidden-xlg mobile-close-btn" style="cursor:pointer" onclick="viewInstruct()"><label style="cursor:pointer"><strong class="material-icons">close</strong></label></p>
            <div><p class="toolbar-p">지시사항 및 레퍼런스</p></div>
        </div>
        <div class="coding-block coding-instruct" ng-bind-html="rawtxt2tHtml(course_data.instruct)">
       
        </div> 
        </div>
        <div class="demo flex-item-md-lv9 flex-item-lg-lv9 flex-item-xlg-lv9" >
            <div class="coding-toolbar">
                <ul>
                    <li ng-click='saveCode()'><div><p><strong class="material-icons">save</strong></p></div></li>
                    <li ng-click='resetCode()'><div><p>코드 초기화</p></div></li>
                    <li ng-click='switchViewMode()'><div><p> <%% !editor.viewHTML? 'HTML로 보기':'Code로 보기' %%> </p></div></li>
                </ul>
            </div>
        <div class="coding-block" >
            <div class="coding-block-progress" ng-show="editor.commandOngoing">
              <div>
                <div class="loader" style="width:5em;height:5em;"></div>
                <p><%% editor.commandOngoingShortMsg %%></p>
              </div>  
              
            </div>
            <iframe class="<%% editor.viewHTML? '':'hidden' %%>" style="width:100%;height:100%;" ng-src="<%% makeIframeData(editor.demodata) %%>"></iframe>
            <div class="real-coding-block" ui-ace="{mode:'<%% coding.lang %%>',onChange:aceChanged}" ng-model="editor.demodata"></div>
            <!--<pre id="editor" style="height:100%;" >  </pre> -->
            </div>
        </div>
    </section>
    <div id="snc" class="snackbar-container">
    <!--
    <div id="snb" class="snackbar" style="visibility: visible;">
    <p>
    test
    </p>
    </div>
    -->
    </div>
    
    <footer>
    <button class="demo2" style="min-width:5em;" ng-click="codeSubmit()">제출</button>
        <div class="footer-toolbar-container">
            <p>
                <button class="footer-btn hidden-md hidden-lg hidden-xlg" onclick="viewInstruct()" id="toggle_instruct" >지시사항 닫기</button>
            </p>
        </div>
        
    </footer>
    {{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js')}}
    {{-- HTML::script('js/coding/aceeditor/src-noconflict/ace.js') --}}
    {{HTML::script('js/bower_components/ace-builds/src-min-noconflict/ace.js')}}
    {{HTML::script('js/bower_components/angular-ui-ace/ui-ace.js')}}
    <!--
    <script src="https://pc035860.github.io/angular-highlightjs/angular-highlightjs.min.js"></script>
    -->
    <script>
        function codeSubmit(){
            document.getElementById('dialogshow').checked = !document.getElementById('dialogshow').checked;
            document.getElementById('resultview').scrollTo(0,10);
        }
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
        function goMyPage(){
            if(!pageverticalover(document.getElementById('resultview'))){
            window.location.href = "./mypage";
            }
        }
        function pageverticalover(doc){
            var top  = doc.pageYOffset || doc.scrollTop,
            left = doc.pageXOffset || doc.scrollLeft;
            var height = doc.offsetHeight;
            var width = doc.offsetWidth;
            doc.scrollTo(left,top+height*0.4+10);
            var curtop  = doc.pageYOffset || doc.scrollTop;
            return (curtop>top);
        }
        function showSnackBar(msg){
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
        function viewInstruct(){
            var chk = document.getElementById("mobile_ref_show");
            var chked = chk.checked;
            chk.checked = !chk.checked;
            var btn = document.getElementById("toggle_instruct");
            
            if(chked){
                btn.innerHTML = "지시사항 보기";
            }
            else{
                btn.innerHTML = "지시사항 닫기";
            }
        }
        function move(contid,targetid){
            var cls = document.getElementById(targetid);
            cls.parentElement.removeChild(cls);
            document.getElementById(contid).appendChild(cls);
            console.log("working");
        }
        var mobile=  window.matchMedia("screen and (max-width:767px)");
        var pc = window.matchMedia("screen and (min-width:768px)");
        function onChangedToMobileMode(mediaQuery){
            move("mobilecs","courseselector");
        }
        function onChangedToPcMode(mediaQuery){
            move("csloc","courseselector");
        }
        hljs.initHighlightingOnLoad();
        hljs.initLineNumbersOnLoad();
    </script>
    <script>
    var pureScope = this;
     var sampleApp = angular.module('codingApp', ['ui.ace'/*,'hljs'*/], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%%');
        $interpolateProvider.endSymbol('%%>');
    });
    sampleApp.controller('MainCtrl',['$scope','$sce','$http',function($scope,$sce,$http){
    $scope.editor={demodata:"<html>\n<head><title>This is title</title></head>\n<body>\nHello world\n</body>\n</html>",
    viewHTML:false,
    commandOngoing:false,
    commandOngoingShortMsg:''
    };
    $scope.course_data={chash:"<?=$def_hash ?>",instruct:'unknown',tmphash:'',title:''};
    $scope.coding={lang:"html"};
    $scope.demo = {result_user:"result of user data"};
    $scope.submitResult = {code:"",user:{point:0,success:false,earn:0,progress:0}};
    $scope.popup = {course:{clst:[],cpglst:[]},userinfo:{show:false}};

    $scope.aceChanged = function(e){
        var editorobj = e[1];
        var session = editorobj.getSession();
        session.setMode("ace/mode/"+$scope.coding.lang);
    };
    $scope.rawtxt2tHtml = function(data){
        console.log("call rawtxt2tHtml with '"+data+"'");
        return $sce.trustAsHtml(data);
    };
    $scope.renderRawTagsFromStringWithoutSecurity=function(data){
        return data;
    }
    $scope.rawlink2tURL = function(url){
        return $sce.trustAsResourceUrl(url);
    };
    $scope.makeIframeData=function(data){
        return  $scope.rawlink2tURL("data: text/html, "+$sce.trustAsHtml(data));
    };
    $scope.switchViewMode = function(){
        $scope.editor.viewHTML = !$scope.editor.viewHTML;
    };
    $scope.goCoursePage = function($event){
        var self = $event.target;
        var hashvalue = self.getElementsByTagName("input")[0].value;
        $scope.course_data.chash = hashvalue;
        $scope.loadCode();
        $scope.courseListPop();
    };
    $scope.sendCode = function(param,cmd,successFunc,errorFunc){
         var lang = $scope.coding.lang;
         $http({
            method: 'POST' ,
            url: './codepage/api/'+lang+'/'+cmd,
            data: JSON.stringify( param),
            headers: {
                'Content-Type': 'application/json; charset=UTF-8'
            }
        }).then(successFunc,errorFunc);
    };
    
    $scope.saveCode = function(){
        var param = {   
            data: $scope.editor.demodata,
            course:$scope.course_data,
        };
        $scope.editor.commandOngoing=true;
        $scope.editor.commandOngoingShortMsg='저장중...';
         $scope.sendCode(param,'save',function(response) {
           // console.log(response);
            var dt = response.data;
            //console.log("result: \n"+JSON.stringify(dt));
            $scope.editor.commandOngoing=false;
            pureScope.showSnackBar("저장됨");
              $scope.editor.commandOngoingShortMsg="";
           // editor.demodata
             //$scope.submitResult.code = dt.result_data;
        },function (error){
            console.log(error);
            pureScope.showSnackBar("저장실패");
            $scope.editor.commandOngoing=false;
        });
    };
    $scope.courseListPop=function(){
        var appear = !pureScope.popup_course_list();
        if(appear){
             $http({
            method: 'GET' ,
            url: './codepage/user/course'
            }).then(
                function(resp){
                    var dt = resp.data.data;
                    $scope.popup.course.clst=dt;
                },
                function(err){
                    $scope.popup.course.clst=[];
                }
            );
        }
    }
    $scope.reqCPG = function($event){
       // console.log("called reqCPG");
        var self = $event.target;
        var hashvalue = self.getElementsByTagName("input")[0].value;
        $http({method:"GET",
        url:"./codepage/user/page/"+hashvalue}
        ).then(function(resp){
            $scope.popup.course.cpglst=resp.data.data;
        },function(err){
            $scope.popup.course.cpglst = [];
        });
    };
    $scope.codeSubmit=function(){
       // console.log("call codeSubmit");
        $scope.saveCode();
        pureScope.codeSubmit();
        var param = {   
            data: $scope.editor.demodata,
            course:$scope.course_data
        };
        var lang = $scope.coding.lang;
        $scope.sendCode(param,'submit',function(response) {
            console.log(response);
            var dt = response.data;
             $scope.submitResult.code = dt.result_data;
             console.log(dt);
             var userdt = dt.user;
             $scope.submitResult.user.earn =userdt.earn;
             $scope.submitResult.user.point =userdt.point;
             $scope.submitResult.user.success =userdt.success;
             $scope.submitResult.user.progress =userdt.progress;
             if(userdt.success){
                 $scope.course_data.tmphash = userdt.nextHash;
             }
        },function (error){
            $scope.submitResult.code='error';
            $scope.submitResult.user.point =0;
            $scope.submitResult.user.success =false;
            console.log(error);
   });

    };
    $scope.loadCode = function(){
         var param = {   
             data:'load',
            course:$scope.course_data,
        };
        $scope.editor.commandOngoing=true;
        $scope.editor.commandOngoingShortMsg="로딩중...";
         $scope.sendCode(param,'load',function(response) {
             console.log("====code load=====");
            console.log(response);
            var dt = response.data;
            document.getElementById("mobile_ref_show").checked = true;
           // console.log("load result: \n"+JSON.stringify(dt));
            if(dt.loaded){
            $scope.editor.demodata = dt.code_data;
            $scope.course_data.instruct = dt.code_instruct;
            $scope.coding.lang = dt.code_lang;
            $scope.editor.commandOngoing=false;
            $scope.course_data.title= dt.page_title;
            }else{
                $scope.editor.commandOngoing=false;
                alert('load error');
            }
             //$scope.submitResult.code = dt.result_data;
        },function (error){
            console.log(error);
        });
    }
    $scope.goNext = function($event){
        if(!pureScope.pageverticalover(document.getElementById("resultview"))){
            $scope.course_data.chash=$scope.course_data. tmphash;
            $scope.loadCode();
            pureScope.codeSubmit();
        }
    }
    $scope.resetCode = function(){
        var param = {   
            data:'reset',
            course:$scope.course_data,
        };
        $scope.editor.commandOngoing=true;
        $scope.editor.commandOngoingShortMsg="코드 리셋중...";
         $scope.sendCode(param,'reset',function(response) {
            console.log(response);
            var dt = response.data;
            if(dt.reset){
            $scope.editor.demodata = dt.code_data;
            pureScope.showSnackBar("리셋성공");
            }else{
                pureScope.showSnackBar("리셋실패");
               // alert('reset error');
            }
            $scope.editor.commandOngoing=false;
             //$scope.submitResult.code = dt.result_data;
        },function (error){
            console.log(error);
            pureScope.showSnackBar("리셋실패");
            $scope.editor.commandOngoing=false;
        });
    };
    $scope.loadCode();
     }]);
    </script>
</body>
</html>