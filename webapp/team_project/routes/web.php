<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PHPHtmlParser\Dom;
$navitem = array(array("title"=>"내정보","link"=>"./userpage"),array("title"=>"내 강의실","link"=>"./codepage"),array("title"=>"마켓","link"=>"./marketpage2"));

$_ENV['navitem']=$navitem;
Route::get('/', function () {
    return redirect('/mainpage3');
    //return view('welcome');
});
Route::get('/mainpage',function(){
    return View::make("mainpage")->with("imgpath","images/mainpage");
});
Route::get('/mainpage2',function(){
    #$navitem = array(array("title"=>"html","link"=>"#"),array("title"=>"css","link"=>"#"),array("title"=>"js","link"=>"#"),array("title"=>"내정보","link"=>"#"),array("title"=>"live 코딩","link"=>"#"));
    $msg = Session::get('injectionMainPageScript1',null);
    
    $mView = View::make("mainpage2")->with("imgpath","images/mainpage")->with("navitems",$_ENV['navitem'])->with("injectionJsMsg",$msg);
    Session::forget('injectionMainPageScript1');
    return $mView;
});
Route::get('/mainpage3',function(){
    #$navitem = array(array("title"=>"html","link"=>"#"),array("title"=>"css","link"=>"#"),array("title"=>"js","link"=>"#"),array("title"=>"내정보","link"=>"#"),array("title"=>"live 코딩","link"=>"#"));
    $msg = Session::get('injectionMainPageScript1',null);
    
    $mView = View::make("mainpage3")->with("imgpath","images/mainpage3")->with("navitems",$_ENV['navitem'])->with("injectionJsMsg",$msg);
    Session::forget('injectionMainPageScript1');
    return $mView;
});
Route::post('/login/normal',function(){
    $id = Input::get('loginid', null);
    $pw = Input::get('loginpw', null);
    if($id!=null && $pw !=null && $id==="adminHYU123" && $pw ==="@HYUeWebAppPROj"){
        $li = array();
        $li["loginsession"] = Session::getId();
        $li["name"] = $id;
        $li["realname"] = "admin";
        $li["numid"] = 123456789;
        $li["email"] = "unknown";
        $li["avatar"] = "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Microsoft_Account.svg/768px-Microsoft_Account.svg.png";
        $li["loginprovider"] = "normal";
        Session::put("logininfo",$li);
    }
    //return "data:{$id}\n<br>{$pw}";
    return redirect('/mainpage3');
});
Route::get("/login/github",function(){
    return Socialite::with('github')->redirect();
});
Route::get("/marketpage2",function(){
    return View::make("marketpage2")->with("imgpath","images/marketpage")->with("navitems",$_ENV['navitem']);
});
Route::get("/login/github/callback",function(){
    $user = Socialite::with('github')->stateless()->user();
    $li = array();
    $li["loginsession"] = $user->token;
    $li["name"] = $user->getNickname();
    $li["realname"] = $user->getName();
    $li["numid"] = $user->getId();
    $li["email"] = $user->getEmail();
    $li["avatar"] = $user->getAvatar();
    $li["loginprovider"] = "github";
    try{
        DB::table("userlist")->insert(["loginprovider"=>"github","id"=>$li["name"],"storage_session_id"=>DB::raw("concat(sha2('github".$li["name"]."',512),md5(now()))")]);
    //DB::insert("insert into userlist(loginprovider,id,storage_session_id) values(?,?,concat(sha2(?,512),md5(now())));",array("github",$li["name"],"github".$li["name"]));
    }catch(Exception $e){ }
    DB::table("userlist")->where([["loginprovider",'=',"github"],["id",'=',$li["name"]]])->update(["lastest_logined_date"=>DB::raw("now()")]);
    //DB::update("update userlist set lastest_logined_date=now() where loginprovider='github' and id=?",array($li["name"]));
    $id = $li["name"];
    $id_provider = $li["loginprovider"];
    $stor_sess = DB::table("userlist")->where([['id','=',$id],['loginprovider','=',$id_provider]])->select("storage_session_id as ssi")->get()->first()->ssi;
    $li["storage_session"]=$stor_sess;
    Session::put("logininfo",$li);
    return redirect('/mainpage3');
    //dd($user);
});
Route::get("/logout",function(){
    Session::flush();
    return redirect('/mainpage3');
});
Route::get('/studypage',function(){
    $ver = (int)Input::input('ver', 1);
    return $ver===1?View::make("studypage")->with("imgpath","images/studypage"):View::make("studypage2")->with("navitems",$_ENV['navitem']);
});
Route::any('/marketpage', function () {
    return View::make("marketpage")->with("navitems",$_ENV['navitem']);
    //return View::make("test")->with("msg","Hi!, Admin3.");
});
Route::post('/marketpage/purchased', function () {
    $var = Input::get('recheck');
    return $var;
    //return redirect('/marketpage');
    //return View::make("test")->with("msg","Hi!, Admin3.");
});
Route::post('/marketpage/purchasepage', function () {
    return View::make("purchasepage")->with("navitems",$_ENV['navitem']);
    //return View::make("test")->with("msg","Hi!, Admin3.");
});
Route::get('/test', function () {

    //return View::make("sampleresponsive")->with("navitems",$_ENV['navitem']);
    
    return View::make("test")->with("msg","Hi!, Admin3.");
});
Route::any('/codepage', function (Request $req) {
    //putLoginErrorMessage();
    if(Session::has('logininfo')){

        Session::put('injectionMainPageScript1','');
        $id = Session::get('logininfo')['name'];
        $id_provider = Session::get('logininfo')['loginprovider'];
       /* 
        $lst = DB::table('user_registered_courses')->join('course_list','user_registered_courses.course_id','=','course_list.course_id')
        ->where([['loginprovider','=',$id_provider],['id','=',$id]])
        ->select('course_displayed_name as cdn')->get();
        $list = array();
        foreach($lst as $row){
            array_push($list,$row->cdn);
        }*/
        $default_hash = "7f5fca7da07c24c94d05fdcbbb54d77e";
        if($req->isMethod('post')||$req->isMethod('POST')){
            //var_dump($req);
            //echo "<br>\n";
            $key = 'course';
            if($req->has($key)){
                $chash = $req->input($key);
                $default_hash = $chash;
            }
        }
        return View::make("codepage")->with("navitems",$_ENV['navitem'])->with("def_hash",$default_hash);
    }
    else {
        Session::put('injectionMainPageScript1','alert("로그인 해주세요");');
        return redirect('/mainpage3');
    }
    //return View::make("test")->with("msg","Hi!, Admin3.");
});
Route::get('/codepage/user/{mode}/{chash?}',function($mode,$chash=""){
    $rst = array();
    $rst_dt = array();
    if(Session::has('logininfo')
    &&isset(Session::get('logininfo')['name'])&&isset(Session::get('logininfo')['loginprovider'])){
        $id = Session::get('logininfo')['name'];
        $id_provider = Session::get('logininfo')['loginprovider'];
        $stor_sess = Session::get('logininfo')['storage_session'];
        function HashreOrder($mHash){
            $str = $mHash;
            $mLen = strlen($str);
            for($i=1;$i<(int)($mLen/2);$i++){
                $tmp = $str[$i];
                $str[$i] = $str[$mLen-1-$i];
                $str[$mLen-1-$i]=$tmp;
                
            }
            return $str;
        }
        if($mode==="page"){
            $isFound = False;
            $cid = 0;
            $cdn = "";
            $tbl_name = 'user_registered_courses';
            $qry = DB::table($tbl_name)->join('course_list',"{$tbl_name}.course_id",'=','course_list.course_id')->where([['id','=',$id],['loginprovider','=',$id_provider]])->select("{$tbl_name}.course_id","course_list.course_displayed_name as cdn")->get();
            
            $chash = HashreOrder($chash);
            foreach($qry as $row){
                $tcid = $row->course_id;
                $tcdn = $row->cdn;
                $hash = md5("course_hash::".$id."qwerty123".$tcid.$tcdn);
                if($chash===$hash){
                    $isFound = True;
                    $cid = $tcid;
                    $cdn = $tcdn;
                    break;
                }
            }
            
            function encodeCourseHash($cid,$cpg){
                $rst = "error";
                $qry = DB::table("course_detail_list")->where([["page",'=',$cpg],[ "course_id",'=',$cid]])->count();
                if($qry>0){
                    $rst = md5($cpg.".".$cid);
                }
                return HashreOrder($rst);
            }
            function decodeCourseHash($mHash){
                
                $mHashVal = HashreOrder($mHash);
                $rst = array();
                $rst['id'] = -1;
                $rst['page'] = -1;
                //$ssid = getSSID($id,$id_provider);
                $qry = DB::table("course_detail_list")->select("page" ,"course_id as ci")->get();
                foreach($qry as $row){
                    if(md5($row->page.".".$row->ci)===$mHashVal){
                        $rst['id'] = $row->ci;
                        $rst['page'] = $row->page;
                        break;
                    }
                }
                return $rst;
            }
            if($isFound){

                $qry = DB::table("course_detail_list")->where([['course_id','=',$cid]])->orderBy('page','asc')->get();
                foreach($qry as $row){
                    $tmp = array();
                    $title = $row->page_goal;
                    $cpg = $row->page;
                    $hash = encodeCourseHash($cid,$cpg);
                    $subqry = DB::table("course_storage")->where([['stor_sess','=',$stor_sess],['course_id','=',$cid]]);
                    if($subqry->count()){
                        $tmp["completed"] = $subqry->get()->first()->passed==1?true:false;
                    }
                    else{
                        $tmp["completed"]= false;
                    }
                    $tmp["chash"]=$hash;
                    $tmp["title"]=$title;

                    array_push($rst_dt,$tmp);
                }
                


            }
        }
        else{
            $tbl_name = 'user_registered_courses';
            $qry = DB::table($tbl_name)->join('course_list',"{$tbl_name}.course_id",'=','course_list.course_id')->where([['id','=',$id],['loginprovider','=',$id_provider]])->select("{$tbl_name}.course_id","course_list.course_displayed_name as cdn")->get();
            foreach($qry as $row){
                $cid = $row->course_id;
                $cdn = $row->cdn;
                $hash = HashreOrder(md5("course_hash::".$id."qwerty123".$cid.$cdn));
                $tmp = array();
                $tmp["chash"]=$hash;
                $tmp["title"]=$cdn;

                array_push($rst_dt,$tmp);
            }
        }
    }
    else{
        $rst["msg"]="some of session value is null";
    }
    $rst["data"]=$rst_dt;
    return Response::json($rst);
})->where(['mode'=>'^(course|page)$','chash'=>'^(([a-f1-9])([a-f0-9]{31}))$']);
Route::get("/userpage",function(){
    return View::make("userpage")->with("imgpath","images/marketpage")->with("navitems",$_ENV['navitem']);
});
Route::post('/codepage/api/{lang}/{api_mode}',function(Request $req,$lang,$api_mode){
    $ipt = $req->json()->all();
    $rst = array();
    if(Session::has('logininfo')
    &&isset(Session::get('logininfo')['name'])&&isset(Session::get('logininfo')['loginprovider'])
    &&isset($ipt['data'])){
        $id = Session::get('logininfo')['name'];
        $id_provider = Session::get('logininfo')['loginprovider'];
        function getSSID($id,$id_provider){
            $storage_session_id = DB::table('userlist')->where([['id','=',"$id"],['loginprovider','=',"$id_provider"]])->select('storage_session_id as ssid')->get()->first();
            $ssid = $storage_session_id->ssid;
            return $ssid;
        }
        function user_storage_check_or_create($id,$id_provider,$course_id,$course_page){
            $chk = DB::table('user_registered_courses')->where([['loginprovider','=',$id_provider],['id','=',$id],['course_id','=',$course_id]])->count();
            if($chk){
            $storage_session_id = DB::table('userlist')->where([['id','=',"$id"],['loginprovider','=',"$id_provider"]])->select('storage_session_id as ssid')->get()->first();
             $ssid = $storage_session_id->ssid;
             //$rst['full_log']=$ssid;
             $qry = DB::table('course_storage')->where([['stor_sess','=',$ssid],['course_id','=',$course_id],['course_page','=',$course_page]]);
             
             if($qry->count()){
                return 0;
             }
             else{
                $qry = DB::table('course_detail_list')->where([['course_id','=',$course_id],['page','=',$course_page]]);
                 if($qry->count()){
                    $default_form = $qry->select("default_form as df")->get()->first()->df;
                    $req_mime = $qry->select("req_mime_type as rmt")->get()->first()->rmt;
                    DB::table('course_storage')->insert(['content' => $default_form,'filemime' => $req_mime,'course_page' => $course_page, 'stor_sess' => $ssid, 'course_id' => $course_id]);
                    return 1;
                 }
             }
            }
            return -1;
        }
        function HashreOrder($mHash){
            $str = $mHash;
            $mLen = strlen($str);
            for($i=1;$i<(int)($mLen/2);$i++){
                $tmp = $str[$i];
                $str[$i] = $str[$mLen-1-$i];
                $str[$mLen-1-$i]=$tmp;
                
            }
            return $str;
        }
        function encodeCourseHash($cid,$cpg){
            $rst = "error";
            $qry = DB::table("course_detail_list")->where([["page",'=',$cpg],[ "course_id",'=',$cid]])->count();
            if($qry>0){
                $rst = md5($cpg.".".$cid);
            }
            return HashreOrder($rst);
        }
        function decodeCourseHash($mHash){
            
            $mHashVal = HashreOrder($mHash);
            $rst = array();
            $rst['id'] = -1;
            $rst['page'] = -1;
            //$ssid = getSSID($id,$id_provider);
            $qry = DB::table("course_detail_list")->select("page" ,"course_id as ci")->get();
            foreach($qry as $row){
                if(md5($row->page.".".$row->ci)===$mHashVal){
                    $rst['id'] = $row->ci;
                    $rst['page'] = $row->page;
                    break;
                }
            }
            return $rst;
        }
        function isUserRegistered($id,$idp,$course_id){
            return DB::table('user_registered_courses')->where([['loginprovider','=',$idp],['id','=',$id],['course_id','=',$course_id]])->count()>0;
        }
        $u_sess_id = Session::get('logininfo')['storage_session'];
    if($api_mode=='submit'){
        $data = $ipt['data'];
        $cchash = $ipt['course']['chash'];
        $ttttmp = decodeCourseHash($cchash);
        $course_id = $ttttmp['id']; #$ipt['course']['id'];
        $course_page = $ttttmp['page'];#$ipt['course']['page'];
        if($course_id==-1 && $course_page==-1){
            $rst['data']=array();
            return Response::json($rst);
        }
            $answer_form = DB::table('course_detail_list')->where([['course_id','=',$course_id],['page','=',$course_page]])->select('answer_form as af')->get()->first()->af;
            $success=false;

            if($lang=="html"){
                function removeScripts($dom){
                    $scripts = $dom->getElementsByTagName("script");
                    if(!empty($scripts)){
                        foreach($scripts as $scr){
                            $scr->parentNode->removeChild($scr);
                        }
                    }
                    return $dom;
                }
                $ans_dom = new DOMDocument();
                $ans_dom->loadHTML($answer_form);
                $ans_dom = removeScripts($ans_dom);
                $dom = new DomDocument();
                $dom->loadHTML($data);
                $dom = removeScripts($dom);
                
               function trav($root){
                    $tmp = array();   
                    $tmp['child']=array();
                    
                    if($root!=null){
                        $tmp['original_cls']=$root;
                        $tmp['tag']=$root->nodeName;
                        $attrs = array();
                        if(!empty($root->attributes)){
                            foreach($root->attributes as $k => $v){
                                $attrs[$k] = $v->value;
                            }
                        }
                        $tmp['attrs']=$attrs;
                        $tmp['text']=trim($root->textContent);
                        if(!empty($root->childNodes))
                            foreach($root->childNodes as $nd){
                                $ch = trav($nd);
                                if($ch['tag']=='#text' && (trim($ch['text'])==""||trim($ch['text'])==null)){

                                }else
                                array_push($tmp['child'],trav($nd));
                            }
                        
                   }
                    return $tmp;
               }
               $ans_tree = trav($ans_dom->getElementsByTagName('html')[0]);
               $tree = trav($dom->getElementsByTagName('html')[0]);
               $tree['hash'] =  $ttttmp;
               $rst['dump']=$tree;
               $rst['ans_dump']=$ans_tree;
               function attributeCheck($ans_attrs,$attrs){
                $ans_original_cnt = count($ans_attrs);
                $attr_cnt = count($attrs);
                $tmp_cnt = 0;
                
                foreach($ans_attrs as $ans_key=>$ans_attr){
                    if(isset($attrs[$ans_key])){
                        
                    if($attrs[$ans_key]===$ans_attr){
                        $tmp_cnt++;
                    }
                    else if($ans_key=='class'||$ans_key=='style'){
                        $exp = "((\s|\n)+)";
                        $expres = "/(".$exp.")/";
                        $tmp = implode($exp,
                        explode(" ",preg_replace($expres," ",$ans_attr))
                    );
                        if(preg_match("/(".$tmp.")/",$attrs[$ans_key])){
                            $tmp_cnt++;
                        }
                    }
                    }
                }
                return $ans_original_cnt==$tmp_cnt;
            }

               function check_answer_inner($usr,$ans){
                    $attrchk =  attributeCheck($usr['attrs'],$ans['attrs']);
                    $tagnamechk = $usr['tag']===$ans['tag'];
                    $textchk = $usr['text']===$ans['text'];
                    $childcntchk = count($usr['child'])===count($ans['child']);
                    $childtagnamechk = false;
                    if($childcntchk){
                        $cnt = count($usr['child']);
                        $tagcnt = 0;
                        for($i=0;$i<$cnt;$i++){
                            $tagcnt += $usr['child'][$i]['tag']===$ans['child'][$i]['tag']?1:0;
                        }
                        $childtagnamechk= $cnt===$tagcnt;
                    }
                    return $attrchk&&$tagnamechk&&$textchk&&$childcntchk&&$childtagnamechk?1:0;
               }
               function check_answer($usr,$ans){
                   $rst = array();
                   $rst['cnt']=0;
                   $rst['ori_cnt']=check_answer_inner($usr,$ans);
                   $rst['cnt']=$rst['ori_cnt'];
                   $rst['childans']=array();
                    foreach($ans['child'] as $ch){
                        $tmp2 = check_answer($ch,$usr);
                        $rst['cnt']+=$tmp2['cnt'];
                        array_push($rst['childans'],$tmp2);
                    }
                    return $rst;
               }
               //$rst['answer_log']=check_answer($tree,$ans_tree);
               $ca = check_answer($tree,$ans_tree);
               function countNode($node){
                    $rst = 0;
                    if($node!=null&&$node!==null){
                        $rst = 1;
                        foreach($node['child'] as $child){
                            $rst =$rst+ countNode($child);
                        }
                    }
                    return $rst;
                }
                $success= countNode($ans_tree)<=$ca['cnt'];
                $dom = removeScripts($dom);
                $rst["result_data"] = $dom->saveHTML();
        }//end if lang=html
            
            $earn = DB::table('course_detail_list')->where([['course_id','=',$course_id],['page','=',$course_page]])->select('page_earn as pe')->get()->first()->pe;
            if($success){
                $storage_session_id = DB::table('userlist')->where([['id','=',"$id"],['loginprovider','=',"$id_provider"]])->select('storage_session_id as ssid')->get()->first();
                // $chk = DB::table('user_registered_courses')->where([['loginprovider','=',$id_provider],['id','=',$id],['course_id','=',$course_id]])->count();
                 $ssid = $storage_session_id->ssid;
                 //$rst['full_log']=$ssid;
                 $tmp = DB::table('course_storage')->where([['stor_sess','=',$ssid],['course_id','=',$course_id],['course_page','=',$course_page]]);
                
                 $qry = $tmp->select("passed as p")->get()->first()->p;
                 if(!$tmp->count()){
                     user_storage_check_or_create($id,$id_provider,$course_id,$course_page);
                  }
                if($qry>0){
                    $earn=0;
                 }
                else{
                    DB::table('userlist')->where([['loginprovider','=',$id_provider],['id','=',$id]])->increment('virtual_coin', $earn);//->update(['virtual_coin'=>'' ]);
                    DB::table('course_storage')->where([['stor_sess','=',$ssid],['course_id','=',$course_id],['course_page','=',$course_page]])->update(['passed'=>1 ]);
                    //DB::update('update userlists set virtual_coin=virtual_coin+? where loginprovider=? and id=?',$earn,$id_provider,$id);
                    //DB::update('update course_storage set passed=1 where stor_sess=? and course_id=? and course_page=?',$ssid,$course_id,$course_page);
                }
            }
            $usertotalPoint = DB::table('userlist')->where([['id','=',$id],['loginprovider','=',$id_provider]])->select('virtual_coin as vc')->get()->first()->vc;
            //$hrdom = new DOMDocument();
            //$hrdom->loadHTML($dom->outerHtml);
            
           
            $user_status = array();
            $user_status["success"] = $success;
            $user_status["point"] = $usertotalPoint;
            $user_status["earn"] = $success? $earn:0;
            
           
            $tot_course_pg = DB::table('course_detail_list')->where([['course_id','=',$course_id]])->count();
            $stor_sess = Session::get("logininfo")['storage_session'];
            $usr_course_pg = DB::table('course_storage')->where([['stor_sess','=',$stor_sess],['course_id','=',$course_id],['passed','=',1]])->count();
            $user_status["progress"]=$tot_course_pg?$usr_course_pg>=$tot_course_pg?100:($usr_course_pg/$tot_course_pg)*100:0;
            $hasPureNext = false;
            $hasNext=false;
            $nhash =md5("maelong~");
            $hasPureNext =    DB::table("course_detail_list")->where([['course_id','=',$course_id],['page','=',($course_page+1)]])->count()>0;
            if($hasPureNext){
                $course_page +=1;
                $nhash = encodeCourseHash($course_id,$course_page);
            }
            else{
                if(isUserRegistered($id,$id_provider,$course_id)){
                    $qry = DB::table("course_detail_list as cdl")
                    ->leftJoin(DB::raw("(select course_id,course_page,passed from course_storage where stor_sess='{$u_sess_id}') as cs"),function($join){
                        $join->on('cdl.course_id','=','cs.course_id');
                        $join->on("cdl.page",'=','cs.course_page');
                    })->select("cdl.course_id as cid","cdl.page as pg","cs.course_page as cpg","cs.passed as p")
                    ->orderBy('pg')->get();
                    $ttmp = array();
                    $regenRst = array();
                    foreach($qry as $v){
                        if(!$v->p){
                            array_push($regenRst,$v);
                        }
                    }
                    if(!empty($regenRst)){
                        $nhash = encodeCourseHash($regenRst[0]->cid,$regenRst[0]->pg);
                    }
                    else{
                        $nhash=md5("finish");
                    }
                }
               // $rst['qrycnt']=$ttmp;
            }
            
            $user_status["nextHash"] = $success?$nhash:md5("maelong~");
            $rst["user"]=$user_status;
        //}
    }
    else if($api_mode=='save'){
        $data = $ipt['data'];
        $cchash = $ipt['course']['chash'];
        $ttttmp = decodeCourseHash($cchash);
        $course_id = $ttttmp['id']; #$ipt['course']['id'];
        $course_page = $ttttmp['page'];#$ipt['course']['page'];
        $chk = DB::table('user_registered_courses')->where([['loginprovider','=',"$id_provider"],['id','=',"$id"],['course_id','=',$course_id]])->count();
       
        if($chk>0){
            $storage_session_id = DB::table('userlist')->where([['id','=',"$id"],['loginprovider','=',"$id_provider"]])->select('storage_session_id as ssid')->get()->first();
           // $chk = DB::table('user_registered_courses')->where([['loginprovider','=',$id_provider],['id','=',$id],['course_id','=',$course_id]])->count();
            $ssid = $storage_session_id->ssid;
            $qry = DB::table('course_storage')->where([['stor_sess','=',$ssid],['course_id','=',$course_id],['course_page','=',$course_page]]);
            if(!$qry->count()){
                $c_id = $course_id;
                $default_form = DB::table('course_detail_list')->where([['course_id','=',$course_id],['page','=',$course_page]])->select('default_form as df')->get()->first()->df;
                 $file_mime =    DB::table('course_detail_list')->where([['course_id','=',$course_id],['page','=',$course_page]])->select('req_mime_type as rmt')->get()->first()->rmt;
               
                DB::table('course_storage')->insert(['filemime'=>$file_mime,'course_id'=>$c_id,'course_page'=>$course_page,'content'=>$default_form,'stor_sess'=>$ssid]);
            
            }
             DB::table('course_storage')->where([['stor_sess','=',$ssid],['course_id','=',$course_id],['course_page','=',$course_page]])->update(['content'=>$data ]);
             $rst['saved']=true;

        }
        else
{ 
            $rst['saved']=false;
        }
        
    }
    else if($api_mode=='reset'){
        $data = $ipt['data'];
        $cchash = $ipt['course']['chash'];
        $ttttmp = decodeCourseHash($cchash);
        $course_id = $ttttmp['id']; #$ipt['course']['id'];
        $course_page = $ttttmp['page'];#$ipt['course']['page'];
        $chk = DB::table('user_registered_courses')->where([['loginprovider','=',"$id_provider"],['id','=',"$id"],['course_id','=',$course_id]])->count();
       
        if($chk>0){
            $storage_session_id = DB::table('userlist')->where([['id','=',"$id"],['loginprovider','=',"$id_provider"]])->select('storage_session_id as ssid')->get()->first();
            $ssid = $storage_session_id->ssid;
            $qry = DB::table('course_storage')->where([['stor_sess','=',$ssid],['course_id','=',$course_id],['course_page','=',$course_page]]);
            $default_form = DB::table('course_detail_list')->where([['course_id','=',$course_id],['page','=',$course_page]])->select('default_form as df')->get()->first()->df;
            if(!$qry->count()){
                $c_id = $course_id;
                $file_mime = DB::table('course_detail_list')->where([['course_id','=',$course_id],['page','=',$course_page]])->select('req_mime_type as rmt')->get()->first()->rmt;
                DB::table('course_storage')->insert(['filemime'=>$file_mime,'course_id'=>$c_id,'course_page'=>$course_page,'content'=>$default_form,'stor_sess'=>$ssid]);
            }
            DB::table('course_storage')->where([['stor_sess','=',$ssid],['course_id','=',$course_id],['course_page','=',$course_page]])->update(['content'=>$default_form ]);
            $rst['code_data'] = $default_form;
            $rst['reset']=true;
        }
        else{
            $rst['code_data'] = $data;
            $rst['reset']=false;
        }
    }
    else if($api_mode=='load'){
       // $data = $ipt['data'];
       $cchash = $ipt['course']['chash'];
       $ttttmp = decodeCourseHash($cchash);
       $course_id = $ttttmp['id']; #$ipt['course']['id'];
       $course_page = $ttttmp['page'];#$ipt['course']['page'];
       if($course_id==-1 && $course_page==-1){
           $rst['data']=array();
       }
        $chk = DB::table('user_registered_courses')->where([['loginprovider','=',"$id_provider"],['id','=',"$id"],['course_id','=',$course_id]])->count();
        $storage_session_id = DB::table('userlist')->where([['id','=',"$id"],['loginprovider','=',"$id_provider"]])->select('storage_session_id as ssid')->get()->first();
        $ssid = $storage_session_id->ssid;
       
        $cnt = DB::table('course_storage')->where([['stor_sess','=',$ssid],['course_id','=',$course_id],['course_page','=',$course_page]])->count();
        if($chk>0&&$cnt==0){
            $tmp = DB::table('course_detail_list')->where([['course_id','=',$course_id],['page','=',$course_page]])->select('default_form as df','req_mime_type as rmt')->get()->first();
            $default_form = $tmp->df;
            $file_mime =    $tmp->rmt;
          
           DB::table('course_storage')->insert(['filemime'=>$file_mime,'course_id'=>$course_id,'course_page'=>$course_page,'content'=>$default_form,'stor_sess'=>$ssid]);
       
            $cnt = DB::table('course_storage')->where([['stor_sess','=',$ssid],['course_id','=',$course_id],['course_page','=',$course_page]])->count();
        }
        if($chk>0&&$cnt>0){
             //$qry = DB::table('course_storage')->where([['stor_sess','=',$ssid],['course_id','=',$course_id],['course_page','=',$course_page]]);
           // $default_form = DB::table('course_detail_list')->where([['course_id','=',$course_id],['page','=',$course_page]])->select('default_form as df')->get()->first()->df;
            
            //$rst['code_data']=
            $qry1 =  DB::table('course_storage')->where([['stor_sess','=',$ssid],['course_id','=',$course_id],['course_page','=',$course_page]])->select('content')->get()->first();
            $qry = DB::table('course_detail_list')->where([['course_id','=',$course_id],['page','=',$course_page]])->select('page_instruct as pi','page_goal as pg','req_mime_type as rmt')->get()->first();
            
            $rst['code_data']=$qry1->content;
            $rst['code_instruct']=$qry->pi;
            $rst['page_title'] = $qry->pg;
            $rst['loaded']=true;
            $rst['code_lang']=explode("/",$qry->rmt)[1];
        }
        else{
            $rst['code_data']='';
            $rst['code_instruct']='unknown';
            $rst['page_title'] = 'unknown';
            $rst['loaded']=false;
            $rst['code_lang']='plain';
        }
    }else if($api_mode=="query_ref_with_hash"){
        $cary = array();
        $cid = -1;
        $cpg = -1;
        $cary['id']=$cid;
        $cary['page']=$cpg;
        $rst['course']=$cary;
        if(isset($ipt['course'])&&isset($ipt['course']['chash'])&&preg_match("/[\w]{32}/",$ipt['course']['chash'])){
            $mHash = $ipt['course']['chash'];
            $tmp = decodeCourseHash($mHash);
            $rst['course']=$tmp;
            //$rst['course']['id']=$cid;
            //$rst['course']['page']=$cpg;
        }
    }
    }
    else{
       // $rst['log']="first if error";
    }
    //$rst['laravel_Session'] = 
    return Response::json($rst);
})->where(['lang' => '^(html|js|php|css)$','api_mode'=>'^(submit|save|reset|load|query_ref_with_hash)$']);

Route::any('/marketpage/api/{api_mode}',function(Request $req,$api_mode){
    
    $rst = array();
    function HashreOrder($mHash){
        $str = $mHash;
        $mLen = strlen($str);
        for($i=1;$i<(int)($mLen/2);$i++){
            $tmp = $str[$i];
            $str[$i] = $str[$mLen-1-$i];
            $str[$mLen-1-$i]=$tmp;
            
        }
        return $str;
    }
    function encodeCourseHash($cid,$cpg){
        $rst = "error";
        $qry = DB::table("course_detail_list")->where([["page",'=',$cpg],[ "course_id",'=',$cid]])->count();
        if($qry>0){
            $rst = md5($cpg.".".$cid);
        }
        return HashreOrder($rst);
    }
    function decodeCourseHash($mHash){
        
        $mHashVal = HashreOrder($mHash);
        $rst = array();
        $rst['id'] = -1;
        $rst['page'] = -1;
        //$ssid = getSSID($id,$id_provider);
        $qry = DB::table("course_detail_list")->select("page" ,"course_id as ci")->get();
        foreach($qry as $row){
            if(md5($row->page.".".$row->ci)===$mHashVal){
                $rst['id'] = $row->ci;
                $rst['page'] = $row->page;
                break;
            }
        }
        return $rst;
    }
    function encodeCourseIdToHash($cid){
        $rst = md5("error");
        $qry = DB::table("course_list")->where([[ "course_id",'=',$cid]])->count();
        if($qry>0){
            $rst = md5($cid.".*");
        }
        return HashreOrder($rst);
    }
    function decodeCourseIdFromHash($mHash){
        $mHashVal = HashreOrder($mHash);
        //$ssid = getSSID($id,$id_provider);
        $qry = DB::table("course_list")->select("course_id as ci")->get();
        foreach($qry as $row){
            if(md5($row->ci.".*")===$mHashVal){
                return $row->ci;
            }
        }
        return -1;
    }
    $rst["loaded"]=false;
    if($api_mode=="alllist"){
        
        $dt = array();
        $rst["request_date"] = date("Y-m-d H:i:s");
        $qry = DB::table("course_list")->get();
       function unicodeToUTF8($str){
           return $str;
           /* return preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
                return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
            }, $str);
            */
       }
        foreach($qry as $row){
            $tmp = array();
            $tmp["lang"]="";
            $tmp["cost"]=$row->cost;
            $tmp["course_name"]=$row->course_displayed_name;
            $chaps = array();
            $chaps_data = array();
            $cid = $row->course_id;
            $qry2 = DB::table("course_detail_list")->where([['course_id','=',$row->course_id]])->orderBy("page");
            $chaps["count"] = $qry2->count();
            $tmp["purchased"]=false;
            $qry2 = $qry2->get();
            foreach($qry2 as $row2){
                $tmp2 = array();
                $tmp2["page"]= $row2->page;
                $tmp2["title_or_goal"]=unicodeToUTF8($row2->page_goal);
                $tmp2["page_price"]=$row2->page_price;
                array_push($chaps_data ,$tmp2);
            }
            $chaps["data"] = $chaps_data;
            if(Session::has('logininfo')
            &&isset(Session::get('logininfo')['name'])&&isset(Session::get('logininfo')['loginprovider'])&&isset(Session::get('logininfo')['storage_session'])){
                $id = Session::get('logininfo')['name'];
                $id_provider = Session::get('logininfo')['loginprovider'];
                $urc ="user_registered_courses";
                $qry = DB::table($urc)->where([['loginprovider','=',$id_provider],['id','=',$id],['course_id','=',$cid]])->count();
                if($qry>0){
                    $tmp["purchased"]=true;
                }
            }
            $tmp["course_description"]=unicodeToUTF8( $row->course_desc); //mb_convert_encoding($row->course_desc,"UTF-8");
            $tmp["course_rate"]=0;
            $tmp["course_purchase_key"]=encodeCourseIdToHash($cid);
            $tmp["chapters"]=$chaps;
            array_push($dt,$tmp);
        }

        $rst["data"] = $dt;
        $rst["loaded"]=true;
    }
    else if($api_mode=="purchase"){
        if(Session::has('logininfo')
        &&isset(Session::get('logininfo')['name'])&&isset(Session::get('logininfo')['loginprovider'])&&isset(Session::get('logininfo')['storage_session'])){
            $id = Session::get('logininfo')['name'];
            $id_provider = Session::get('logininfo')['loginprovider'];    
            $ipt = $req->json()->all();
            $rst["purchased"]=false;
            if(isset($ipt["course_purchase_keys"])){
                $keys = $ipt["course_purchase_keys"];
                foreach($keys as $key){
                    $cid = decodeCourseIdFromHash($key);
                    if($cid!=-1){
                        $urc ="user_registered_courses";
                    $qry = DB::table($urc)->where([['loginprovider','=',$id_provider],['id','=',$id],['course_id','=',$cid]])->count();
                    $ul = "userlist";
                    $qry2 = DB::table($ul)->where([['loginprovider','=',$id_provider],['id','=',$id]]);
                    $user_coin = 0;
                    if($qry2->count()>0){
                        $user_coin = $qry2->select("virtual_coin as vc")->get()->first()->vc;
                    }
                    $course_price = DB::table("course_list")->where([['course_id','=',$cid]])->select("cost")->get()->first()->cost;
                    if($qry==0&&($user_coin-$course_price)>=0){
                           DB::table($urc)->insert(['loginprovider'=>$id_provider,'id'=>$id,'course_id'=>$cid,'completed_pages_count'=>0,'modify_date'=>DB::raw("now()")]);
                            $qry2->update(['virtual_coin'=>($user_coin-$course_price)]);
                        }
                        
                    }
                }
                $rst["purchased"]=true;
                
            }
            $rst["loaded"]=true;
        }
        
    }
    $rst = json_decode(json_encode($rst,JSON_UNESCAPED_UNICODE));
    return Response::json($rst);
})->where(['api_mode'=>'^(alllist|purchase)$']);
Route::get('/user/api/{api_mode}',function($api_mode){
    $rst = array();
    $rst["loaded"]=false;
    //$rst["dump_chk"]=Session::has('logininfo');
    //$rst["dump"]=Session::get('logininfo');
    if(Session::has('logininfo')
    &&isset(Session::get('logininfo')['name'])&&isset(Session::get('logininfo')['loginprovider'])&&isset(Session::get('logininfo')['storage_session'])){
        function HashreOrder($mHash){
            $str = $mHash;
            $mLen = strlen($str);
            for($i=1;$i<(int)($mLen/2);$i++){
                $tmp = $str[$i];
                $str[$i] = $str[$mLen-1-$i];
                $str[$mLen-1-$i]=$tmp;
                
            }
            return $str;
        }
        function encodeCourseHash($cid,$cpg){
            $rst = md5("error");
            $qry = DB::table("course_detail_list")->where([["page",'=',$cpg],[ "course_id",'=',$cid]])->count();
            if($qry>0){
                $rst = md5($cpg.".".$cid);
            }
            return HashreOrder($rst);
        }
        $id = Session::get('logininfo')['name'];
        $id_provider = Session::get('logininfo')['loginprovider'];
        $stor_sess = Session::get('logininfo')['storage_session'];
        $rst["id"]=$id;
        $rst["logined_by"]=strtoupper($id_provider);
        $basic_qry = DB::table("userlist")->where([['loginprovider','=',$id_provider],['id','=',$id]])->get()->first();
        $rst["logined_at"]=$basic_qry->lastest_logined_date;
        if($api_mode=="all"||$api_mode=="coin"){
            $rst["coin"]=$basic_qry->virtual_coin;
        }
        if($api_mode=="all"||$api_mode=="courses"){
            $qry = DB::table("user_registered_courses")->where([['loginprovider','=',$id_provider],['id','=',$id]])->orderBy("course_id");
            $qry = $qry->get();
            $coursedt = array();
            foreach($qry as $row1){
                $ctmp=array();
                $cid = $row1->course_id;
                $c_qry  = DB::table("course_list")->where([['course_id','=',$cid]])->get()->first();
                $ctmp["title"]=$c_qry->course_displayed_name;
                $tblnm_cdl = "course_detail_list";
                $tblnm_cs = "course_storage";
                $cdl_qry = DB::table($tblnm_cdl)->where([['course_id','=',$cid]])->count();
                $cs_qry = DB::table($tblnm_cs)->where([['stor_sess','=',$stor_sess],['course_id','=',$cid],['passed','=',1]])->count();
                $ctmp["clear_all"]= $cdl_qry==$cs_qry;
                $ctmp["desc"]= DB::table("course_list")->where([['course_id','=',$cid]])->get()->first()->course_desc;
                $ctmp["progress"]=$ctmp["clear_all"]?100:(int)(($cs_qry*100)/$cdl_qry);
                $chapterlist=array();
                $qry2 = DB::table($tblnm_cdl)->leftJoin($tblnm_cs,function($join){
                    $join->on("course_detail_list.course_id","=","course_storage.course_id");
                    $join->on("page","=","course_page");
                })->where([['stor_sess','=',$stor_sess],["{$tblnm_cdl}.course_id",'=',$cid]])->orderBy("page");
                $qry2 = $qry2->select("page","page_goal as pg","passed")->get();
                foreach($qry2 as $row2){
                    $cstmp = array();
                    $cstmp["page_num"]=$row2->page;
                    $cstmp["page_title"]=$row2->pg;
                    $cstmp["passed"]=$row2->passed==1;
                    $cstmp["chash"]=encodeCourseHash($cid,$row2->page);
                    array_push($chapterlist,$cstmp);
                }

                $ctmp["chapters"]=$chapterlist;
                array_push($coursedt,$ctmp);
            }
            $rst["user_courses"]=$coursedt;
        }
        $rst["loaded"]=true;
    }
    
    return Response::json($rst);
})->where(['api_mode'=>'^(all|coin|courses)$']);