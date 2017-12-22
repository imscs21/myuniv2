<!DOCTYPE <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
        {{--HTML::style('css/mainpage3.css')--}}
        {{HTML::style('css/userpage.css')}}
        {{HTML::style('css/nav_userpage.css')}}
        {{HTML::style('css/flex_layout.css')}}
        {{HTML::style('css/fluid_layout.css')}}
        {{HTML::style('css/show_hidden.css')}}
        {{HTML::style('css/snackbar.css')}}
    </head>
    <body ng-app="userApp" ng-controller="MainCtrl" data-ng-init="initApp()">
        <header>
            @include("mpgnav_userpage")
        </header>
        <section class="content-view flex-layout-md flex-layout-md-horizontal flex-layout-lg flex-layout-lg-horizontal flex-layout-xlg flex-layout-xlg-horizontal">
            <?php if( Session::has("logininfo") ){ ?>
            <div class="flex-item-md-lv1 flex-item-lg-lv1 flex-item-xlg-lv1 shopcart">
                <div class="shopcart-title">
                   <span class="material-icons" style="font-size:11pt;">account_circle</span> 내정보
				</div>
				<div class="user-icon-container">
					<img style="height:auto;width:100%;" src='{{Session::get("logininfo")["avatar"]}}'>
				</div>
                <section class="user-detail-container">
                    <table>
                        <tr>
                            <td width="35%">아이디</td>
                            <td width="65%"><%% userdata.login_info.id %%></td>
                        </tr>
                        <tr>
                            <td>인증경로</td>
                            <td><%% userdata.login_info.logined_by %%></td>
                        </tr>
                        <tr>
                            <td>최근 로그인된 시간</td>
                            <td><%% userdata.login_info.logined_at %%></td>
                        </tr>
                        <tr>
                            <td>잔여 코인</td>
                            <td><%% userdata.coin %%> 코인</td>
                        </tr>
                    </table>
                </section>
				<footer>
                    <div class="shopcart-controller">
                        <div class="flex-layout flex-layout-horizontal">
                            <button class="flex-item-lv1" ng-click="doLogout()"><span style="font-size:11pt;" class="material-icons">exit_to_app</span>
                            로그아웃
                            </button>
                            <!--
                            <button ng-disabled="shopcart.list.length<=0" ng-click="tryToPurchase()" class="flex-item-lv1">
                            <span style="font-size:11pt;" class="material-icons">payment</span>
                            구매하기
                            </button>
                            -->
                        </div>
                    </div>
                </footer>
            </div>
            <?php } ?>

            <div class="flex-item-md-lv2 flex-item-lg-lv3 flex-item-xlg-lv3 market-list-view" style="position:relative;height:100%;">
                <div ng-init="detailpopupshow=false" ng-show="detailpopupshow" class="detail-content-popup">
                    <article class="detail-content-container">
                        <header>
                            <span ng-click="detailpopupshow=!detailpopupshow" class="material-icons"  style="float:right;cursor:pointer;">close</span>
                           <%% detailview.title %%>
                        </header>
                        <section >
                            <table ng-show="detailview.title=='상세정보'">
                                <tr>
                                    <td width="35%">강의명</td>
                                    <td width="65%"><%% detailview.model.title %%></td>
                                </tr>
                                <tr>
                                    <td>상세설명</td>
                                    <td><%% detailview.model.desc %%></td>
                                </tr>
                                <tr>
                                    <td>강좌상태</td>
                                    <td><%% detailview.model.clear_all==true? '이수 완료':'이수완료되지 않음' %%></td>
                                </tr>
                                <tr>
                                    <td>이수 완료도</td>
                                    <td><progress value="<%% detailviewmodel.progress %%>" max="100"></progress></td>
                                </tr>
                                <tr>
                                    <td>상세설명</td>
                                    <td style="overflow-y:scroll;">
                                        <ul>
                                            <li ng-repeat="x in detailview.model.chapters"><%% x.page_title %%>(<%% x.passed?'완료':'' %%>)</li>
                                        </ul>
                                    </td>
                                </tr>
                                
                            </table>
                            <table ng-show="detailview.title=='강의듣기'">
                                <tr>
                                    <td width="35%">강의명</td>
                                    <td width="65%"><%% detailview.model.title %%></td>
                                </tr>
                                <tr>
                                    <td>상세설명</td>
                                    <td><%% detailview.model.desc %%></td>
                                </tr>
                                
                                <tr>
                                    <td>코스 리스트</td>
                                    <td style="overflow-y:scroll;">
                                        <ul>
                                            <li ng-repeat="x in detailview.model.chapters"><a href="" ng-click="goCodePage(x.chash)"><%% x.page_title %%>(<%% x.passed?'완료':'' %%>)</a></li>
                                        </ul>
                                    </td>
                                </tr>
                                
                            </table>
                        </section>
                        <footer>
                            <button  ng-show="detailview.title=='상세정보'" ng-disabled="!userdata.data_loaded" ng-click="addToCartInDetail(detailview.model)" class="footer-btn" style="float:right;">강의듣기</button>
                        </footer>
                    </article>
                </div>
                <div class="course-content-view-wrapper">
                    <div class="course-content-view-toolbar hidden-xsm hidden-sm">
                        <div class="course-content-view-toolbar-left-pad">
                            <div></div>
                        </div>
                        <div class="course-content-view-toolbar-container">
                            <button ng-click="refreshCourseList()" class="course-content-view-toolbar-button"><span class="material-icons">refresh</span>새로고침</button>
                        </div>
                        <div class="course-content-view-toolbar-right-pad">
                            <div></div>
                        </div>
                    </div>
                    <div class="course-content-view">
                        <div class="course-container">
                            <article ng-repeat="x in courselist" class=" course-item">
                                <header class="shopname">
                                    <label><%% x.title %%></label>
                                </header>
                                <div class="shopcont">
                                    <ul>
                                        <li ng-repeat="y in x.chapters"><%% y.page_title %%></li>
                                    </ul>
                                </div>
                                <footer>
                                    <div class="flex-layout flex-layout-horizontal">
                                    <button ng-click="viewDetailCourseContent(x)" class="flex-item-lv1"><span style="font-size:11pt;" class="material-icons">description</span>
                                    자세히보기
                                    </button>
                                    <button ng-disabled="!userdata.data_loaded" ng-click="viewCourseProgress(x)" class="flex-item-lv1"><span style="font-size:11pt;" class="material-icons">add_shopping_cart</span>
                                    강의듣기
                                    </button>
                                </div>
                                </footer>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <footer>
        <div id="snc" class="snackbar-container">
    <!--
    <div id="snb" class="snackbar" style="visibility: visible;">
    <p>
    test
    </p>
    </div>
    -->
    </div>
            <div style="position:relative;width:100%;height:inherit">
                 <button ng-click="refreshCourseList()" class="full-width-button-with-padding hidden-md hidden-lg hidden-xlg">정보 새로고침</button>

           </div>
        </footer>
        <form id="gocourse_form" action="./codepage" method="POST" hidden>
            <input id="gocourse_form_val" name="course" value="">
        </form>
        {{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js')}}        
        {{HTML::script('js/jquery-3.2.1.min.js')}}
        {{HTML::script('js/responsiveslides.min.js')}}
        {{HTML::script('js/snackbarutil.js')}}
        <script>
            
        </script>
        <script >
            var pureScope = this;
            var sampleApp = angular.module('userApp', [], function($interpolateProvider) {
                $interpolateProvider.startSymbol('<%%');
                $interpolateProvider.endSymbol('%%>');
            });
            sampleApp.controller('MainCtrl',['$scope','$sce','$http',function($scope,$sce,$http){
                $scope.ajaxRequest = function(all_param,successFunc,errorFunc){
                    $http(all_param).then(successFunc,errorFunc);
                };
                
                
                $scope.userdata = {coin:0,data_loaded:false,login_info:{id:"unknown",logined_by:"",logined_at:""}};
                 $scope.courselist = [];
                 $scope.detailview = {model:{},title:""};
                 $scope.popup={userinfo: {show:false}};
                <?php if( Session::has("logininfo") ){ ?>
                $scope.loadUserData =  function(mode_refresh){
                     var requestConfig = {method:"GET",
        url:"./user/api/all"};
                        $scope.ajaxRequest(requestConfig,function(resp){
                            var data = resp.data;
                            $scope.userdata.data_loaded = data.loaded;

                            if(data.loaded){
                                $scope.userdata.coin = data.coin;
                                $scope.userdata.login_info.id = data.id;
                                $scope.userdata.login_info.logined_by = data.logined_by;
                                $scope.userdata.login_info.logined_at = data.logined_at;
                                $scope.courselist = data.user_courses;
                                if(mode_refresh){
                                    pureScope.showSnackBar("새로고침 되었습니다");
                                }
                                console.log("user data load ok");
                            }
                            else{
                                $scope.userdata = {coin:0,data_loaded:false,login_info:{id:"unknown",logined_by:"",logined_at:""}};
                                $scope.courselist = [];
                                pureScope.showSnackBarWithManyIcons("error","유저 데이터 로드 실패");
                            }
                        },function(error){
                            $scope.userdata = {coin:0,data_loaded:false,login_info:{id:"unknown",logined_by:"",logined_at:""}};
                            $scope.courselist = [];
                            pureScope.showSnackBarWithManyIcons("error","유저 데이터 로드 오류");
                        });
                };
                <?php } ?>
                $scope.doLogout = function(){
                   window.location.href = "./logout";
                };
                $scope.refreshCourseList = function(){
                     <?php if( Session::has("logininfo") ){ ?>
                     $scope.loadUserData(true);
                    <?php } ?>
                };
                $scope.goCodePage = function(chash){
                    var form = document.getElementById("gocourse_form");
                    var ipt = document.getElementById("gocourse_form_val");
                    ipt.value = chash;

                    form.submit();
                };
                $scope.viewDetailCourseContent = function(data){
                    $scope.detailview.model = data;
                     $scope.detailview.title = "상세정보";
                    $scope.detailpopupshow = true;
                };
                $scope.viewCourseProgress = function(data){
                    $scope.detailview.model = data;
                     $scope.detailview.title = "강의듣기";
                     $scope.detailpopupshow = true;
                };
                $scope.addToCartInDetail = function(x){
                    $scope.viewCourseProgress(x);
                }
                $scope.initApp = function(){
                    <?php if( Session::has("logininfo") ){ ?>
                    $scope.loadUserData(false);
                    <?php } ?>
                }
            }]);
        </script>
    </body>
</html>