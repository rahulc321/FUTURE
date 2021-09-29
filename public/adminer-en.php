<?php
/** Adminer - Compact database management
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2007 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.7.9
*/function
adminer_errors($Bc,$Dc){return!!preg_match('~^(Trying to access array offset on value of type null|Undefined array key)~',$Dc);}error_reporting(6135);set_error_handler('adminer_errors',2);$bd=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($bd||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Ni=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Ni)$$X=$Ni;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$g;return$g;}function
adminer(){global$b;return$b;}function
version(){global$ia;return$ia;}function
idf_unescape($u){$te=substr($u,-1);return
str_replace($te.$te,$te,substr($u,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($xg,$bd=false){if(function_exists("get_magic_quotes_gpc")&&get_magic_quotes_gpc()){while(list($y,$X)=each($xg)){foreach($X
as$je=>$W){unset($xg[$y][$je]);if(is_array($W)){$xg[$y][stripslashes($je)]=$W;$xg[]=&$xg[$y][stripslashes($je)];}else$xg[$y][stripslashes($je)]=($bd?$W:stripslashes($W));}}}}function
bracket_escape($u,$Oa=false){static$zi=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($u,($Oa?array_flip($zi):$zi));}function
min_version($fj,$He="",$h=null){global$g;if(!$h)$h=$g;$sh=$h->server_info;if($He&&preg_match('~([\d.]+)-MariaDB~',$sh,$A)){$sh=$A[1];$fj=$He;}return(version_compare($sh,$fj)>=0);}function
charset($g){return(min_version("5.5.3",0,$g)?"utf8mb4":"utf8");}function
script($Ch,$yi="\n"){return"<script".nonce().">$Ch</script>$yi";}function
script_src($Si){return"<script src='".h($Si)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($P){return
str_replace("\0","&#0;",htmlspecialchars($P,ENT_QUOTES,'utf-8'));}function
nl_br($P){return
str_replace("\n","<br>",$P);}function
checkbox($B,$Y,$fb,$qe="",$yf="",$kb="",$re=""){$H="<input type='checkbox' name='$B' value='".h($Y)."'".($fb?" checked":"").($re?" aria-labelledby='$re'":"").">".($yf?script("qsl('input').onclick = function () { $yf };",""):"");return($qe!=""||$kb?"<label".($kb?" class='$kb'":"").">$H".h($qe)."</label>":$H);}function
optionlist($Df,$mh=null,$Xi=false){$H="";foreach($Df
as$je=>$W){$Ef=array($je=>$W);if(is_array($W)){$H.='<optgroup label="'.h($je).'">';$Ef=$W;}foreach($Ef
as$y=>$X)$H.='<option'.($Xi||is_string($y)?' value="'.h($y).'"':'').(($Xi||is_string($y)?(string)$y:$X)===$mh?' selected':'').'>'.h($X);if(is_array($W))$H.='</optgroup>';}return$H;}function
html_select($B,$Df,$Y="",$xf=true,$re=""){if($xf)return"<select name='".h($B)."'".($re?" aria-labelledby='$re'":"").">".optionlist($Df,$Y)."</select>".(is_string($xf)?script("qsl('select').onchange = function () { $xf };",""):"");$H="";foreach($Df
as$y=>$X)$H.="<label><input type='radio' name='".h($B)."' value='".h($y)."'".($y==$Y?" checked":"").">".h($X)."</label>";return$H;}function
select_input($Ja,$Df,$Y="",$xf="",$jg=""){$di=($Df?"select":"input");return"<$di$Ja".($Df?"><option value=''>$jg".optionlist($Df,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$jg'>").($xf?script("qsl('$di').onchange = $xf;",""):"");}function
confirm($Re="",$nh="qsl('input')"){return
script("$nh.onclick = function () { return confirm('".($Re?js_escape($Re):'Are you sure?')."'); };","");}function
print_fieldset($t,$ye,$ij=false){echo"<fieldset><legend>","<a href='#fieldset-$t'>$ye</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$t');",""),"</legend>","<div id='fieldset-$t'".($ij?"":" class='hidden'").">\n";}function
bold($Wa,$kb=""){return($Wa?" class='active $kb'":($kb?" class='$kb'":""));}function
odd($H=' class="odd"'){static$s=0;if(!$H)$s=-1;return($s++%2?$H:'');}function
js_escape($P){return
addcslashes($P,"\r\n'\\/");}function
json_row($y,$X=null){static$cd=true;if($cd)echo"{";if($y!=""){echo($cd?"":",")."\n\t\"".addcslashes($y,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$cd=false;}else{echo"\n}\n";$cd=true;}}function
ini_bool($Wd){$X=ini_get($Wd);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$H;if($H===null)$H=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$H;}function
set_password($ej,$M,$V,$E){$_SESSION["pwds"][$ej][$M][$V]=($_COOKIE["adminer_key"]&&is_string($E)?array(encrypt_string($E,$_COOKIE["adminer_key"])):$E);}function
get_password(){$H=get_session("pwds");if(is_array($H))$H=($_COOKIE["adminer_key"]?decrypt_string($H[0],$_COOKIE["adminer_key"]):false);return$H;}function
q($P){global$g;return$g->quote($P);}function
get_vals($F,$e=0){global$g;$H=array();$G=$g->query($F);if(is_object($G)){while($I=$G->fetch_row())$H[]=$I[$e];}return$H;}function
get_key_vals($F,$h=null,$vh=true){global$g;if(!is_object($h))$h=$g;$H=array();$G=$h->query($F);if(is_object($G)){while($I=$G->fetch_row()){if($vh)$H[$I[0]]=$I[1];else$H[]=$I[0];}}return$H;}function
get_rows($F,$h=null,$n="<p class='error'>"){global$g;$yb=(is_object($h)?$h:$g);$H=array();$G=$yb->query($F);if(is_object($G)){while($I=$G->fetch_assoc())$H[]=$I;}elseif(!$G&&!is_object($h)&&$n&&defined("PAGE_HEADER"))echo$n.error()."\n";return$H;}function
unique_array($I,$w){foreach($w
as$v){if(preg_match("~PRIMARY|UNIQUE~",$v["type"])){$H=array();foreach($v["columns"]as$y){if(!isset($I[$y]))continue
2;$H[$y]=$I[$y];}return$H;}}}function
escape_key($y){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$y,$A))return$A[1].idf_escape(idf_unescape($A[2])).$A[3];return
idf_escape($y);}function
where($Z,$p=array()){global$g,$x;$H=array();foreach((array)$Z["where"]as$y=>$X){$y=bracket_escape($y,1);$e=escape_key($y);$H[]=$e.($x=="sql"&&is_numeric($X)&&preg_match('~\.~',$X)?" LIKE ".q($X):($x=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($p[$y],q($X))));if($x=="sql"&&preg_match('~char|text~',$p[$y]["type"])&&preg_match("~[^ -@]~",$X))$H[]="$e = ".q($X)." COLLATE ".charset($g)."_bin";}foreach((array)$Z["null"]as$y)$H[]=escape_key($y)." IS NULL";return
implode(" AND ",$H);}function
where_check($X,$p=array()){parse_str($X,$db);remove_slashes(array(&$db));return
where($db,$p);}function
where_link($s,$e,$Y,$_f="="){return"&where%5B$s%5D%5Bcol%5D=".urlencode($e)."&where%5B$s%5D%5Bop%5D=".urlencode(($Y!==null?$_f:"IS NULL"))."&where%5B$s%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($f,$p,$K=array()){$H="";foreach($f
as$y=>$X){if($K&&!in_array(idf_escape($y),$K))continue;$Ga=convert_field($p[$y]);if($Ga)$H.=", $Ga AS ".idf_escape($y);}return$H;}function
cookie($B,$Y,$Ae=2592000){global$ba;return
header("Set-Cookie: $B=".urlencode($Y).($Ae?"; expires=".gmdate("D, d M Y H:i:s",time()+$Ae)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($ba?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($hd=false){$Wi=ini_bool("session.use_cookies");if(!$Wi||$hd){session_write_close();if($Wi&&@ini_set("session.use_cookies",false)===false)session_start();}}function&get_session($y){return$_SESSION[$y][DRIVER][SERVER][$_GET["username"]];}function
set_session($y,$X){$_SESSION[$y][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($ej,$M,$V,$l=null){global$jc;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($jc))."|username|".($l!==null?"db|":"").session_name()),$A);return"$A[1]?".(sid()?SID."&":"").($ej!="server"||$M!=""?urlencode($ej)."=".urlencode($M)."&":"")."username=".urlencode($V).($l!=""?"&db=".urlencode($l):"").($A[2]?"&$A[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($Ce,$Re=null){if($Re!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($Ce!==null?$Ce:$_SERVER["REQUEST_URI"]))][]=$Re;}if($Ce!==null){if($Ce=="")$Ce=".";header("Location: $Ce");exit;}}function
query_redirect($F,$Ce,$Re,$Ig=true,$Ic=true,$Tc=false,$li=""){global$g,$n,$b;if($Ic){$Kh=microtime(true);$Tc=!$g->query($F);$li=format_time($Kh);}$Fh="";if($F)$Fh=$b->messageQuery($F,$li,$Tc);if($Tc){$n=error().$Fh.script("messagesPrint();");return
false;}if($Ig)redirect($Ce,$Re.$Fh);return
true;}function
queries($F){global$g;static$Bg=array();static$Kh;if(!$Kh)$Kh=microtime(true);if($F===null)return
array(implode("\n",$Bg),format_time($Kh));$Bg[]=(preg_match('~;$~',$F)?"DELIMITER ;;\n$F;\nDELIMITER ":$F).";";return$g->query($F);}function
apply_queries($F,$S,$Ec='table'){foreach($S
as$Q){if(!queries("$F ".$Ec($Q)))return
false;}return
true;}function
queries_redirect($Ce,$Re,$Ig){list($Bg,$li)=queries(null);return
query_redirect($Bg,$Ce,$Re,$Ig,false,!$Ig,$li);}function
format_time($Kh){return
sprintf('%.3f s',max(0,microtime(true)-$Kh));}function
relative_uri(){return
str_replace(":","%3a",preg_replace('~^[^?]*/([^?]*)~','\1',$_SERVER["REQUEST_URI"]));}function
remove_from_uri($Tf=""){return
substr(preg_replace("~(?<=[?&])($Tf".(SID?"":"|".session_name()).")=[^&]*&~",'',relative_uri()."&"),0,-1);}function
pagination($D,$Ob){return" ".($D==$Ob?$D+1:'<a href="'.h(remove_from_uri("page").($D?"&page=$D".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($D+1)."</a>");}function
get_file($y,$Wb=false){$Zc=$_FILES[$y];if(!$Zc)return
null;foreach($Zc
as$y=>$X)$Zc[$y]=(array)$X;$H='';foreach($Zc["error"]as$y=>$n){if($n)return$n;$B=$Zc["name"][$y];$ti=$Zc["tmp_name"][$y];$Db=file_get_contents($Wb&&preg_match('~\.gz$~',$B)?"compress.zlib://$ti":$ti);if($Wb){$Kh=substr($Db,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Kh,$Og))$Db=iconv("utf-16","utf-8",$Db);elseif($Kh=="\xEF\xBB\xBF")$Db=substr($Db,3);$H.=$Db."\n\n";}else$H.=$Db;}return$H;}function
upload_error($n){$Oe=($n==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($n?'Unable to upload a file.'.($Oe?" ".sprintf('Maximum allowed file size is %sB.',$Oe):""):'File does not exist.');}function
repeat_pattern($gg,$ze){return
str_repeat("$gg{0,65535}",$ze/65535)."$gg{0,".($ze%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($P,$ze=80,$Rh=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$ze).")($)?)u",$P,$A))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$ze).")($)?)",$P,$A);return
h($A[1]).$Rh.(isset($A[2])?"":"<i>…</i>");}function
format_number($X){return
strtr(number_format($X,0,".",','),preg_split('~~u','0123456789',-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($xg,$Ld=array(),$pg=''){$H=false;foreach($xg
as$y=>$X){if(!in_array($y,$Ld)){if(is_array($X))hidden_fields($X,array(),$y);else{$H=true;echo'<input type="hidden" name="'.h($pg?$pg."[$y]":$y).'" value="'.h($X).'">';}}}return$H;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($Q,$Uc=false){$H=table_status($Q,$Uc);return($H?$H:array("Name"=>$Q));}function
column_foreign_keys($Q){global$b;$H=array();foreach($b->foreignKeys($Q)as$q){foreach($q["source"]as$X)$H[$X][]=$q;}return$H;}function
enum_input($T,$Ja,$o,$Y,$yc=null){global$b;preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$Je);$H=($yc!==null?"<label><input type='$T'$Ja value='$yc'".((is_array($Y)?in_array($yc,$Y):$Y===0)?" checked":"")."><i>".'empty'."</i></label>":"");foreach($Je[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$fb=(is_int($Y)?$Y==$s+1:(is_array($Y)?in_array($s+1,$Y):$Y===$X));$H.=" <label><input type='$T'$Ja value='".($s+1)."'".($fb?' checked':'').'>'.h($b->editVal($X,$o)).'</label>';}return$H;}function
input($o,$Y,$r){global$U,$b,$x;$B=h(bracket_escape($o["field"]));echo"<td class='function'>";if(is_array($Y)&&!$r){$Ea=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$Ea[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$Ea);$r="json";}$Sg=($x=="mssql"&&$o["auto_increment"]);if($Sg&&!$_POST["save"])$r=null;$qd=(isset($_GET["select"])||$Sg?array("orig"=>'original'):array())+$b->editFunctions($o);$Ja=" name='fields[$B]'";if($o["type"]=="enum")echo
h($qd[""])."<td>".$b->editInput($_GET["edit"],$o,$Ja,$Y);else{$_d=(in_array($r,$qd)||isset($qd[$r]));echo(count($qd)>1?"<select name='function[$B]'>".optionlist($qd,$r===null||$_d?$r:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($qd))).'<td>';$Yd=$b->editInput($_GET["edit"],$o,$Ja,$Y);if($Yd!="")echo$Yd;elseif(preg_match('~bool~',$o["type"]))echo"<input type='hidden'$Ja value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Ja value='1'>";elseif($o["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$Je);foreach($Je[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$fb=(is_int($Y)?($Y>>$s)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$B][$s]' value='".(1<<$s)."'".($fb?' checked':'').">".h($b->editVal($X,$o)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$B'>";elseif(($ji=preg_match('~text|lob|memo~i',$o["type"]))||preg_match("~\n~",$Y)){if($ji&&$x!="sqlite")$Ja.=" cols='50' rows='12'";else{$J=min(12,substr_count($Y,"\n")+1);$Ja.=" cols='30' rows='$J'".($J==1?" style='height: 1.2em;'":"");}echo"<textarea$Ja>".h($Y).'</textarea>';}elseif($r=="json"||preg_match('~^jsonb?$~',$o["type"]))echo"<textarea$Ja cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Qe=(!preg_match('~int~',$o["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$o["length"],$A)?((preg_match("~binary~",$o["type"])?2:1)*$A[1]+($A[3]?1:0)+($A[2]&&!$o["unsigned"]?1:0)):($U[$o["type"]]?$U[$o["type"]]+($o["unsigned"]?0:1):0));if($x=='sql'&&min_version(5.6)&&preg_match('~time~',$o["type"]))$Qe+=7;echo"<input".((!$_d||$r==="")&&preg_match('~(?<!o)int(?!er)~',$o["type"])&&!preg_match('~\[\]~',$o["full_type"])?" type='number'":"")." value='".h($Y)."'".($Qe?" data-maxlength='$Qe'":"").(preg_match('~char|binary~',$o["type"])&&$Qe>20?" size='40'":"")."$Ja>";}echo$b->editHint($_GET["edit"],$o,$Y);$cd=0;foreach($qd
as$y=>$X){if($y===""||!$X)break;$cd++;}if($cd)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $cd), oninput: function () { this.onchange(); }});");}}function
process_input($o){global$b,$m;$u=bracket_escape($o["field"]);$r=$_POST["function"][$u];$Y=$_POST["fields"][$u];if($o["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($o["auto_increment"]&&$Y=="")return
null;if($r=="orig")return(preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?idf_escape($o["field"]):false);if($r=="NULL")return"NULL";if($o["type"]=="set")return
array_sum((array)$Y);if($r=="json"){$r="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads")){$Zc=get_file("fields-$u");if(!is_string($Zc))return
false;return$m->quoteBinary($Zc);}return$b->processInput($o,$Y,$r);}function
fields_from_edit(){global$m;$H=array();foreach((array)$_POST["field_keys"]as$y=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$y];$_POST["fields"][$X]=$_POST["field_vals"][$y];}}foreach((array)$_POST["fields"]as$y=>$X){$B=bracket_escape($y,1);$H[$B]=array("field"=>$B,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($y==$m->primary),);}return$H;}function
search_tables(){global$b,$g;$_GET["where"][0]["val"]=$_POST["query"];$ph="<ul>\n";foreach(table_status('',true)as$Q=>$R){$B=$b->tableName($R);if(isset($R["Engine"])&&$B!=""&&(!$_POST["tables"]||in_array($Q,$_POST["tables"]))){$G=$g->query("SELECT".limit("1 FROM ".table($Q)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($Q),array())),1));if(!$G||$G->fetch_row()){$tg="<a href='".h(ME."select=".urlencode($Q)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$B</a>";echo"$ph<li>".($G?$tg:"<p class='error'>$tg: ".error())."\n";$ph="";}}}echo($ph?"<p class='message'>".'No tables.':"</ul>")."\n";}function
dump_headers($Id,$af=false){global$b;$H=$b->dumpHeaders($Id,$af);$Qf=$_POST["output"];if($Qf!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Id).".$H".($Qf!="file"&&preg_match('~^[0-9a-z]+$~',$Qf)?".$Qf":""));session_write_close();ob_flush();flush();return$H;}function
dump_csv($I){foreach($I
as$y=>$X){if(preg_match('~["\n,;\t]|^0|\.\d*0$~',$X)||$X==="")$I[$y]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$I)."\r\n";}function
apply_sql_function($r,$e){return($r?($r=="unixepoch"?"DATETIME($e, '$r')":($r=="count distinct"?"COUNT(DISTINCT ":strtoupper("$r("))."$e)"):$e);}function
get_temp_dir(){$H=ini_get("upload_tmp_dir");if(!$H){if(function_exists('sys_get_temp_dir'))$H=sys_get_temp_dir();else{$ad=@tempnam("","");if(!$ad)return
false;$H=dirname($ad);unlink($ad);}}return$H;}function
file_open_lock($ad){$od=@fopen($ad,"r+");if(!$od){$od=@fopen($ad,"w");if(!$od)return;chmod($ad,0660);}flock($od,LOCK_EX);return$od;}function
file_write_unlock($od,$Qb){rewind($od);fwrite($od,$Qb);ftruncate($od,strlen($Qb));flock($od,LOCK_UN);fclose($od);}function
password_file($i){$ad=get_temp_dir()."/adminer.key";$H=@file_get_contents($ad);if($H||!$i)return$H;$od=@fopen($ad,"w");if($od){chmod($ad,0660);$H=rand_string();fwrite($od,$H);fclose($od);}return$H;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$_,$o,$ki){global$b;if(is_array($X)){$H="";foreach($X
as$je=>$W)$H.="<tr>".($X!=array_values($X)?"<th>".h($je):"")."<td>".select_value($W,$_,$o,$ki);return"<table cellspacing='0'>$H</table>";}if(!$_)$_=$b->selectLink($X,$o);if($_===null){if(is_mail($X))$_="mailto:$X";if(is_url($X))$_=$X;}$H=$b->editVal($X,$o);if($H!==null){if(!is_utf8($H))$H="\0";elseif($ki!=""&&is_shortable($o))$H=shorten_utf8($H,max(0,+$ki));else$H=h($H);}return$b->selectVal($H,$_,$o,$X);}function
is_mail($vc){$Ha='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$ic='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$gg="$Ha+(\\.$Ha+)*@($ic?\\.)+$ic";return
is_string($vc)&&preg_match("(^$gg(,\\s*$gg)*\$)i",$vc);}function
is_url($P){$ic='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($ic?\\.)+$ic(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$P);}function
is_shortable($o){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$o["type"]);}function
count_rows($Q,$Z,$ee,$td){global$x;$F=" FROM ".table($Q).($Z?" WHERE ".implode(" AND ",$Z):"");return($ee&&($x=="sql"||count($td)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$td).")$F":"SELECT COUNT(*)".($ee?" FROM (SELECT 1$F GROUP BY ".implode(", ",$td).") x":$F));}function
slow_query($F){global$b,$vi,$m;$l=$b->database();$mi=$b->queryTimeout();$_h=$m->slowQuery($F,$mi);if(!$_h&&support("kill")&&is_object($h=connect())&&($l==""||$h->select_db($l))){$oe=$h->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$oe,'&token=',$vi,'\');
}, ',1000*$mi,');
</script>
';}else$h=null;ob_flush();flush();$H=@get_key_vals(($_h?$_h:$F),$h,false);if($h){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$H;}function
get_token(){$Eg=rand(1,1e6);return($Eg^$_SESSION["token"]).":$Eg";}function
verify_token(){list($vi,$Eg)=explode(":",$_POST["token"]);return($Eg^$_SESSION["token"])==$vi;}function
lzw_decompress($Sa){$fc=256;$Ta=8;$mb=array();$Ug=0;$Vg=0;for($s=0;$s<strlen($Sa);$s++){$Ug=($Ug<<8)+ord($Sa[$s]);$Vg+=8;if($Vg>=$Ta){$Vg-=$Ta;$mb[]=$Ug>>$Vg;$Ug&=(1<<$Vg)-1;$fc++;if($fc>>$Ta)$Ta++;}}$ec=range("\0","\xFF");$H="";foreach($mb
as$s=>$lb){$uc=$ec[$lb];if(!isset($uc))$uc=$tj.$tj[0];$H.=$uc;if($s)$ec[]=$tj.$uc[0];$tj=$uc;}return$H;}function
on_help($sb,$xh=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $sb, $xh) }, onmouseout: helpMouseout});","");}function
edit_form($a,$p,$I,$Qi){global$b,$x,$vi,$n;$Wh=$b->tableName(table_status1($a,true));page_header(($Qi?'Edit':'Insert'),$n,array("select"=>array($a,$Wh)),$Wh);if($I===false)echo"<p class='error'>".'No rows.'."\n";echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$p)echo"<p class='error'>".'You have no privileges to update this table.'."\n";else{echo"<table cellspacing='0' class='layout'>".script("qsl('table').onkeydown = editingKeydown;");foreach($p
as$B=>$o){echo"<tr><th>".$b->fieldName($o);$Xb=$_GET["set"][bracket_escape($B)];if($Xb===null){$Xb=$o["default"];if($o["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Xb,$Og))$Xb=$Og[1];}$Y=($I!==null?($I[$B]!=""&&$x=="sql"&&preg_match("~enum|set~",$o["type"])?(is_array($I[$B])?array_sum($I[$B]):+$I[$B]):$I[$B]):(!$Qi&&$o["auto_increment"]?"":(isset($_GET["select"])?false:$Xb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$o);$r=($_POST["save"]?(string)$_POST["function"][$B]:($Qi&&preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(preg_match("~time~",$o["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$r="now";}input($o,$Y,$r);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($p){echo"<input type='submit' value='".'Save'."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Qi?'Save and continue edit':'Save and insert next')."' title='Ctrl+Shift+Enter'>\n",($Qi?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".'Saving'."…', this); };"):"");}}echo($Qi?"<input type='submit' name='delete' value='".'Delete'."'>".confirm()."\n":($_POST||!$p?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$vi,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0�\0\n @\0�C��\"\0`E�Q����?�tvM'�Jd�d\\�b0\0�\"��fӈ��s5����A�XPaJ�0���8�#R�T��z`�#.��c�X��Ȁ?�-\0�Im?�.�M��\0ȯ(̉��/(%�\0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1̇�ٌ�l7��B1�4vb0��fs���n2B�ѱ٘�n:�#(�b.\rDc)��a7E����l�ñ��i1̎s���-4��f�	��i7�����t4���y�Zf4��i�AT�VV��f:Ϧ,:1�Qݼ�b2`�#�>:7G�1���s��L�XD*bv<܌#�e@�:4�!fo���t:<��咾�o��\ni���',�a_�:�i�Bv�|N�4.5Nf�i�vp�h��l��֚�O����= �OFQ��k\$��i����d2T�p��6�����-�Z�����6����h:�a�,����2�#8А�#��6n����J��h�t�����4O42��ok��*r���@p@�!������?�6��r[��L���:2B�j�!Hb��P�=!1V�\"��0��\nS���D7��Dڛ�C!�!��Gʌ� �+�=tC�.C��:+��=�������%�c�1MR/�EȒ4���2�䱠�`�8(�ӹ[W��=�yS�b�=�-ܹBS+ɯ�����@pL4Yd��q�����6�3Ĭ��Ac܌�Ψ�k�[&>���Z�pkm]�u-c:���Nt�δpҝ��8�=�#��[.��ޯ�~���m�y�PP�|I֛���Q�9v[�Q��\n��r�'g�+��T�2��V��z�4��8��(	�Ey*#j�2]��R����)��[N�R\$�<>:�>\$;�>��\r���H��T�\nw�N �wأ��<��Gw����\\Y�_�Rt^�>�\r}��S\rz�4=�\nL�%J��\",Z�8����i�0u�?�����s3#�ى�:���㽖��E]x���s^8��K^��*0��w����~���:��i���v2w����^7���7�c��u+U%�{P�*4̼�LX./!��1C��qx!H��Fd��L���Ġ�`6��5��f��Ć�=H�l �V1��\0a2�;��6����_ه�\0&�Z�S�d)KE'��n��[X��\0ZɊ�F[P�ޘ@��!��Y�,`�\"ڷ��0Ee9yF>��9b����F5:���\0}Ĵ��(\$����37H��� M�A��6R��{Mq�7G��C�C�m2�(�Ct>[�-t�/&C�]�etG�̬4@r>���<�Sq�/���Q�hm���������L��#��K�|���6fKP�\r%t��V=\"�SH\$�} ��)w�,W\0F��u@�b�9�\rr�2�#�D��X���yOI�>��n��Ǣ%���'��_��t\rτz�\\1�hl�]Q5Mp6k���qh�\$�H~�|��!*4����`S���S t�PP\\g��7�\n-�:袪p����l�B���7Өc�(wO0\\:��w���p4���{T��jO�6HÊ�r���q\n��%%�y']\$��a�Z�.fc�q*-�FW��k��z���j���lg�:�\$\"�N�\r#�d�Â���sc�̠��\"j�\r�����Ւ�Ph�1/��DA)���[�kn�p76�Y��R{�M�P���@\n-�a�6��[�zJH,�dl�B�h�o�����+�#Dr^�^��e��E��� ĜaP���JG�z��t�2�X�����V�����ȳ��B_%K=E��b弾�§kU(.!ܮ8����I.@�K�xn���:�P�32��m�H		C*�:v�T�\nR�����0u�����ҧ]�����P/�JQd�{L�޳:Y��2b��T ��3�4���c�V=���L4��r�!�B�Y�6��MeL������i�o�9< G��ƕЙMhm^�U�N����Tr5HiM�/�n�흳T��[-<__�3/Xr(<���������uҖGNX20�\r\$^��:'9�O��;�k����f��N'a����b�,�V��1��HI!%6@��\$�EGڜ�1�(mU��rս���`��iN+Ü�)���0l��f0��[U��V��-:I^��\$�s�b\re��ug�h�~9�߈�b�����f�+0�� hXrݬ�!\$�e,�w+����3��_�A�k��\nk�r�ʛcuWdY�\\�={.�č���g��p8�t\rRZ�v�J:�>��Y|+�@����C�t\r��jt��6��%�?��ǎ�>�/�����9F`ו��v~K�����R�W��z��lm�wL�9Y�*q�x�z��Se�ݛ����~�D�����x���ɟi7�2���Oݻ��_{��53��t���_��z�3�d)�C��\$?KӪP�%��T&��&\0P�NA�^�~���p� �Ϝ���\r\$�����b*+D6궦ψ��J\$(�ol��h&��KBS>���;z��x�oz>��o�Z�\nʋ[�v���Ȝ��2�OxِV�0f�����2Bl�bk�6Zk�hXcd�0*�KT�H=��π�p0�lV����\r���n�m��)(�(�:#����E��:C�C���\r�G\ré0��i����:`Z1Q\n:��\r\0���q���:`�-�M#}1;����q�#|�S���hl�D�\0fiDp�L��``����0y��1���\r�=�MQ\\��%oq��\0��1�21�1�� ���ќbi:��\r�/Ѣ� `)��0��@���I1�N�C�����O��Z��1���q1 ����,�\rdI�Ǧv�j�1 t�B���⁒0:�0��1�A2V���0���%�fi3!&Q�Rc%�q&w%��\r��V�#���Qw`�% ���m*r��y&i�+r{*��(rg(�#(2�(��)R@i�-�� ���1\"\0��R���.e.r��,�ry(2�C��b�!Bޏ3%ҵ,R�1��&��t��b�a\rL��-3�����\0��Bp�1�94�O'R�3*��=\$�[�^iI;/3i�5�&�}17�# ѹ8��\"�7��8�9*�23�!�!1\\\0�8��rk9�;S�23��ړ*�:q]5S<��#3�83�#e�=�>~9S螳�r�)��T*a�@і�bes���:-���*;,�ؙ3!i���LҲ�#1 �+n� �*��@�3i7�1���_�F�S;3�F�\rA��3�>�x:� \r�0��@�-�/��w��7��S�J3� �.F�\$O�B���%4�+t�'g�Lq\rJt�J��M2\r��7��T@���)ⓣd��2�P>ΰ��Fi಴�\nr\0��b�k(�D���KQ����1�\"2t����P�\r��,\$KCt�5��#��)��P#Pi.�U2�C�~�\"�");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:��gCI��\n8��3)��7���81��x:\nOg#)��r7\n\"��`�|2�gSi�H)N�S��\r��\"0��@�)�`(\$s6O!��V/=��' T4�=��iS��6IO�G#�X�VC��s��Z1.�hp8,�[�H�~Cz���2�l�c3���s���I�b�4\n�F8T��I���U*fz��r0�E����y���f�Y.:��I��(�c��΋!�_l��^�^(��N{S��)r�q�Y��l٦3�3�\n�+G���y���i���xV3w�uh�^r����a۔���c��\r���(.��Ch�<\r)�ѣ�`�7���43'm5���\n�P�:2�P����q ���C�}ī�����38�B�0�hR��r(�0��b\\0�Hr44��B�!�p�\$�rZZ�2܉.Ƀ(\\�5�|\nC(�\"��P���.��N�RT�Γ��>�HN��8HP�\\�7Jp~���2%��OC�1�.��C8·H��*�j����S(�/��6KU����<2�pOI���`���ⳈdO�H��5�-��4��pX25-Ң�ۈ�z7��\"(�P�\\32:]U����߅!]�<�A�ۤ���iڰ�l\r�\0v��#J8��wm��ɤ�<�ɠ��%m;p#�`X�D���iZ��N0����9��占��`��wJ�D��2�9t��*��y��NiIh\\9����:����xﭵyl*�Ȉ��Y�����8�W��?���ޛ3���!\"6�n[��\r�*\$�Ƨ�nzx�9\r�|*3ףp�ﻶ�:(p\\;��mz���9����8N���j2����\r�H�H&��(�z��7i�k� ����c��e���t���2:SH�Ƞ�/)�x�@��t�ri9����8����yҷ���V�+^Wڦ��kZ�Y�l�ʣ���4��Ƌ������\\E�{�7\0�p���D��i�-T����0l�%=���˃9(�5�\n\n�n,4�\0�a}܃.��Rs\02B\\�b1�S�\0003,�XPHJsp�d�K� CA!�2*W����2\$�+�f^\n�1����zE� Iv�\\�2��.*A���E(d���b��܄��9����Dh�&��?�H�s�Q�2�x~nÁJ�T2�&��eR���G�Q��Tw�ݑ��P���\\�)6�����sh\\3�\0R	�'\r+*;R�H�.�!�[�'~�%t< �p�K#�!�l���Le����,���&�\$	��`��CX��ӆ0֭����:M�h	�ڜG��!&3�D�<!�23��?h�J�e ��h�\r�m���Ni�������N�Hl7��v��WI�.��-�5֧ey�\rEJ\ni*�\$@�RU0,\$U�E����ªu)@(t�SJk�p!�~���d`�>��\n�;#\rp9�jɹ�]&Nc(r���TQU��S��\08n`��y�b���L�O5��,��>���x���f䴒���+��\"�I�{kM�[\r%�[	�e�a�1! ���Ԯ�F@�b)R��72��0�\nW���L�ܜҮtd�+���0wgl�0n@��ɢ�i�M��\nA�M5n�\$E�ױN��l�����%�1 A������k�r�iFB���ol,muNx-�_�֤C( ��f�l\r1p[9x(i�BҖ��zQl��8C�	��XU Tb��I�`�p+V\0��;�Cb��X�+ϒ�s��]H��[�k�x�G*�]�awn�!�6�����mS�I��K�~/�ӥ7��eeN��S�/;d�A�>}l~��� �%^�f�آpڜDE��a��t\nx=�kЎ�*d���T����j2��j��\n��� ,�e=��M84���a�j@�T�s���nf��\n�6�\rd��0���Y�'%ԓ��~	�Ҩ�<���AH�G��8���΃\$z��{���u2*��a��>�(w�K.bP�{��o��´�z�#�2�8=�8>���A,�e���+�C�x�*���-b=m���,�a��lzk���\$W�,�m�Ji�ʧ���+���0�[��.R�sK���X��ZL��2�`�(�C�vZ������\$�׹,�D?H��NxX��)��M��\$�,��*\nѣ\$<q�şh!��S����xsA!�:�K��}�������R��A2k�X�p\n<�����l���3�����VV�}�g&Yݍ!�+�;<�Y��YE3r�َ��C�o5����ճ�kk�����ۣ��t��U���)�[����}��u��l�:D��+Ϗ _o��h140���0��b�K�㬒�����lG��#��������|Ud�IK���7�^��@��O\0H��Hi�6\r����\\cg\0���2�B�*e��\n��	�zr�!�nWz&� {H��'\$X �w@�8�DGr*���H�'p#�Į���\nd���,���,�;g~�\0�#����E��\r�I`��'��%E�.�]`�Л��%&��m��\r��%4S�v�#\n��fH\$%�-�#���qB�����Q-�c2���&���]�� �qh\r�l]�s���h�7�n#����-�jE�Fr�l&d����z�F6����\"���|���s@����z)0rpڏ\0�X\0���|DL<!��o�*�D�{.B<E���0nB(� �|\r\n�^���� h�!���r\$��(^�~����/p�q��B��O����,\\��#RR��%���d�Hj�`����̭ V� bS�d�i�E���oh�r<i/k\$-�\$o��+�ŋ��l��O�&evƒ�i�jMPA'u'���( M(h/+��WD�So�.n�.�n���(�(\"���h�&p��/�/1D̊�j娸E��&⦀�,'l\$/.,�d���W�bbO3�B�sH�:J`!�.���������,F��7(��Կ��1�l�s �Ҏ���Ţq�X\r����~R鰱`�Ҟ�Y*�:R��rJ��%L�+n�\"��\r��͇H!qb�2�Li�%����Wj#9��ObE.I:�6�7\0�6+�%�.����a7E8VS�?(DG�ӳB�%;���/<�����\r ��>�M��@���H�Ds��Z[tH�Enx(���R�x��@��GkjW�>���#T/8�c8�Q0��_�IIGII�!���YEd�E�^�td�th�`DV!C�8��\r���b�3�!3�@�33N}�ZB�3	�3�30��M(�>��}�\\�t�f�f���I\r���337 X�\"td�,\nbtNO`P�;�ܕҭ���\$\n����Zѭ5U5WU�^ho���t�PM/5K4Ej�KQ&53GX�Xx)�<5D��\r�V�\n�r�5b܀\\J\">��1S\r[-��Du�\r���)00�Y��ˢ�k{\n��#��\r�^��|�uܻU�_n�U4�U�~Yt�\rI��@䏳�R �3:�uePMS�0T�wW�X���D��KOU����;U�\n�OY��Y�Q,M[\0�_�D���W��J*�\rg(]�\r\"ZC��6u�+�Y��Y6ô�0�q�(��8}��3AX3T�h9j�j�f�Mt�PJbqMP5>������Y�k%&\\�1d��E4� �Yn���\$<�U]Ӊ1�mbֶ�^�����\"NV��p��p��eM���W�ܢ�\\�)\n �\nf7\n�2��r8��=Ek7tV����7P��L��a6��v@'�6i��j&>��;��`��a	\0pڨ(�J��)�\\��n��Ĭm\0��2��eqJ��P��t��fj��\"[\0����X,<\\������+md��~�����s%o��mn�),ׄ�ԇ�\r4��8\r����mE�H]�����HW�M0D�߀��~�ˁ�K��E}����|f�^���\r>�-z]2s�xD�d[s�t�S��\0Qf-K`���t���wT�9��Z��	�\nB�9 Nb��<�B�I5o�oJ�p��JNd��\r�hލ��2�\"�x�HC�ݍ�:���9Yn16��zr+z���\\�����m ��T ���@Y2lQ<2O+�%��.Ӄh�0A���Z��2R��1��/�hH\r�X��aNB&� �M@�[x��ʮ���8&L�V͜v�*�j�ۚGH��\\ٮ	���&s�\0Q��\\\"�b��	��\rBs��w��	���BN`�7�Co(���\nè���1�9�*E� �S��U�0U� t�'|�m���?h[�\$.#�5	 �	p��yB�@R�]���@|��{���P\0x�/� w�%�EsBd���CU�~O׷�P�@X�]����Z3��1��{�eLY���ڐ�\\�(*R`�	�\n������QCF�*�����霬�p�X|`N���\$�[���@�U������Z�`Zd\"\\\"����)��I�:�t��oD�\0[�����-���g���*`hu%�,����I�7ī�H�m�6�}��N�ͳ\$�M�UYf&1����e]pz���I��m�G/� �w �!�\\#5�4I�d�E�hq���Ѭk�x|�k�qD�b�z?���>���:��[�L�ƬZ�X��:�������j�w5	�Y��0 ���\$\0C��dSg����{�@�\n`�	���C ���M�����# t}x�N����{�۰)��C��FKZ�j��\0PFY�B�pFk��0<�>�D<JE��g\r�.�2��8�U@*�5fk��JD���4��TDU76�/��@��K+���J�����@�=��WIOD�85M��N�\$R�\0�5�\r��_���E���I�ϳN�l���y\\����qU��Q���\n@���ۺ�p���P۱�7ԽN\r�R{*�qm�\$\0R��ԓ���q�È+U@�B��Of*�Cˬ�MC��`_ ���˵N��T�5٦C׻� ��\\W�e&_X�_؍h���B�3���%�FW���|�Gޛ'�[�ł����V��#^\r��GR����P��Fg�����Yi ���z\n��+�^/�������\\�6��b�dmh��@q���Ah�),J��W��cm�em]�ӏe�kZb0�����Y�]ym��f�e�B;���O��w�apDW�����{�\0��-2/bN�sֽ޾Ra�Ϯh&qt\n\"�i�Rm�hz�e����FS7��PP�䖤��:B����sm��Y d���7}3?*�t����lT�}�~�����=c������	��3�;T�L�5*	�~#�A����s�x-7��f5`�#\"N�b��G����@�e�[�����s����-��M6��qq� h�e5�\0Ң���*�b�IS���Fή9}�p�-��`{��ɖkP�0T<��Z9�0<՚\r��;!��g�\r\nK�\n��\0��*�\nb7(�_�@,�e2\r�]�K�+\0��p C\\Ѣ,0�^�MЧ����@�;X\r��?\$\r�j�+�/��B��P�����J{\"a�6�䉜�|�\n\0��\\5���	156�� .�[�Uد\0d��8Y�:!���=��X.�uC����!S���o�p�B���7��ů�Rh�\\h�E=�y:< :u��2�80�si��TsB�@\$ ��@�u	�Q���.��T0M\\/�d+ƃ\n��=��d���A���)\r@@�h3���8.eZa|.�7�Yk�c���'D#��Y�@X�q�=M��44�B AM��dU\"�Hw4�(>��8���C�?e_`��X:�A9ø���p�G��Gy6��F�Xr��l�1��ػ�B�Å9Rz��hB�{����\0��^��-�0�%D�5F\"\"�����i�`��nAf� \"tDZ\"_�V\$��!/�D�ᚆ������٦�̀F,25�j�T��y\0�N�x\r�Yl��#��Eq\n��B2�\n��6���4���!/�\n��Q��*�;)bR�Z0\0�CDo�˞�48������e�\n�S%\\�PIk��(0��u/��G������\\�}�4Fp��G�_�G?)g�ot��[v��\0��?b�;��`(�ی�NS)\n�x=��+@��7��j�0��,�1Åz����>0��Gc��L�VX�����%����Q+���o�F���ܶ�>Q-�c���l����w��z5G��@(h�c�H��r?��Nb�@�������lx3�U`�rw���U���t�8�=�l#���l�䨉8�E\"����O6\n��1e�`\\hKf�V/зPaYK�O�� ��x�	�Oj���r7�F;��B����̒��>�Ц�V\rĖ�|�'J�z����#�PB��Y5\0NC�^\n~LrR��[̟Rì�g�eZ\0x�^�i<Q�/)�%@ʐ��fB�Hf�{%P�\"\"���@���)���DE(iM2�S�*�y�S�\"���e̒1��ט\n4`ʩ>��Q*��y�n����T�u�����~%�+W��XK���Q�[ʔ��l�PYy#D٬D<�FL���@�6']Ƌ��\rF�`�!�%\n�0�c���˩%c8WrpG�.T�Do�UL2�*�|\$�:�Xt5�XY�I�p#� �^\n��:�#D�@�1\r*�K7�@D\0��C�C�xBh�EnK�,1\"�*y[�#!�י�ٙ���l_�/��x�\0���5�Z��4\0005J�h\"2���%Y���a�a1S�O�4��%ni��P��ߴq�_ʽ6���~��I\\���d���d������D�����3g^��@^6����_�HD�.ksL��@��Ɉ�n�I���~�\r�b�@�Ӏ�N�t\0s���]:u��X�b@^�1\0���2?�T��6dLNe��+�\0�:�Ё�l��z6q=̺x���N6��O,%@s�0\n�\\)�L<�C�|���P��b����A>I���\"	��^K4��gIX�i@P�jE�&/1@�f�	�N�x0coaߧ����,C'�y#6F@�Р��H0�{z3t�|cXMJ.*B�)ZDQ���\0��T-v�X�a*��,*�<b���#xј�d�P��KG8�� y�K	\\#=�)�gȑh�&�8])�C�\nô��9�z�W\\�g�M 7��!��������,��9���\$T\"�,��%.F!˚ A�-�����-�g��\0002R>KE�'�U�_I���9�˼�j(�Q��@�@�4/�7���'J.�RT�\0]KS�D���Ap5�\r�H0!�´e	d@Rҝ�ิ�9�S�;7�H�B�bx�J��_�vi�U`@���SAM��X��G�Xi��U*��������'��:V�WJv�D���N'\$�zh\$d_y���Z]����Y���8ؔ���]�P�*h���֧e;��pe��\$k�w��*7N�DTx_�ԧ�Gi�&P�Ԇ�t͆�b�\\E�H\$i�E\"cr��0l�?>��C(�W@3���22a���I����{�B`�ڳiŸGo^6E\r��G�M�p1i�I��X�\0003�2�K�����zl&ֆ�'IL�\\�\"�7�>�j(>�j�FG_��& 10I�A31=h q\0�F����ķ��_�J���ԳVΖ��܆q�՚��	��(/�dOC�_sm�<g�x\0��\"��\n@EkH\0�J���8�(���km[����S4�\nY40��+L\n������#Bӫb��%R֖��׭��R:�<\$!ۥr�;���	%|ʨ�(�|�H�\0�������]�cҡ=0��Z�\"\"=�X��)�f�N��6V}F��=[���ৢhu�-��\0t��bW~��Q��iJ���L�5׭q#kb���Wn���Q�T�!���e�nc�S�[+ִE�<-��a]Ń��Yb�\n\nJ~�|JɃ8� �Lp����o� �N�ܨ�J.��ŃS��2c9�j�y�-`a\0��*�ֈ@\0+��mg��6�1��Me\0��Q �_�}!I��GL�f)�X�o,�Shx�\0000\"h�+L�M�� �ј��Z	j�\0���/��\$��>u*�Z9��Z�e��+J����tz������R�Kԯ���Dy���q�0C�-f��m����BI�|��HB��sQl�X��.����|�c���[��ZhZ��l���x�@'��ml�KrQ�26��]�ҷn�d[��񎩇d���\"GJ9u��B�o��Zߖ�a��n@��n�lW|*gX�\nn2�F�|x`Dk��uPP�!Q\rr��`W/���	1�[-o,71bUs����N�7����Gq�.\\Q\"CCT\"�����*?u�ts�����]�٩Pz[�[YFϹ��FD3�\"����]�u۝)wz�:#���Iiw��pɛ��{�o�0n��;��\\�x���\0q��m���&�~��7����9[�H�qdL�O�2�v�|B�t��\\Ƥ�Hd���H�\" ��N\n\0��G�g�F��F�}\"�&QEK��{}\ryǎ��rכt������7�Nuó[A�gh;S�.Ҡ���¥|y��[Ն_b�Ȩ�!+R��ZX�@0N����P���%�jD�¯z	���[�U\"�{e�8��>�EL4Jн�0����7 ��d�� �Q^`0`�����]c�<g@��hy8��p.ef\n��eh��aX����mS��jBژQ\"�\r���K3�=>ǪAX�[,,\"'<���%�a��Ӵ��.\$�\0�%\0�sV���p�M\$�@j���>���}Ve�\$@�̈́#���(3:�`�U�Y��u�������@�V#E�G/��XD\$�h��av��xS\"]k18a�я�9dJROӊs�`EJ����Uo�m{l�B8���(\n}ei�b��, �;�N��͇�Q�\\�ǸI5yR�\$!>\\ʉ�g�uj*?n�M�޲h��\r%���U(d��N�d#}�pA:����-\\�A�*�4�2I���\r�֣�� 0h@\\Ե��8�3�rq]���d8\"�Q����ƙ:c��y�4	�ᑚda�Π6>U�A����:��@�2���\$�eh2���F��əN�+���\r�Ԁ(�Ar��d*�\0[�#cj����>!(�S���L�e�T��M	9\0W:�BD���3J���_@s��rue������ +�'B��}\"B\"�z2��r��l�xF[�L�˲Ea9��cdb��^,�UC=/2�����/\$�C�#��8�}D���6�`^;6B0U7�_=	,�1�j1V[�.	H9(1���ҏLz�C�	�\$.A�fh㖫����DrY	�H�e~o�r19��م\\�߄P�)\"�Q��,�e��L��w0�\0������;w�X�ǝ���qo���~�����>9�>}��dc�\0��g��f��q�&9���-�J#����3^4m/���\0\0006��n8��>䈴.ӗ��cph��������_A@[��7�|9\$pMh�>���5�K���E=h��A�t�^�V�	�\"�	c�B;���i��QҠt����@,\n�)���s�`����;�4����I������y��-�0yeʨ�U��B�v��3H�P�G�5��s|��\r���\$0����1��l3��(*oF~PK��.�,'�J/�Ӳ�t���d�:��n�\n��j��Y�z�(����w���Z�#Z�	Io�@1�λ\$��=VWz�	n�B�a���A��q�@��I�p	@�5Ӗ�lH{U��oX��f��ӿ\\z��.���,-\\ڗ^y n^���Bq����zX㉡�\$�*J72�D4.����!�M0��D��F����G��L�m�c*m�cI��5Ɍ�^�t���jl�7替S�Q��.i����h��L�ڱB6Ԅh�&�J��l\\��We�c�f%kj�� �p�R=��i�@.��(�2�klHUW\"�o�j���p!S5��pL'`\0�O *�Q3X��lJ\08\n�\r���*�a��떞��r�`<�&�XBh�8!x��&�Bht�\$���]�n߆���cL��[Ƶ�d��<`���\0���ς�aw�O%;���BC��Q�\r̭�����p����PQ�Z���Z�Au=N&�ia\n�mK6I}��n	��t\nd)����bp��\"��g'�0�7�u�&@�7�8X�N��x������\$B��ZB/�M�gB�i��ѧ�\\�m�mI�Ā��;5=#&4����P�Ս����q�A��\\�,q�cޟ\nc�B�����w\0BgjD�@;�=0m�k��\rĲ�`��'5���k-�{��\0�_�Mu����2��׆����q����>)9�W\n�d+��ԧ�G\r��n4���O�:5���8��1�:Κ?��(yGgWK�\r�7����m5.��e�H�hJ�Ak#��L�..�\\�=��U�Є����:�>7�W+^yD���b��G��OZ�4�r�(|x���Pr��,y���8qaܩO2��k�n��#p2��ǈ�ؔ.��c��U�c����łj�\$��8Ĭ~��7ZR:�׆8�9Ψw(a�L�%�-,��쿌#�f�%8��|�c������%X�W�\n}6��H����˞��#�&J,'z�M�M�����ຑ܆� ���/y6YQ���ںdәd����:����E��p2g�g�/�,����Ո'8�^;�UWN�����{�OC�����z�iKX��ڔN�dG�RCJY����i���y#>zS�MUc�������RORԾ�0�)�0��]:=Ϟ�t�����'\$�s�rF���67	=\$B��!qs	1\"���v��%��I�l<�b!ۮ6(Cd-�^<H`~2�K��zK�ٜ�Ա���y,qA�*�\0}��C�pb�\\�S�5����'(����|�M����W��5;\$5�T|��;k���t���@��;9�)��;i�.�;���_����F�=�D�M`H���\0�	 N @�%w��d��Pb�\$H|k�[��dCI!:l��,���<��u�t���NeϝW^�w�'6���D��f�u �ihI�Z:��~��ϣ�r���z�3�+�uoC�s2�b�ua�X��wWK�	HԶ27>�W���y����M�J��rpT��L��|`f��:���A�t�d|i��[w��j���W� 7���au�����e��A5�Q' ʐ\0��3�Ҿ\$����\rk)�a;���H=��֐~�IG�I�<���\"���I1'蠙�Gcm\0P\n�w��#�>���xB\"��Em|��2�\$}<3P�YX�go�d߶�<�����qE\"`���4�g�8r�]\n����:��qVb�T��m���9K&ғĤ�m�7)@��Qz���=��ߵű�H\n���}O�i}�\r٣.��v��p�JW&�u�55�0	�5��P�I��\n�����{ \r�m�@�@ �P� x�4i4�+@\0,͛\\�C1ӎ誕L���>n�\0���	 #������#@]/4JR� IR��r�<�ǯ��j��?1Mv�\n�Z�`v\0a�-�b�ψ��+��-�yA[|�7\r��\$���ZʭR�t�ޓ�����CErL	��r�g�e�R/�`�J	7�~�%Xo�4�di\"�Qr��I�:QD������QQM~\0Q��)ة�*,i\0�_(,�^�+c����&�S����~o�p��C���������@��g�ր�B���A~s�֤�\0]���/���z���Ã(_�zF��Oڿ\\\r�vE��K0�<?���?����P���=�`���D�^��=����v*��|\n���@�����-��\\?�k�Di4�����?���0��l#{�%\r3�F�����<�P<�k�4��*@��}?F� ���\0];���?�[\r:\0؜�d�����N�D�2���?\\���h��U�\0/֢�����	?�Q4�c�2o��5+�\r��L��?�����N�(����ڌ�(\0��|�>����A[?�[�/ɿ���;�]/�\\����}s�o��`2���vh]0�\0!PAX�J��l<\r�/\"�(��D� \\T�va���R�O���.#�PE�H#��C�*�)��>tk���\n�P���.0E���IH�\$��f%P�0]%�ɻ�XFA@4[���\0�	�)�P A�M`�h��\0�pd@��~�A@���A���kA�\n�o@H�֡r\n�\$�C�C�;\0��-����)�8�������s5@/\0z�C~ �� �eB^����\"P�\0X��K1�^{�\n�	!l����Z���QR���41�j�Z��ߟ�㩋á�,gI�<�����HO���f�\"�H,R��^���y��B`҉����~���ڴ}��ۖ� N፩q�:�~�M>^k�'\$��ʈj�\n\"	#;`�`Pq�ǿ\\\\+�<�:��ca`�\n��dd\n�@jn5����p�2���p��@�0���&0r������.H���h\r��wȴ��B�	@�|~�\r\0C\0�1�:CQ1\\pӑ�Y[���(Б.RG�Ѝ�0\"8�P��<%�<#�BX73�₤����5B�	t(��b���4<&\r������V\0G\n;��\\�");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("v0��F����==��FS	��_6MƳ���r:�E�CI��o:�C��Xc��\r�؄J(:=�E���a28�x�?�'�i�SANN���xs�NB��Vl0���S	��Ul�(D|҄��P��>�E�㩶yHch��-3Eb�� �b��pE�p�9.����~\n�?Kb�iw|�`��d.�x8EN��!��2��3���\r���Y���y6GFmY�8o7\n\r�0��\0�Dbc�!�Q7Шd8���~��N)�Eг`�Ns��`�S)�O���/�<�x�9�o�����3n��2�!r�:;�+�9�CȨ���\n<�`��b�\\�?�`�4\r#`�<�Be�B#�N ��\r.D`��j�4���p�ar��㢺�>�8�\$�c��1�c���c����{n7����A�N�RLi\r1���!�(�j´�+��62�X�8+����.\r����!x���h�'��6S�\0R����O�\n��1(W0���7q��:N�E:68n+��մ5_(�s�\r��/m�6P�@�EQ���9\n�V-���\"�.:�J��8we�q�|؇�X�]��Y X�e�zW�� �7��Z1��hQf��u�j�4Z{p\\AU�J<��k��@�ɍ��@�}&���L7U�wuYh��2��@�u� P�7�A�h����3Û��XEͅZ�]�l�@Mplv�)� ��HW���y>�Y�-�Y��/�������hC�[*��F�#~�!�`�\r#0P�C˝�f������\\���^�%B<�\\�f�ޱ�����&/�O��L\\jF��jZ�1�\\:ƴ>�N��XaF�A�������f�h{\"s\n�64������?�8�^p�\"띰�ȸ\\�e(�P�N��q[g��r�&�}Ph���W��*��r_s�P�h���\n���om������#���.�\0@�pdW �\$Һ�Q۽Tl0� ��HdH�)��ۏ��)P���H�g��U����B�e\r�t:��\0)\"�t�,�����[�(D�O\nR8!�Ƭ֚��lA�V��4�h��Sq<��@}���gK�]���]�=90��'����wA<����a�~��W��D|A���2�X�U2��yŊ��=�p)�\0P	�s��n�3�r�f\0�F���v��G��I@�%���+��_I`����\r.��N���KI�[�ʖSJ���aUf�Sz���M��%��\"Q|9��Bc�a�q\0�8�#�<a��:z1Uf��>�Z�l������e5#U@iUG��n�%Ұs���;gxL�pP�?B��Q�\\�b��龒Q�=7�:��ݡQ�\r:�t�:y(� �\n�d)���\n�X;����CaA�\r���P�GH�!���@�9\n\nAl~H���V\ns��ի�Ư�bBr���������3�\r�P�%�ф\r}b/�Α\$�5�P�C�\"w�B_��U�gAt��夅�^Q��U���j���Bvh졄4�)��+�)<�j^�<L��4U*���Bg�����*n�ʖ�-����	9O\$��طzyM�3�\\9���.o�����E(i������7	tߚ�-&�\nj!\r��y�y�D1g���]��yR�7\"������~����)TZ0E9M�YZtXe!�f�@�{Ȭyl	8�;���R{��8�Į�e�+UL�'�F�1���8PE5-	�_!�7��[2�J��;�HR��ǹ�8p痲݇@��0,ծpsK0\r�4��\$sJ���4�DZ��I��'\$cL�R��MpY&����i�z3G�zҚJ%��P�-��[�/x�T�{p��z�C�v���:�V'�\\��KJa��M�&���Ӿ\"�e�o^Q+h^��iT��1�OR�l�,5[ݘ\$��)��jLƁU`�S�`Z^�|��r�=��n登��TU	1Hyk��t+\0v�D�\r	<��ƙ��jG���t�*3%k�YܲT*�|\"C��lhE�(�\r�8r��{��0����D�_��.6и�;����rBj�O'ۜ���>\$��`^6��9�#����4X��mh8:��c��0��;�/ԉ����;�\\'(��t�'+�����̷�^�]��N�v��#�,�v���O�i�ϖ�>��<S�A\\�\\��!�3*tl`�u�\0p'�7�P�9�bs�{�v�{��7�\"{��r�a�(�^��E����g��/���U�9g���/��`�\nL\n�)���(A�a�\" ���	�&�P��@O\n師0�(M&�FJ'�! �0�<�H�������*�|��*�OZ�m*n/b�/�������.��o\0��dn�)����i�:R���P2�m�\0/v�OX���Fʳψ���\"�����0�0�����0b��gj��\$�n�0}�	�@�=MƂ0n�P�/p�ot������.�̽�g\0�)o�\n0���\rF����b�i��o}\n�̯�	NQ�'�x�Fa�J���L������\r��\r����0��'��d	oep��4D��ʐ�q(~�� �\r�E��pr�QVFH�l��Kj���N&�j!�H`�_bh\r1���n!�Ɏ�z�����\\��\r���`V_k��\"\\ׂ'V��\0ʾ`AC������V�`\r%�����\r����k@N����B�횙� �!�\n�\0Z�6�\$d��,%�%la�H�\n�#�S\$!\$@��2���I\$r�{!��J�2H�ZM\\��hb,�'||cj~g�r�`�ļ�\$���+�A1�E���� <�L��\$�Y%-FD��d�L焳��\n@�bVf�;2_(��L�п��<%@ڜ,\"�d��N�er�\0�`��Z��4�'ld9-�#`��Ŗ����j6�ƣ�v���N�͐f��@܆�&�B\$�(�Z&���278I ��P\rk\\���2`�\rdLb@E��2`P( B'�����0�&��{���:��dB�1�^؉*\r\0c<K�|�5sZ�`���O3�5=@�5�C>@�W*	=\0N<g�6s67Sm7u?	{<&L�.3~D��\rŚ�x��),r�in�/��O\0o{0k�]3>m��1\0�I@�9T34+ԙ@e�GFMC�\rE3�Etm!�#1�D @�H(��n ��<g,V`R]@����3Cr7s~�GI�i@\0v��5\rV�'������P��\r�\$<b�%(�Dd��PW����b�fO �x\0�} ��lb�&�vj4�LS��ִԶ5&dsF M�4��\".H�M0�1uL�\"��/J`�{�����xǐYu*\"U.I53Q�3Q��J��g��5�s���&jь��u�٭ЪGQMTmGB�tl-c�*��\r��Z7���*hs/RUV����B�Nˈ�����Ԋ�i�Lk�.���t�龩�rYi���-S��3�\\�T�OM^�G>�ZQj���\"���i��MsS�S\$Ib	f���u����:�SB|i��Y¦��8	v�#�D�4`��.��^�H�M�_ռ�u��U�z`Z�J	e��@Ce��a�\"m�b�6ԯJR���T�?ԣXMZ��І��p����Qv�j�jV�{���C�\r��7�Tʞ� ��5{P��]�\r�?Q�AA������2񾠓V)Ji��-N99f�l Jm��;u�@�<F�Ѡ�e�j��Ħ�I�<+CW@�����Z�l�1�<2�iF�7`KG�~L&+N��YtWH飑w	����l��s'g��q+L�zbiz���Ţ�.Њ�zW�� �zd�W����(�y)v�E4,\0�\"d��\$B�{��!)1U�5bp#�}m=��@�w�	P\0�\r�����`O|���	�ɍ����Y��JՂ�E��Ou�_�\n`F`�}M�.#1��f�*�ա��  �z�uc���� xf�8kZR�s2ʂ-���Z2�+�ʷ�(�sU�cD�ѷ���X!��u�&-vP�ر\0'L�X �L����o	��>�Վ�\r@�P�\rxF��E��ȭ�%����=5N֜��?�7�N�Å�w�`�hX�98 �����q��z��d%6̂t�/������L��l��,�Ka�N~�����,�'�ǀM\rf9�w��!x��x[�ϑ�G�8;�xA��-I�&5\$�D\$���%��xѬ���´���]����&o�-3�9�L��z���y6�;u�zZ ��8�_�ɐx\0D?�X7����y�OY.#3�8��ǀ�e�Q�=؀*��G�wm ���Y�����]YOY�F���)�z#\$e��)�/�z?�z;����^��F�Zg�����������`^�e����#�������?��e��M��3u�偃0�>�\"?��@חXv�\"������*Ԣ\r6v~��OV~�&ר�^g���đٞ�'��f6:-Z~��O6;zx��;&!�+{9M�ٳd� \r,9���W��ݭ:�\r�ٜ��@睂+��]��-�[g��ۇ[s�[i��i�q��y��x�+�|7�{7�|w�}����E��W��Wk�|J؁��xm��q xwyj���#��e��(�������ߞþ��� {��ڏ�y���M���@��ɂ��Y�(g͚-��������J(���@�;�y�#S���Y��p@�%�s��o�9;�������+��	�;����ZNٯº��� k�V��u�[�x��|q��ON?���	�`u��6�|�|X����س|O�x!�:���ϗY]�����c���\r�h�9n�������8'������\rS.1��USȸ��X��+��z]ɵ��?����C�\r��\\����\$�`��)U�|ˤ|Ѩx'՜����<�̙e�|�ͳ����L���M�y�(ۧ�l�к�O]{Ѿ�FD���}�yu��Ē�,XL\\�x��;U��Wt�v��\\OxWJ9Ȓ�R5�WiMi[�K��f(\0�dĚ�迩�\r�M����7�;��������6�KʦI�\r���xv\r�V3���ɱ.��R������|��^2�^0߾\$�Q��[�D��ܣ�>1'^X~t�1\"6L���+��A��e�����I��~����@����pM>�m<��SK��-H���T76�SMfg�=��GPʰ�P�\r��>�����2Sb\$�C[���(�)��%Q#G`u��Gwp\rk�Ke�zhj��zi(��rO�������T=�7���~�4\"ef�~�d���V�Z���U�-�b'V�J�Z7���)T��8.<�RM�\$�����'�by�\n5����_��w����U�`ei޿J�b�g�u�S��?��`���+��� M�g�7`���\0�_�-���_��?�F�\0����X���[��J�8&~D#��{P���4ܗ��\"�\0��������@ғ��\0F ?*��^��w�О:���u��3xK�^�w���߯�y[Ԟ(���#�/zr_�g��?�\0?�1wMR&M���?�St�T]ݴG�:I����)��B�� v����1�<�t��6�:�W{���x:=��ޚ��:�!!\0x�����q&��0}z\"]��o�z���j�w�����6��J�P۞[\\ }��`S�\0�qHM�/7B��P���]FT��8S5�/I�\r�\n ��O�0aQ\n�>�2�j�;=ڬ�dA=�p�VL)X�\n¦`e\$�TƦQJ��k�7�*O�� .����ġ�\r���\$#p�WT>!��v|��}�נ.%��,;�������f*?�焘��\0��pD��! ��#:MRc��B/06���	7@\0V�vg����hZ\nR\"@��F	����+ʚ�E�I�\n8&2�bX�PĬ�ͤ=h[���+�ʉ\r:��F�\0:*��\r}#��!\"�c;hŦ/0��ޒ�Ej�����]�Z�����\0�@iW_���h�;�V��Rb��P%!��b]SB����Ul	����r��\r�-\0��\"�Q=�Ih����	 F���L��FxR�э@�\0*�j5���k\0�0'�	@El�O���H�Cx�@\"G41�`ϼP(G91��\0��\"f:Qʍ�@�`'�>7�Ȏ�d�����R41�>�rI�H�Gt\n�R�H	��bҏ��71���f�h)D��8�B`���(�V<Q�8c? 2���E�4j\0�9��\r�͐�@�\0'F�D��,�!��H�=�*��E�(���?Ѫ&xd_H�ǢE�6�~�u��G\0R�X��Z~P'U=���@����l+A�\n�h�IiƔ���PG�Z`\$�P������.�;�E�\0�}� ��Q�����%���jA�W�إ\$�!��3r1� {Ӊ%i=IfK�!�e\$���8�0!�h#\\�HF|�i8�tl\$���l����l�i*(�G���L	 �\$��x�.�q\"�Wzs{8d`&�W��\0&E����15�jW�b��ć��V�R����-#{\0�Xi���g*��7�VF3�`妏�p@��#7�	�0��[Ү���[�éh˖\\�o{���T���]��Ŧᑀ8l`f@�reh��\n��W2�*@\0�`K(�L�̷\0vT��\0�c'L����:�� 0��@L1�T0b��h�W�|\\�-���DN��\ns3��\"����`Ǣ�肒�2��&��\r�U+�^��R�eS�n�i0�u˚b	J����2s��p�s^n<���♱�Fl�a�\0���\0�mA2�`|؟6	��nr���\0Dټ��7�&m�ߧ-)���\\���݌\n=���;*���b��蓈�T��y7c��|o�/����:���t�P�<��Y:��K�&C��'G/�@��Q�*�8�v�/��&���W�6p.\0�u3����Bq:(eOP�p	�駲���\r���0�(ac>�N�|��	�t��\n6v�_��e�;y���6f���gQ;y�β[S�	��g�ǰ�O�ud�dH�H�=�Z\r�'���qC*�)����g��E�O�� \"��!k�('�`�\nkhT��*�s��5R�E�a\n#�!1�����\0�;��S�iȼ@(�l���I� �v\r�nj~��63��Έ�I:h����\n.��2pl�9Bt�0\$b��p+�ǀ*�tJ����s�JQ8;4P(��ҧѶ!��.Ppk@�)6�5��!�(��\n+��{`=��H,Ɂ\\Ѵ�4�\"[�C���1���-���luo��4�[���E�%�\"��w] �(� ʏTe��)�K�A�E={ \n�`;?���-�G�5I���.%�����q%E���s���gF��s	�����K�G��n4i/,�i0�u�x)73�Szg���V[��h�Dp'�L<TM��jP*o�≴�\nH���\n�4�M-W�N�A/@�8mH��Rp�t�p�V�=h*0��	�1;\0uG��T6�@s�\0)�6��ƣT�\\�(\"���U,�C:��5i�K�l���ۧ�E*�\"�r����.@jR�J�Q��/��L@�SZ���P�)(jj�J������L*���\0���\r�-��Q*�Qڜg��9�~P@���H���\n-e�\0�Qw%^ ET�< 2H�@޴�e�\0� e#;��I�T�l���+A+C*�Y���h/�D\\�!鬚8�»3�AЙ��E��E�/}0t�J|���1Qm��n%(�p��!\n��±U�)\rsEX���5u%B- ��w]�*��E�)<+��qyV�@�mFH ���BN#�]�YQ1��:��V#�\$������<&�X������x��t�@]G��Զ��j)-@�q��L\nc�I�Y?qC�\r�v(@��X\0Ov�<�R�3X���Q�J����9�9�lxCuīd�� vT�Zkl\r�J��\\o�&?�o6E�q������\r���'3��ɪ�J�6�'Y@�6�FZ50�V�T�y���C`\0��VS!���&�6�6���rD�f`ꛨJvqz���F�����@�ݵ��҅Z.\$kXkJ�\\�\"�\"�֝i��:�E���\roX�\0>P��P�mi]\0�����aV��=���I6�����jK3���Z�Q�m�E���b�0:�32�V4N6����!�l�^ڦ�@h�hU��>:�	��E�>j�����0g�\\|�Sh�7y�ބ�\$��,5aė7&��:[WX4��q� ���J���ׂ�c8!�H���VD�Ď�+�D�:����9,DUa!�X\$��Я�ڋG�܌�B�t9-+o�t��L��}ĭ�qK��x6&��%x��tR�����\"�π�R�IWA`c���}l6��~�*�0vk�p���6��8z+�q�X��w*�E��IN�����*qPKFO\0�,�(��|�����k *YF5���;�<6�@�QU�\"��\rb�OAXÎv��v�)H��o`ST�pbj1+ŋ�e��� ʀQx8@�����5\\Q�,���ĉN��ޘb#Y�H��p1����kB�8N�o�X3,#Uک�'�\"�销�eeH#z��q^rG[��:�\r�m�ng����5��V�]��-(�W�0���~kh\\��Z��`��l����k �o�j�W�!�.�hF���[t�A�w�e�M૫��3!����nK_SF�j���-S�[r�̀w��0^�h�f�-����?���X�5�/������IY �V7�a�d �8�bq��b�n\n1YR�vT���,�+!����N�T��2I�߷�����������K`K\"�����O)\nY��4!}K�^����D@��na�\$@� ��\$A��j����\\�D[=�	bHp�SOAG�ho!F@l�U��`Xn\$\\�͈_��˘`���HB��]�2���\"z0i1�\\�����w�.�fy޻K)����� p�0���X�S>1	*,]��\r\"���<cQ��\$t��q��.��	<��+t,�]L�!�{�g���X��\$��6v����� ����%G�H������E����X��*��0ۊ)q�nC�)I���\"�����툳�`�KF����@�d�5��A��p�{�\\���pɾN�r�'�S(+5�Њ+�\"�Ā�U0�iː����!nM��brK���6ú�r���|a����@�x|��ka�9WR4\"?�5��p�ۓ��k�rĘ����ߒ����7Hp��5�YpW���G#�rʶAWD+`��=�\"�}�@H�\\�p���Ѐ�ߋ�)C3�!�sO:)��_F/\r4���<A��\nn�/T�3f7P1�6����OYлϲ���q��;�؁���a�XtS<��9�nws�x@1Ξxs�?��3Ş@���54��o�ȃ0����pR\0���������yq��L&S^:��Q�>\\4OIn��Z�n��v�3�3�+P��L(�������.x�\$�«C��Cn�A�k�c:L�6���r�w���h����nr�Z��=�=j�ђ���6}M�G�u~�3���bg4���s6s�Q��#:�3g~v3���<�+�<���a}ϧ=�e�8�'n)ӞcC�z��4L=h��{i����J�^~��wg�D�jL���^����=6ΧN�Ӕ����\\��D���N���E�?h�:S�*>��+�u�hh҅�W�E1j�x����t�'�t�[��wS���9��T��[�,�j�v����t��A#T���枂9��j�K-��ޠ���Y�i�Qe?��4Ӟ���_Wz����@JkWY�h��pu����j|z4���	�i��m�	�O5�\0>�|�9�ז��轠��gVy��u���=}gs_���V�sծ{�k�@r�^���(�w����H'��a�=i��N�4����_{�6�tϨ��ϗe�[�h-��Ul?J��0O\0^�Hl�\0.��Z������xu���\"<	�/7���� ���i:��\nǠ���;��!�3���_0�`�\0H`���2\0��H�#h�[�P<��עg����m@~�(��\0ߵk�Y�v���#>���\nz\n�@�Q�\n(�G��\n����'k����5�n�5ۨ�@_`Ї_l�1���wp�P�w���\0��c��oEl{�ݾ�7����o0����Ibϝ�n�z����﷛� ���{�8�w�=��|�/y�3a�߼#xq����@��ka�!�\08d�m��R[wvǋRGp8���v�\$Z���m��t��������������ǽ����u�o�p�`2��m|;#x�m�n�~;��V�E�������3O�\r�,~o�w[��N��}�� �cly��O����;��?�~�^j\"�Wz�:�'xW��.�	�u�(��Ý�q��<g��v�hWq��\\;ߟ8��)M\\��5vڷx=h�i�b-���|b���py�DЕHh\rce��y7�p��x��G�@D=� ����1��!4Ra\r�9�!\0'�Y����@>iS>����o��o��fsO 9�.����\"�F��l��20��E!Q���ːD9d�BW4��\0��y`RoF>F�a��0�����0	�2�<�I�P'�\\���I�\0\$��\n R�aU�.�sЄ��\"���1І�e�Y砢�Z�q��1�|��#�G!�P�P\0|�H�Fnp>W�:��`YP%�ď�\n�a8��P>�����`]��4�`<�r\0�Î������z�4����8�����4�`m�h:�Ϊ�HD���j�+p>*����8�ՠ0�8�A��:���с�]w�ú�z>9\n+�������:����ii�PoG0���1��)�Z�ږ�n�����eR֖��g�M�����gs�LC�r�8Ѐ�!�����3R)��0�0��s�I��J�VPpK\n|9e[���ˑ��D0����z4ϑ�o������,N8n��s�#{蓷z3�>�BS�\";�e5VD0���[\$7z0������=8�	T 3���Q�'R������n��L�yŋ��'�\0o��,��\0:[}(���|���X�>xvqW�?tB�E1wG;�!�݋5΀|�0��JI@��#���uņI��\\p8�!'�]߮��l-�l�S�B��,ӗ���]��1�ԕH��N�8%%�	��/�;�FGS���h�\\ل�c�t����2|�W�\$t��<�h�O��+#�B�aN1��{��y�w���2�\\Z&)�d�b'��,Xxm�~�H��@:d	>=-��lK��܏�J�\0���́�@�rϥ�@\"�(A����Z�7�h>����\\����#>���\0��Xr�Y��Yxŝ�q=:��Թ�\rl�o�m�gb��������D_�Tx�C���0.��y��R]�_���Z�ǻW�I��G��	Mɪ(��|@\0SO��s� {��@k}��FXS�b8��=��_����l�\0�=�g��{�H��yG���� s�_�J\$hk�F�q������d4ω����'���>vϏ��!_7�Vq��@1z�uSe��jKdyu���S�.�2�\"�{��K���?�s��˦h��R�d��`:y����Gھ\nQ�����ow��'��hS��>���L�X}��e���G��@9��퟈�W�|��Ϲ�@�_��uZ=��,���!}���\0�I@��#��\"�'�Y`��\\?��p��,G����ל_��'�G����	�T��#�o��H\r��\"���o�}��?��O鼔7�|'���=8�M��Q�y�a�H�?��߮� ���\0���bUd�67���I O����\"-�2_�0�\r�?�������hO׿�t\0\0002�~�° 4���K,��oh��	Pc���z`@��\"�����H; ,=��'S�.b��S����Cc���욌�R,~��X�@ '��8Z0�&�(np<pȣ�32(��.@R3��@^\r�+�@�,���\$	ϟ��E���t�B,���⪀ʰh\r�><6]#���;��C�.Ҏ����8�P�3��;@��L,+>���p(#�-�f1�z���,8�ߠ��ƐP�:9����R�۳����)e\0ڢR��!�\nr{��e����GA@*��n�D��6��������N�\r�R���8QK�0��颽��>PN���IQ=r<�;&��f�NGJ;�UA�����A�P�&������`�����);��!�s\0���p�p\r�����n(��@�%&	S�dY����uC�,��8O�#�����o���R�v,��#�|7�\"Cp����B�`�j�X3�~R�@��v�����9B#���@\n�0�>T�����-�5��/�=� ���E����\n��d\"!�;��p*n��Z�\08/�jX�\r��>F	Pϐe>��O��L����O0�\0�)�k���㦃[	��ϳ���'L��	����1 1\0��C�1T�`����Rʐz�Ě����p��������< .�>�5��\0���>� Bnˊ<\"he�>к�î��s�!�H�{ܐ�!\r�\r�\"��|��>R�1d���\"U@�D6����3���>o\r����v�L:K�2�+�0쾁�>��\0�� ���B�{!r*H��y;�`8\0��د��d����\r�0���2A����?��+�\0�Å\0A����wS��l����\r[ԡ�6�co�=����0�z/J+�ꆌ�W[��~C0��e�30HQP�DPY�}�4#YD���p)	�|�@���&�-��/F�	�T�	����aH5�#��H.�A>��0;.���Y�ġ	�*�D2�=3�	pBnuDw\n�!�z�C�Q \0��HQ4D�*��7\0�J��%ıp�uD�(�O=!�>�u,7��1��TM��+�3�1:\"P�����RQ?���P���+�11= �M\$Z��lT7�,Nq%E!�S�2�&��U*>GDS&����ozh8881\\:��Z0h���T �C+#ʱA%��D!\0�����XDA�3\0�!\\�#�h���9b��T�!d�����Y�j2��S����\nA+ͽ��H�wD`�(AB*��+%�E��X.ˠB�#��ȿ��&��Xe�Eo�\"��|�r��8�W�2�@8Da�|�������N�h����J8[�۳����W�z�{Z\"L\0�\0��Ȇ8�x�۶X@�� �E����h;�af��1��;n��hZ3�E����0|� 옑��A���t�B,~�W�8^�Ǡ׃��<2/	�8�+��۔���O+�%P#ή\n?�߉?��e˔�O\\]�7(#��D۾�(!c)�N����MF�E�#DX�g�)�0�A�\0�:�rB��``  ��Q��H>!\rB��\0��V%ce�HFH��m2�B�2I����`#���D>���n\n:L���9C���0��\0��x(ޏ�(\n����L�\"G�\n@���`[���\ni'\0��)������y)&��(p\0�N�	�\"��N:8��.\r!��'4|ל~����ʀ���\"�c��Dlt����0c��5kQQר+�Z��Gk�!F��c�4��Rx@�&>z=��\$(?���(\n쀨>�	�ҵ���Cqی��t-}�G,t�GW �xq�Hf�b\0�\0z���T9zwЅ�Dmn'�ccb�H\0z���3�!����� H��Hz׀�Iy\",�-�\0�\"<�2���'�#H`�d-�#cl�jĞ`��i(�_���dgȎ�ǂ*�j\r�\0�>� 6���6�2�kj�<�Cq��9�Đ��I\r\$C�AI\$x\r�H��7�8 ܀Z�pZrR����_�U\0�l\r��IR�Xi\0<����r�~�x�S��%��^�%j@^��T3�3ɀGH�z��&\$�(��q\0��f&8+�\rɗ%�2hC�x���I��lbɀ�(h�S�Y&��B������`�f��x�v�n.L+��/\"=I�0�d�\$4�7r����A���(4�2gJ(D��=F�����(����-'Ġ�XG�2�9Z=���,��r`);x\"��8;��>�&�����',�@��2�pl���:0�lI��\rr�JD���������hA�z22p�`O2h��8H��Ąwt�BF���g`7���2{�,Kl���߰%C%�om���������+X����41򹸎\n�2p��	ZB!�=V�ܨ�Ȁ�+H6���*��\0�k���%<� �K',3�r�I�;��8\0Z�+Eܭ�`������+l����W+�Yҵ-t��f�b�Q��_-Ӏޅ�+�� 95�LjJ.Gʩ,\\��ԅ.\$�2�J�\\�-��1�-c���ˇ.l�f�xBqK�,d��ˀ�8�A�Ko-��������3K��r��/|����/\\�r���,��HϤ�!�Y�1�0�@�.�&|����+��J\0�0P3J�-ZQ�	�\r&����\n�L�*���j�ĉ|�����#Ծ�\"˺���A��/���8�)1#�7\$\"�6\n>\n���7L�1���h9�\0�B�Z�d�#�b:\0+A���22��'̕\nt���̜�O��2lʳ.L��HC\0��2���+L�\\��r�Kk+���˳.ꌒ�;(Dƀ���1s����d�s9�����P4�쌜��@�.���A��nhJ�1�3�K�0��3J\$\0��2�Lk3��Q�;3��n\0\0�,�sI�@��u/VA�1���UM�<�Le4D�2��V�% �Ap\nȬ2��35���A-��T�u5�3�۹1+fL~�\n���	��->�� �ҡM�4XL�S��dٲ�͟*\\�@ͨ��Y�k����SDM�5 Xf����D�s���Us%	�̱p+K�6��/���ݒ�8X�ނ=K�6pH����%�3�ͫ7l�I�K0���L��D��u���`��P\r��SO͙&(;�L@��ψN>S��2��8(���`J�E��r�F	2��SE��M��M��\$q�E��\$�ã/I\$\\���ID�\"��\n䱺�w.t�S	���ђP��#\nW��-\0Cҵ�:j�R��^S���8;d�`���5Ԫ�aʖ��E��+(Xr�M�;��3�;���B,��*1&����2X�S���)<� �L9;�RSN����gIs+��ӰK�<��s�LY-Z�:A<���OO*��2v�W7��+|���˻<T���9�h����y\$<��#ρ;����v�\$��O�\0� �,Hk��-���Ϛ\r����ϣ;���O�>�����7>��3@O{.4�pO�?T�b���.�.~O�4��S���>1SS��*4�Pȣ�>�����3�\0�W�>��2��><���P?4��@��t\nN����A�xp��%=P@��C�@�R�˟?x��\n���0N�w�O?�TJC@��#�	.d���M��t�&=�\\�4��A��:L����\$���N��:��\r��I'���A�rግ;\r�/��C���B�Ӯ�i>L��7:9�����|�C\$��)�����z@�tl�:>��C�\n�Bi0G��,\0�FD%p)�o\0����\n>��`)QZI�KG�%M\0#\0�D���Q.H�'\$�E\n �\$ܐ%4I�D�3o�:L�\$��m ��0�	�B�\\(����8��通�h��D��C�sDX4TK���{��x�`\n�,��\nE��:�p\n�'��>��o\0���tI��` -\0�D��/��KP�`/���H�\$\n=���>��U�FP0���UG}4B\$?E����%�T�WD} *�H0�T�\0t������\"!o\0�E�7��R.���tfRFu!ԐD�\n�\0�F-4V�QH�%4��0uN\0�D�QRuE�	)��I\n�&Q�m�)ǚ�m �#\\����D��(\$̓x4��WFM&ԜR5H�%q��[F�+���IF \nT�R3D�L�o���y4TQ/E��[ў<�t^��F��)Q��+4�Q�I�#���IF�'TiѪX��!ѱF�*�nR�>�5�p��Km+�s��������I���R�E�+ԩ��M\0��(R�?�+HҀ�J�\"T�D���\$���	4wQ�}Tz\0�G�8|�x���R��6�R�	4XR6\n�4y�mN��Q�NM�&R�H&�2Q/�7#�қ�{�'�ҍ,|����\n�	.�\0�>�{�o#1D�;��?U��ҕJ�9�*����j����F�N��щJ� #�~%-?C���L�3�@EP�{`>Q�Ȕ��%O�)4�R%I�@��%,�\"���I�<�����\$ԉTP>�\n�\0QP5D��kOF�TY�<�o�Q�=T�\0��x	5�D�,�0?�i�?x�  �mE}>�|����[��\0����&RL���H�S9�G�I��1䀖��M4V�H�oT-S�)Q�G�F [��TQRjN��#x]N(�U�8\nuU\n?5,TmԞ?����?��@�U\n�u-��R�9��U/S \nU3�IESt�QYJu.�Q��F�o\$&���i	��KPC�6�>�5�G\0uR��u)U'R�0�Ѐ�DuIU�J@	��:�V8*�Rf%&�\\�R��MU9R��fUAU[T�UQSe[��\0�KeZUa��Uh��mS<���,R�s�`&Tj@��G�!\\x�^�0>��\0&��p�΂Q�Q�)T�U�Ps�@%\0�W�	`\$��(1�Q?�\$C�Qp\n�O�J��X�#��V7X�u;�!YB��S�c��+V����#MU�W�H��U�R�ǅU-+��VmY}\\���OK�M��\$�S�eToV���HT��!!<{�R��ZA5�R�!=3U��(�{@*Ratz\0)Q�P5H؏���հ�N5+���P�[��9�V%\"����\n����G�SL�����9�����l����\rV�ؤ�[�ou�UIY�R_T�Y�p5O֧\\�q`�U�[�Bu'Uw\\mRU�ԭ\\Es5�K\\���V�\\�S�{�AZ%O��\$��F���>�5E�WVm`��Wd]& \$�Ό����!R�Z}ԅ]}v5���ZUg��Q^y` �!^=F��R�^�v�U�Kex@+��r5�#�@?=�u�Γs���ץY�N�sS!^c�5�\$.�u`��\0�XE~1�9��J�UZ�@�#1_[�4J�2�\n�\$VI�4n�\0�?�4a�R�!U~)&��B>t�R�I�0��_EkTUS��|��Uk_�8�&��E��(‘?�@���J�5���JU�BQT}HV��j��Qx\ne�VsU=���V�N�4ղؗ\\x����R34�G�D\":	KQ�>�[�\r�Y_�#!�#][j<6خX	���c���#KL}>`'\0��5�X�cU�[\0��(���Wt|t�R]p�/�]H2I�QO��1�S�Qj�Z����H���m���)d�^SXCY\r�tu@J�p��%��M������?�UQ�\n�=R�ar:ԿE���-G�\0\$��d���]�meh*��Q�Wt��c��`��A�Y=S\r���	m-���=Mw�H�]J�\"䴏������f�\"�{#9Te����M�c��N�I����D������U�6��g��2��ݝ�e�a�L��Q&&uT�X�51Y�>����S�֊Q#�I���j�\0����W�P��?ub5FU�Ln�)V5R�@��\$!%o��P��'��E�U��P�-����B�p\n�F\$�S4�t�UF|{�q�ȓ0���Umjs�������\$�ڛj��c�ڐ��֫��aZI5X��j�26��&>v��\n\r)2�_k�G��TJ��eQ-c�Z�VM�ֽ�z>�]�a�c��c��`t��H��j�6��+k�M�\0�>���##3l=�'���^6�\0�èv�Z9Se��\"���bΡ�B>�)�/T�=�9\0�`P�\$\0�]�/0ڪ��䵏�k-�6��{k���[�F\r|�SѿJ��MQ�D=�/�WX���V�a�'���a�to��l冶�Xj}C@\"�KP����om�3\0#HV���v��~�{���?gx	n|[�?U��[r�h��G�`�3#Gk%L��\0�I�`C�D��	 \"\0��ŧ��#cN�6�ڹf���zێ�;Ѥ�eeF�7�/N\r:��Q�G�9	\$��I�ռ��]��T��WGs��dW�M�I����f�Bc�ۤ����!#cnu&(�S�_�w��Sf�&T�Z:��0C�S�LN`ܳYj=��>Ų��Z!=�rV]g��	ӣr���Xl��-.�U�'uJuJ\0�s�J�'W%���\\>?�B��V�j4���J}I/-ҝrRL�S�3\0,Rgqӭ��Tf>�1��\0�_���\\V8��Z�t��c耆�<^\\�ll�j\0���T�]C��w�ΓzI��ZwN���pVW�jv�Y�>�2�	o\$|U�W�L%{toX3_���R�J5~6\"��Zl}�`�kc����eR=^UԎ��1�ѽw7e�d��v��b�=��\0�f��,��m�)��Gp��-Ӽ�)9L���>|�� \"�@���5�`�:��\0�,��t@��x���l�J���b�6������a��A\0ػAR�[A���0\$qo�A��S��@���<@�y��\"as.����V^��讥^�����\0��H���[H@�bK����)z�\r����=��^�z�B\0�����N�o<̇t<�x�\0ڬ0*R��I{��^�E�:�{KՐ�1E�0��Y����/��c��\"\0��4���F�7'���\n�0��`U�T��?MP���l��4��r(	��Z�|���&��t\"I����L�w+�m}����Wi\r>�U__u��63�y[�8�T-��V�}�x��_~�%�7��{jM�o_�E�����~]�P\$�J�CaXG�9�\0007Ń5�A#�\0.���\r˴��_������%����\n�\r#<M�x�J���|��2�\0��;o�^a+F���笀Lk��;�_���#��M\\����pr@��õ�����OR���~z��A�NE�Y�O	(1N׉�R��8��C�����n?O)��1�A�Do\0�\r�Ǣ?�kJ��\"�,�OF��a����-b�6]PS�)ƙ�5xC�=@j����L�����L�:\"胻Ί�l#���B�k��������@��N��:�>�|B����9�	���:N��\$��S� �CB:j6����ΉJk��uK�_�W�͢ØI�=@Tv��\n0^o�\\�Ӡ?/��&u�.��_��\r��C��+��c�~�J�b�6���e\0�y�ѡ\0wx�h��8j%S���VH@N'�\\ۯ��N�`n\r��u�n�K�qU�B�+�f>G��\r���=@G���d���\n�)��FO� hʷ��ÈfC�ɅX|��I�]��3auy�Ui^�9y�\no^rt\r8��͇#����N	V��Y�;�c*�%V�<��#�h9r�\rxc�v(\ra���(xja�`g�0�V̼���Q��x(���glհ{��gh`sW<Kj�'�;)�Gnq\$�p�+�Ɍ_��d��^& ���D�x�!b�v�!EjPV�'����(�=�b�\r�\"�b��L�\0���bt�\n>J���1;�����ۈ�4^s�Q�p`�fr`7���x��E<l���	8s��'PT��ֺ�˃��z_�T[>��:��`�1.���;7�@��[��>��6!�*\$`��\0���`,�������@����?�m�>�>\0�LCǸ�R��n��/+�`;C����\0�*�<F���+���q M���;1�K\n�:b�3j1��l�:c>�Y���h���ގ�#�;���3ֺ�8�5�:�\\��\0XH���a�����M1�\\�L[YC��vN��\0+\0��t#�\$�����!@*�l��	F�dhd���F���&��Ƙf�)=��0��4�x\0004ED�6K��䢣���\0�nN�];q�4sj-�=-8���\0�sǨ���D�f5p4����J�^���'Ӕ[��H^�NR F�Kw�z�� ��E����gF|!�c���o�db����x�\0�-��6�,E��_���3u�p ��/�wz�(��ex�Ra�H�Y�ce��5�9d\0�0@2@Ґ�Y�fey��Y�cMו�h����[�ez\rv\\0�e���\\�cʃ��[�ue��NY`��ۖ�]9h姗~^Yqe���]�qe_|6!���u�`�f��J�{�7��M{�Yه��j�e��C��S6\0DuasFL}�\$ȇ�(��Mb���Ƥ,0Buί���т2�gxFљ{�a�n:i\rPj�e��r�r��G�BY��M+q��iY�d˙�`0��,>6�fo�0���o�� �Xf����\0�V�L!��f��l��6� �/��1e��\0�>kbf�\r�!�uf�<%�(r˛�a&	����Y��!���mBg=@��\r�; \r�5phI�9bm�\$BYˋ���g�x�#�@QEO��m9���0\"���!�t���ˉ��Ї�O* ���\0��>%�\$�o�rN&s9�f��4���g��~jM�f�wy�g�y�\\`X1y5x����^z�_,& k���|����1x��A�6� \n�o蔻�&x��gg�{r�?緛�-����|t�3�����}gHgK�9����J�<C�C��1��9�7��g����h6!0H���cdy�f��DA;��9�T���0��\0�p�����!� 6^�.�S²?���E(P�Έ .���5��h���EPJv��.���+�\$�5��>P+�?~��g�6\r��h��p�z(�W��`��\"y���:�FadŬ�6:��f��i\0����A;�e�����^��w�f� >y�����`-\r����\0�hr\r�r�8i\"_�	����9�CI��fXˈ2���\"�Ţ����h�L~�\"���%V�:!%��xy�izyg�vx�]���}qg����Zi��|��`�+ _�g�����٣������譞6PA�ʀ\$�=�9�����h��|p��������!��.�!�����i�^���iˢ�8zVC����Z\"����(�����9�U)��!DgU\0�j��?`��4�LTo@�B����N�a�{�r�:\n̟�E��8æ&=�E�*Z:\n?��g���̊��h��.����N�5(�S�h��i2�*c�f�@����7��z\"�|��rP�.ǀ�L8T'��k���:(�q2&��ED�2~���ر�����9���v���8������@��^X=X`��qZ��Q�֮`9j�5^���@竸�n�qv����3����(I6�j�dT���\\� ��3�,��h�k�3�(�3���P�u�V�|\0阮U�k;��JQ���.��	:J\r��1��n�BI\r\0ɬh@��?�N�\nsh���\"��;�r~7O�\$��(�5�R���	�ʽj����FYF��ܔ��~�x޾�f��\"�vۓo��˨��º#��a�����P���<��h�-3麝/G�x����n�i@\"�G�?��,�Zp�xX`v�4X������[�I��7�åXc	��!�b�}�j�_��9�5qti�6f������ٞ5���Fƹ�iѱ�pX'�2��r���0�ƺ��D,#G�U2��؏�I��\rl(�� �챣��=�A�a�쩳-8�dbS����4~���H;���0�6��b��{��޺R���s3z�����N�ބ��`�ˆ+���4<�^a�y���	}r���y������k�&4@��?~���cE����@�LS@���z^�qqN��</H�j^sC�`��sbgGy����^\n�N�\n:G�N}�c\n���� +���=�p�1��N�TB[d������Ћ��ܹ�`�n�oj;�jěwh����c9��p̡[y4���05�͋N��+ο��`Xda��/zn*�P�����#t�赸~�9W�	�V��~=�#��n)����	2��;�j:��J�k�C�!>x��5��==�2���.��|�'���[��'�;��v�������������;:SA	�&�[�me���n������˵���<��6ma�=Y.神��:g����腀����;�I߻x�[��I�J\0�~�zaY������wT\\`��V\n�~P)�zJ�������Q@��[�{rʉ�D�B�v��|i-�E��K�;^n�{���:Nh;���2��ƀp�Ѵ6����罘9�9����X�hQ�~���iA�@D �j���}�ozLV���ѳ~���	8B?�#F}F�Td����e��zc��F���g�7Η���� 6�#.E£����£��S�.J3��5��Kɥ�J���;���n5��:yS��C�voս.�{��	d\\0�?W\0!)�'����Eg�;�+��\0�Y�Nt�bp+��c�����\0�B=\"�c�T�:B������c��������P�I��D��V0��!ROl�O�N~aF�|%�ߺ�����)O��	�W�o����Q�w��:ٟl�0h@:���օ8�Q�&�[�n�F��p,�æ�@��JT�w�9��(���<�{�ƐO\r�	���ڂ\$m�/HnP\$o^�U��\"���{Ė�<.���n�q8\r�\0;�n������硟�+�޳3��n{�D\$7�,Ez7\0��l!{��8��x҂�.s8�PA�Fx�r����Qۮ���1̅�p+@�d��9OP5�lK�/�����\\m����s�q���v�Q�/���	�!���z�7�o��Eǆ�:q�V�5�?G�HO��O�\$�l��+�,�\r;�����~�Ač錳�{�`7|��Ă���r'��Ji\rc+�|�#+<&қ�<W,��>��^�P�&n�Jh�e�%d������C�i�zX�A�'D�>��Έ�Ek���@�B�w(�.��\n99A�hN�c�kN��d`���p`��%2���3H��b2&�<�9�R(���t�TH�	�z��'�� �o���>4?�\rZ�w�ӂ��4�`��Ї鍆��N���Ӏ�'-I����0(S�r�w,�����K�r��'-2Hlo-�U����_�'W#'/��H֟���j6�̉�����ȫ��\0�<������j1�E�Q�T�T���r�Bcm�16�͈g٫:w6ͯ�h@1�I:������2�p�L/����w�:�ő���K<��E<��J�76Ӏ�s�.̲sZ��/\$�AsEyϜ�r�r:w?Չ�!�?���Ǚ�Z��M�9�՝\0��1?ARͦ%�7>�M�ARr}s��r)\\t-8=����ЎU��,WOCsՆ��#w�5��ERlM*�D��1��>]��gK��V�\n�\\���s�܇8͹seͧ9��so�~����w4x�����f@���D��9����6��\0	@.���@�9\0�C;K��y+�J��٥��u<\\�`�c{Ӌ�E�>�y��J=l����/�-�7����Z46�uC5��P�Ω�RV�������ʳlV��aNx�`մ?U�7(HP�}jV�J�zNQJ�S����s-gQ!a�V�_SwR�O�3am�ZXwZ�o�'�wa���O�oZ���!�[\n<�Z��O�Ҷ'��Omo�[��a�=Q��>�:��T�\n����\0�=��m�j��AT�R�bu(�I���:��\$v�W�����u�S�\\V8��v�\\���g!Mж�u��_�&�is�\\C�R�VM�]tX�T7\\UoT��o_ԯݛS?a�l�S�-LutZGe���i`	}XZ�i}Q�yW[i��T��Yo���(ZE\\�}nٍi�f��ڋ��W�d�%T�pu3u�T�f5)v��]�UR3VEY]�X�\n�^��VqS�S�}X�iGf��v>�S��v�JMQ��vڕ�����\\�g]�QYE��ݵ#1V�l5U�EK]��\0���S��U?\\�BwS�U�7���mZ�V5\\��Wf��է[�eUr�{G\\��U��,�����W�[]x��V�j5mT�V�j�~u7�\0�V�U��'t��w?ms�����5V��vݏq}����u-Uq�]ݗc]�W���]Tt:�f�M�k���e]�[-p}^�I[�XD���Y�V�d���O]	seN����Z�WY�[�t��V?�3�ǵ�M���ݙ`��t^w�d�:qT�L�@@>]�j\rF�qv��-Lv�G�Kwi�LwIPMo��ǹMgv���[��Uss��~	���w:B�A���NE�{�!-��d���o\0��}&����hX��A��5�%٣fzL�H�5d�� Y�_%�v�ә!m��]������%������=B�>E [#^}�hYF�a���>{�gS���p[�F���Da�6n�����x9��8L�I㈫N�a=�S�@�bPk�.��N��H��l\0��:���2#�Θ;��v�O}�9ik]	&�{�� �����2|a��&�������Q��������)��oف�Ǹ:�&.\0�5q\0J�L��64hy�3�ޢ���a�ރ��Iz��O�����ﮈ\"�yB�ʳ{�3�%�5r(m������x.7r�b%���^�e�M���2�\0x��!�b}.��Y6\$qS��\"^|xE����a�������Xǡ5�9��'T�R	�c9���W�1���AΔP��؏h6'�o�-���p��T(\nn\r�Ő��1���R�RUg�������x��Pe#��*��kT<�<�>b;��\0�����gL�.�<k�Zv������z���8~��y7�Y��ȁ��7w��Odn�>�<���E�3��wS�ۆ�@��� o�W�1����Һ�z�e�޽��1��z�\0f=��c㊤g��{��>n�p\0���Α:H�Bn�6F��B�r�W=��C>M.1~@3�G�9�8�q<S�|�Y�8QP��`L[���qz�۫P���N�<{_-ٮ�d�O��d-�NB7��4��B�N��.V���9ƨ�Q�3��{IcP\$���h��<R yy��?��G��:n�����g����;Ah!����&��+>�ˀ�;M�ˌ�	������6S�N��ڌ=#����`�T�#+�n�;��r,�����X|#��\r�#���?\n�D>�|V�S����eϗ~J�m99��\ns�{S|r],~�˹��� �q�I�?\"|w���%|�j�\0rE�,kSn�����qƕ�d8B.��1����\"��/|���؃]�������E�Ϝ�N�l����x��I��� Ic�Ÿ.|\$8D��F������P�K��3��\\j��xU��C/��җ�A{������e�����������ܾ�����\rp�U\n�՟Wlo­Y�{����`]'���s���/|�o����3���r��}��;��[�n��������O�M7���ߣؼq��q(��_l�q�s�N��y������;�i�g�t����:�����ՙ�qk�����{���?z��������Mȗ�o��'�j������c�y�߄���g��gk�w��f8�Vc�7fA��Y���+Kx�=�gKAk�T,95rd�+�G����ٯ����[��%��A�w柞�����7���ଅ�%��{�m��8%_��m��q��V�˨_���%�!�E���i�~���h��~��C�߭~���%�������_�������rLkD�y����~�?p1O!?��v�\\��Pm�\"��<������E�6� �E��V����zk����9�z����~�/��պ��!Q�>��O��Nm��3r�� F��l���e;�M�߷���Ͻ�_a��!~C��f����b}3� K�f���. 	��}.����DX	i5�|��?��=\0��?�?��?��@��Õ��fu~a�^��n��y�Q;�q�����)�s�S�,\"G�\nu%��U�Y�AKl\n��B�I�86VCcO\0�`}.x���,-N�@~��T�G����'��d�J�����y1�zl��æf�g����AB�a�!��M\\<�gʃ�z4ƿ��@/��C�Â�@�	�Qq���)��x��/�.7inD�#=��� *79c�F���d2(��.�V��3����\$g`�A᧋rl|�m����b��/�qE���ô!�bU@��9i�;pp�d���פ=�1�y�x�x�	�=�v=��(v��s_��Bo�ɂ�ց#�K\r n����\\�# �f�PX�u-3&�	��J&,F�(9��v�0�&@khZ�y�g�Cԋ�z ��Á�hi=�s9T�� eT>g��3�d�tF��2b&:��\0�P���B��-�Q��8~�LS�M���ڷcg���Th'�f(���\$�.E���VL����A�I���ߌ���r���g�\r���0�����T��1P`1�d�����\r�4���=6@F���� F���=�ɂ6�A���>�N�AV�	���(\$�A/������;����?�g�f^	�\n�&�KO��n�{]���g˛�8�c��ў���Ϸ�����\n��7L����t:�Ѡ�hF�VO\r��J�)b�(\"OB�m�	o��\$]T�SH�Z^��K����w�\\[A9('�لcۑ���b0���� K�����srB�x\n�*Ba�z6o�\ry&tX1p'���^�M��<�Cg�`�4�8GH��zd?gX��.@,�7w��۞:+�TiUX16��L��s�:�\r�L�6�����f�r\r`�t��67~g�x�gH9�J��O=-\$�4?r٪4����O���:��z��{��D`����21�F�ܵ��(D�M��;����&����́��ڭ��U>�I�6��c���߸@\r/�/��ԕ��_H��\n7z�� ������7�a�ɻ[9D�'����}B��O�R��ݟ�B#s��]z!(D���@L^��	��x��@o��u�O����D���!�e`\na�k>�0`����-*���8E�Z6=f��%����c㛰�K=���F�\r���Sh�yN�[v*v�\r���@�#߸퉁�Ah*�L\$���A�A\\�����%�*	��p�\r*==8�\$W�\r� [��Jx0y��Z�+&Y�HA~A\n,\\(��p�!F����<6S�&IP`6Xz�+�df�\r��J£���i�s�+�&5��/rE���M^\$R(R�Q��Ew3��lH*m\0Bq�a��r��LB����Q��z6~l���B��\rI®G��XٸXVbs�mB�H�����c�_K�\$p�-:8��Nj:�х��-#�F�	\0�aiB�s\\�)�<.�!��\\��N��bIw8�͹t���PjW�`���y\0��&0�i?���Ҕ:�Ia)=��C�,a&�M�apƃ\$�I�IFc���\0!���Y�xa)~�C1�P�ZL3T�j�C\0y����`�\\�W��\\t\$�2�\n�+a�\0aKb���\n��]�C@��?I\r�HヮKs%�N����^���9CL/��=%ۨ�h��:?&P��EY�>5���n[Gْ�%V��*�w<����gJ�]�*�wd�]�B�5^�֢�OQ>%�s{�ԅ畫;�W����z�Gi���*��Rn��G9�E����,(u*��Ւ×��X�s��R���:�5�;��)�R���N���vK�(�R��M���b����_�{�F<<3�:%��HV�YS\n�%L+{�o.>Z(�Qk���N�!��,�:rH}nR�NkI		��[���ӧg��֤;mYҳ�g�%�9V~-J_��g�����\\�ɮ�Q\n��!�t�\\UY-tZn��d:B��ʽ�*�]')t���w���ɫ[BUm*�r4�ؖ�*yv���vZ�չ+GH��Zn�P�܅|\nT� %#\\�AX\0}5b+w�r�Xwܲ1u��%Cg=I��v`�cr�e�0`..<���h�+�H̝^\\j�yF��%�]�B�\0��r��+�>�%Zx�� �%C.����`Vn�1KS���k\r���X|��[�;�6H	U@�D:޻Mj	Ε��?��]ڤ��b�A+��G�\0thxb��L`���64Mޛ��Y#�hfD=e��w=�c�+H��:�.%��^\$�DZrAzj�fLl�7�o�����\0��-���Ed�މyz'V ��Ӟ�W�	Z��K�+�d(A�fy�P?�xR�^h���'���A\0���:p\r�d(V�����d�t	S�FcHȟ��]r�r�CHY	X_�/f���ͽ 4 7e�6D�{,�����<<Z^��j\"	�\n+ƀM�Y9��A�(<Pl�lp	�,>Ѐ�{E9�&�Gh�h{(���Agg8�(@�jT�n�g�Z��Ű�J����x�����@ic��Ջ�(p�'oJ0MnĀ�&���\r'\0Ց��\rq�F�4���)��cL���_�oJ�}5��c�o���|6�m�}Q���4Q��b����[�x�m( �&�@�;�+򘥮��f|I����R�48� {	`���k`u�r`��W㸱`\"��)fI\n��;�8Zj���g�~��AΈ�!j��%��T��E\\�\r3E�j�j��FXZ	��Ay�kH��Xd��gCQ�����΀�0�d����������t�	��zk�`@\0001\0n����H��\0�4\0g&.�\0���\0O(��P@\r��E�\0l\0��X��\r��E��8�x���@�ԋ�\0��^���z@E���\0�.�^��Qq\"�����Y��D_p&���3\0mZ.Pp�\r�Eϋ��s��v\"����0�`��w���,���_�`\rc���/�]x�q���3\0q�.p��q���\0002�_�i���ъ��E�\0a�1�b��wJ \0l\0�1,`��1y\0�9#?0T^��q��\$F6���/\$d�����FD�yJ0b��\0	��W��\0�.�c�{c E�\0s�3l]@\rb�F�\"\0�2�`����\"�7���/�\0������a	^04e��Q{c<�ь�j/_��ѐc\0001��*28BA��\0000�xƔiؾ1��F�5�0ljH���\"�F�30\\_��q�\0�f��T�l_0т�BEČ#3�]���s�ƽ���64_X�1�\0ƽ����d`��`\r�S�_JMV/f����1\0005I6tf���4F����34f����F-���6�d��\"��4�k��\$h�±�#E�̌�\0�6�_01�c@F���/d]X�Q�#G\n���5�g�q��EF\n�m\\�Dn��q��YFv�1/4`��q���4�=�8b�q|�\0004���3�mX�1��e��\0��.�\\��Q�cI�	��.7�\\x�`\"��\0i^3�(籒��\"�Ev4l_��q��\$F���oȾ�\r#UE䍩^9�t�������.�\0�3|r��1�\0����69l^x�ѼPF-�]\n0�v��Qy\"�G��2,sx�Qq#�F+�\0�/Di��q}���8�[6,j��\0cm�o��N5�eh�Qv��GL��H<T_�Q��?Fɋ�..\$f���y�E��C2�l��1s#�E�D�loh�Ѳ�j����8�e�ű�b�F!���9�`x�q�����C�7�hx�٣�Ŏ��7�^x���K<�h���	,u�鱑�G)��;lu��#�Eߎ��<�k���b���\0sR.�w�ֱ�#z�~�w�2|x(����\0001�'�:�v�\0001��G挿�?|`������� .2�X��#�G��8K�@<z�1��ƹ�\"9|j�����	G��/�6�q�����G��s�7�/\0001�b��ߍ��:|�8�Q�#~F��W�4�g���#<F\r�� �2��X�Q�#�Fv�k�7�x�1�#��Ǝ��@�rh�����F���Z;�f��rc�y��!\r	�_x�1�\"�H1���0Tw�ٲc\rF�1 \n8d�X�r���Ԍ��2Db���{d4H��rA<~��1�dBHI�[J?������q�~�k�0�t���#�F\r�#�0\\h��\r�G����Ett���c7�U��!�=D_���cN�\0�y�6a��� Fg��!v1�q��1��KǇ���@�e��ѳcGo��\n/���Ʋ�E��\"�3t`���#cH���<�c��q���F�%�?Tb蹱�d)��� r0����qc�E���>3\$tyQң���E�Cl`9)�VFH�MJ7�f���\$HHQ�� ;�ri�7#F��-F�H�Q�#\0G��!�1�^��&4�vG&��7�g�ృ\$\0G�\rr/�d�R�(��s6@���'RA�Ǭ������&�����g\0k z=�|Hٱ������^J�]��sd��,�\$�1����<cqǦ���J�_���b�G��QvJ���ر��H5��F�p��Ic��[���@�r���vH�%��3D����c<I\$�M.d��r1c=F���.4�c��2b�G.��!�L|{X�ѳ�{I��NF�dx�qsc��ݍ�#�E�a)��#�G����J�m�.��\$=Gh�AN=�s��ŤE͑G�G\\a1�0��H���F.tg8�ä[����Idn���8�F����.T����F3�E�6riq��sF���6�x�r���L�=nFT��od��>�-�3�|�2\$�0��= �:�xc�H�I\"NP\$b��Q�\$F�� �DĂ�����}F�%�?�(����G�3\$�O\$^x�2T������0���R���#�D�:��E�|i/2��XG����8���-�\$H�v���=d�� ��`���:lax�����I���:�X�RJ����R�mx�J#\nGG�9!N���{cI���&�I���R=��I\r��&j:�8��g#�H��'3�_x��b��H}��>7����c��ُ\"&K<x��2���H���\"6@db�뱭e;�)�!�.�]�/�d���m*f6,v��ɪ����L��(q��AI8�7d�9Ttc����UL�X��%H��I*z:�|IXqs��-�B���q^(�R��aq(~e���9J�U�+-eq*nT��>�\$�ѫer��α�p\n�ռ�\$es+�V��I���b��eq:�#]�cc�7r\n�f,gY��TC�%��	�}�\0���\\*�EWP�a�:�E�,&W��p)���xl�M���3\0t\0�/Iip�D'\0	k\$T��F��]f��dM�ȀK\$���H(@�ɔ��(�z�nWҤ�_�Mݔ*�\0�e�lF�^H	W*B���ZPe��֘��R/�dRRʅ\0Ku�,yH)�\"S�XI'��Z�=�L�R�3����\n�'�[k��6@;}R���I����_�)�w�[�� �\n���n����ʓbBr�l,\$v����԰����H����\\���s*����.Qt�B��d�b���@�?3�S�`a@�K�\\.����~�f���)����,?|&ӶK���Z9.�X�+S��|����\0Pʼ��E���e�/�\0V��^K�\0\n-	:��Sز)ת�0j�9TX��B���K\"�ů��²,2�'�2����P,�x���p���Kꗪ����\"�D�#TV��D��1�Ao;ؕ�/9TH%V`WJ<9��aeʰ�K/V^/�Q���\nB�Z\"9���XүM~\$�5����\$0d�I�U���2�^X\n�*�E7I\nV3���+�a��Ii��N�KK�g0�a���z*�V���#bJyMҦe��Z� �V���`����U1�C��.\rF��-j�&LU�p�9s�鹊+Q&1��Rm��ӱgZ���	,.XryZ첰0���3�2�A1�ւ�e�N������(?Al ��,N�ue��\$|r��_%��E05E}�\$���X2�%�Z�e �\n\";<9a�h㶥�a]���8���*�u����L����dR��0����+�Qm.�,G����M��_�2�e�dB��ݸ,�S�2��>U���԰�4vl�~e2��2�eĵ�Yg2nf�=��\$�%��ٖ�Ffa�)����fTƶ�G���g2�W,[����X>)t�A]���R*�&Z��6j2|��\0��(�p	�9� ��uҪ�?��`n��-lZn�!H9����zL��9VLϹy��ݢZ�JhR��g�EfL�U��~`4�Y���x)\$B�QR#ÕS������,6i#�Y��,;C��r��i�&�X��]��\nw54�K�x�\n*&��T���W�������+SлqNc�y��IW��\0W5c��ɫ��&+����Vr�)����Kg����?� ����|�gR���hR�%K��)Z#�5�,ֵ�k�漻`��l:��LsC�[M�UB�6ld�ѓJ������1nl:���j���Lߖ�\0�h� *)�p/��ާ5\\�<9��V��/��ޫ�hT�dj��rMbx\n�]R��W�R� MaU�3=��`0�o��,Z���l��}��m�월�l����mL�S6�\\�tΙ���L���\\�%�J���K��7oѩ��ef�M���oC�Y��v慭NV�4=R��sJ������*h���hn��-m��4��4�y��H�M��|��is�U=����A\$ڭ�i�ϙ������>����p�p��Qf������q,��5s�UL���8}ݬ�٪���#�XH�����I����9U�8�c:�I���f����7�kl�5}��f�LY���N2ް�}&�	i���c,�I�3���R��6r�؉�3b��͍��6>lXY��f�L�)+�S,ى�*�el���U\"ed��\"Z��ږ�6�ZD�E9��%�΂�Y9rmt�E��'.M�[4��^��ɷ�;M�w�5���9���a��v+70l����d%��<��3�_<�lN���(�v+7YRl΅Ӫ]�.��4�I��)��=փN�T�]۹'U^�?�S���7�XC�ũӨ�1�u�9�E�ߙ�k�L;���Nh���S�qNXk;1[����LgpV�B�1_����gs����;�Rl��E���N�T�8�w,���s��1�Pxr�q���3���(��;�Z��	yӾ'{O	_���r�ȪMg|�I��92eL���f�O\rY��nk��u���SN�v9Vk�	�3ǧ.̛v9zyd�)����N�Y�&s\$���jd'6͔�Q<�V��)�e�+���:�ج�Yjt���p�u<��ʖ��3�]qM��Y:9X�S��gI�Ý*�m���C����v�G���R@�֯�jT�=��:�e���(\0_Vn�,?p�	3�'Π���������\r�����|\"�i��gT�n��P皤�\nӔ�q,�Sf�.Y��Q A��A�,Z��eS���sE���\r��v�T��Q�Z�\"p�I�s�UAϛ\0��vZ�}�r��K�tf�P�f9疮�{��^J���ς�������\n0%��NGګ*~l�D.���Ke��6�[,�%����O՘�-�~쵕����j��RO;��@	˨en�b_�%sK�Ŝ����Y����Y�0���L�W���jr�Ր��φ��!B����Pv��fwګ�����M�R2�2�z�4r�h;�#M@�}�\0�|��M�\0�=ځ=��f�-!�6p��g[P4��������C�[5:��\r�Ct��àu@�ۺ<��if��Nu��n[�!u8j{&9Ku�FQlR�i�(�C��A�䮙s4��\0Y��;f�B<�{�嘼R_I�~��6��|MWTA�]4�e@J�e�P|[���r5*���OΠ�Bt�)��%�-\0P�j�m	u�s�}И��Bi^��*��z�0YK.�`[�Y�2��Ы�|�XB�����(?З�.\$�l���,��X�D��\n��j�OD�->_<���֝��\0�������s�h\\����ea\\�\0��e䑙Y�`���7U�\"e��CYT���zt:V9P�_���a�ЕF�;݀\0M�����2�e��HC���Z�?�V��'����}c�Y�a�脬��?Qh8	�0�Q�CM`����6��,���J�eZ�Z\"G�W��u��u\r�>49�K���I%L����V9����։��Z�{VEO�X;�����o�agP�\$\n�RX@}!-Si��R���qz�	��ITH.���\nk\n��\ndϮ�T����>�\n���?�E�`��5D+f�?#z��IZ�7T[��Qs#�D���\$���P���I�	�3��*�:�9YI��H���H��X�0�D�!u7J��m��YB}E������简��r�8Q��\n}'P�S�	Q���������\$��`R�)^��(O�P\0�aK����m�3��\$H.��X�����)�V��`���9 �.�Y��18���eU��`X�9���	����\\Lc�j�IE N鍫��6�W�D�XB�	Z�:�|Ϥ:	E-P-�&���)����*���l�)P�u��y|R���Lh�.p���_*�QA��@ �?,Ƨ�Y��)t�ч�<��P*���j�VuQ�:2\0�L�?J����,TPHL���E%���\0��yP(Y�JZ���TH�X\r	�Q4�hO�;\\�vV�#��T�Ww��\\`��Oҡ��?�JR2��=�F��]����I5TMjI�9�,(ƤDv|t�)��Wy-�]z��e���a,pQ6\$�I-g=%�S�W#�TP�ܐ��)�T&]���X15j��B8���V�ӥ\n�em y���h�*������d�4ς�bd!0��gR�J\\� �Mt��1R\n\n���x�����.�_��u�+Ƽ�;���*4�θ)]�\\�l�(m\"�Q�nT���(*\0�`�1H�@2	6h��Y�c���H_���f�?��a��7=KKde�t�H��2\0/\0�62@b~��`�\0.��\0�v�) !~��JPĝT������������O�{t��\0005���/ீ\r���J^��0�a!�)�8�%KޘPP4��~�H����������\r+�Lb��/24)���GK�e0�e��S1�B�	-0jf���S�wLΙ�i�d ����L��\r1�h�ȩ�S ��MJJ�ht�)��+?L��e5n���|FH��MN��5�j�ɩ�SH��L���4�=T���D��Mn��6Zm@I@S`�)'���7f�z��Sz�x~OU1k����SF��MOU4�p�٣2\0000���7�6�k�#xSl�'K�7�7\nl���xSu�LR7�7�st��xS}�GM7�8*qt�#xS��OM\"7�8�u��)�ӏ\0����9�r�)�Sr��2��;���)��7��Nj�m/�x��ӿ�sNڞ:jy4���S��gO:1�=\ncT���Sͧ����;�{��Sȧ/ORH\r=�tT��Iݧ�O���\\zx4��S�M���>j|T�i�S���O�����~��\$l���O����}t��٧�O��z��*�%�]PP���vU\"��ݧ�K��@\no�j�H�;P�>��1���Fd�P.5Bظ��\r��3�uB�<�L#�<�QPE�Cʁu*\n�ۨyPN��l���\r�6��?K��mBZi�j�H��O2�}1J����M�_M��mD����&�K��Q6��Fzv���6ӹ��Qj��;j��j)�*����mEʌ�9Fd��Qv5eG�ɵd�Ԅ�EM\0+�D�\"j)SD�QҤpZf��Ƃ�mR&��H��U�ہ%�{Rv0m0z��䧟Lƥ@��'���ER�?eJ�>�ԝ��M���I����YT���R�/�Bʕ.�UT��YRΡ�L:�jNԅ��R���L��5ji&,��O�mJD�5,�9����Q����1�hTf��N����ޥQ�'��7��Lih��\rcjԝ��Sz�u��\0n�Ժ�g���9�@c��\rT�%L��A�fT��MT9uQ\n��)��U��S��uD:���j�U	��ƨ�Pږq�*�EڪKSb�l\\ڤ�F���ŪGTz�gJ��H�SF�	\"��Q:�1����;���RꦵL*~EߪoTҦ\\z������:���]Sꕱ����B��U�^J�uR*kE��	��T�Qt��R�g2��Uj��V\$��_��S��mPH�U\\��T��[Uʫ5Jhٵ\\��Up�����V�7a_*����=R�>\0I*����V��X:hU8j�T�KZ��\\:��)j�T��8��	�WZ�Ub��J8�R�=Y�UV�U��R��\\:��-j��ѫiV.��[z��Ҫ��-�{T���Z��uoj�U��3 ��[���>����E �%\\���h#bՅ��WZ�-\\���C�����W>��]ںg4#����KTr��Zʤwj��\$��z�-Rj��tj�U*��W��tp\n�4����'�N�M����xU��X32[x�+���\$B�US*��q�UͪqXZ�}S���x���@�-W\n5�XZ�Յ���J��U2�=\\����F+��V�0]XX�U����0����-VJ��+�/�����Zʮ5sj��D��U޲%b�ɵ������V�%Y�^u@d�բ��W�愔�ŲRk&���YR��\\�ŒRk�Y�cV�O-\\��	kd���KoX��K��/�9�]��V�O-U�<��@��嬥Vγ[����6U�����=e�ϵo�4TݭY�0�eH�դ�\r��9����6�(󮝕+��7�yb�rI �|�\0�:Fz���\n��|��s<�R�%J���]��F�3����j�Σ�Y��Z��^<5�X�IJ��M`�nO\\�B&�r���s��Q�uz��x���	�T���Vw�J5�g	�?v�qF4�9�ӝ����6�zj����OV��\r�u�=�@ʒfT͚����y��	�֫pKaXU9�m����\n�ekMo��5\nhT��ꦦ�V���v���:��s���\\p>��L�:��)�O=nk}j�S��&�֮��~���y��e��ܚ�Zֵ�)j���t�VR�V��s�r�:+a�o��,!T�l�Uϕ�*n��5��\\�U�dv+�M\\�)]B�|�J���l;4��5�pL��ӵئ7Li�[~bmt��Se�\"���B��v��d��@ͧS�4)ؒ�Z���\$)��5ic!������Ό���\\R�*�SD���w\$�9�tS�\n�Gf�Pԛ��ʸ����*�	K���D�Vy��5�uȦJב�\\��C��\$��W,�M\\������5�����k^�V�s��5�k�ֻ�M^��{�u��ϤwFQ��J�H�gWN�k8�����ʉ+�����1br���˕���V�X�]�dL�j�YT��v��6�twy˕�k����vx=�5�h������8�]����˷x\"c|�ufU����\0�ҧ5�jȩ}�Pkn̚Rl��f٪�+���ۣ��>c4��W+T�Do����q���SX���b}}�hn�&<�?�/3��-áh���qn���	�p�%)S�yP\r��͵�m-�f�5���[�\\�=�T�}�y )��Yd�ؤ46#Y>�3��נ�m��\n09h;�4���0��+�a�e\nȃİȞ!�����)�@�x�x}�\$����AF��Ñ�0N� R�	���ӄ�iܥ��U�?���b5�!+׭\0G���w{��Ӥ��lI �)�w-4;p8��ؤ;@\r\n\r���N5�ƅF\\ӹhgPE il0��X�%�)\n��Lk��^���2��<5F��d�I�<�F�j�bM�d'�	�ƲD��Bma������OY�Xgg�8��ZV�%mf��%�F�-�,�\n���a��F�wf��s���0G乑�Z�\n	1�;J��1�\"iP�B�y�C�����t�zӉ���;l�4��ҡ��J��mLX�+lᘪ�{�8�\"�\n�V�����(�\$Y\0�d\\݆6�D9B�H�d%���1����6f �\"�T�J��`/��>�C=�c�쨱��?e!�k*�3l~���i��,�A��z/d���Mo���ڲn�\"ɽ������zTr}eٌ{M�aC�7�fiT����/6W���P����8�Fa`��5��M�f2V]�['}cn4]h���e���Z�ŧ\r��2���XllGa`(����(����\0�����_�lO��f&f�1c8�D{�Q��	S6�p\0�Y�����\0\r�q�3m&*f�;�p�6r^c�ϳ��`ɵ&z�n^ڱ�;D��S�oj^�=�L'g�5���&���Ef&���|\nK 6?bX*�.fψE���~&9�!��d�k@�v\"F�G�x\\�=�E�7�XP2[:��\0�׎��X~��7���X6�4���(�\";B�\n��X��hy��&�Dֈ�Z�l\nKC�������p���`mS�	2�U�;G���8��{��-��WBm��\$F��\r�l&B�Y2\r��mA�ő�w�Z�6�RВ��%d�����_��T�5�``Ba��G��c�XK�\r��\0��gN��\\���;N����s^\n��u����ѲVwz�U�F\"\0T-�,^��\0�����2 /� ����EW�/\0¼��ľ�4;\"�K-NZ���McλRVNe�Z�wj�6��a��ÿ���KV�lN?���jt2���T/[�N���j|0t% #�����\0��`��5F<����X@\nӢ���ZF\\-m���cd2�p5G�v'B�'�7{k�*'�L�A�Z|I�k�\n-.C�6����k�-����S����k�]��_\$��+G�נ[^���z]k��8�\\��F|��?B���^��B��̎|��@����B��zP�W/R?[!bB��k��Ѡ'	(�e:xf�r�7\r_��q�Ma�\0#��7|�Q&\0Ɂ@)���1�뮆LA[Pt�\0���`�6�\\e���zx��S݀vՈπU:�ڱ�T����ϗ>f�\nq�l��+K(|�\\��ѠG��U؋��@(�*�iS�%F�\rR\$��C��L����;�d��ļg�-\$m?�lhʝ��3?P�Y�\0");}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0!�����M��*)�o��) q��e���#��L�\0;";break;case"cross.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0#�����#\na�Fo~y�.�_wa��1�J�G�L�6]\0\0;";break;case"up.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0 �����MQN\n�}��a8�y�aŶ�\0��\0;";break;case"down.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0 �����M��*)�[W�\\��L&ٜƶ�\0��\0;";break;case"arrow.gif":echo"GIF89a\0\n\0�\0\0������!�\0\0\0,\0\0\0\0\0\n\0\0�i������Ӳ޻\0\0;";break;}}exit;}if($_GET["script"]=="version"){$od=file_open_lock(get_temp_dir()."/adminer.version");if($od)file_write_unlock($od,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$g,$m,$jc,$rc,$Ac,$n,$qd,$wd,$ba,$Xd,$x,$ca,$se,$wf,$ig,$Oh,$Ad,$vi,$Ai,$U,$Pi,$ia;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$ba=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$Uf=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$ba);if(version_compare(PHP_VERSION,'5.2.0')>=0)$Uf[]=true;call_user_func_array('session_set_cookie_params',$Uf);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$bd);if(function_exists("get_magic_quotes_runtime")&&get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);function
get_lang(){return'en';}function
lang($_i,$nf=null){if(is_array($_i)){$lg=($nf==1?0:1);$_i=$_i[$lg];}$_i=str_replace("%d","%s",$_i);$nf=format_number($nf);return
sprintf($_i,$nf);}if(extension_loaded('pdo')){class
Min_PDO{var$_result,$server_info,$affected_rows,$errno,$error,$pdo;function
__construct(){global$b;$lg=array_search("SQL",$b->operators);if($lg!==false)unset($b->operators[$lg]);}function
dsn($oc,$V,$E,$Df=array()){try{$this->pdo=new
PDO($oc,$V,$E,$Df);}catch(Exception$Gc){auth_error(h($Gc->getMessage()));}$this->pdo->setAttribute(3,1);$this->pdo->setAttribute(13,array('Min_PDOStatement'));$this->server_info=@$this->pdo->getAttribute(4);}function
quote($P){return$this->pdo->quote($P);}function
query($F,$Ji=false){$G=$this->pdo->query($F);$this->error="";if(!$G){list(,$this->errno,$this->error)=$this->pdo->errorInfo();if(!$this->error)$this->error='Unknown error.';return
false;}$this->store_result($G);return$G;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result($G=null){if(!$G){$G=$this->_result;if(!$G)return
false;}if($G->columnCount()){$G->num_rows=$G->rowCount();return$G;}$this->affected_rows=$G->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($F,$o=0){$G=$this->query($F);if(!$G)return
false;$I=$G->fetch();return$I[$o];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(2);}function
fetch_row(){return$this->fetch(3);}function
fetch_field(){$I=(object)$this->getColumnMeta($this->_offset++);$I->orgtable=$I->table;$I->orgname=$I->name;$I->charsetnr=(in_array("blob",(array)$I->flags)?63:0);return$I;}}}$jc=array();class
Min_SQL{var$_conn;function
__construct($g){$this->_conn=$g;}function
select($Q,$K,$Z,$td,$Ff=array(),$z=1,$D=0,$tg=false){global$b,$x;$ee=(count($td)<count($K));$F=$b->selectQueryBuild($K,$Z,$td,$Ff,$z,$D);if(!$F)$F="SELECT".limit(($_GET["page"]!="last"&&$z!=""&&$td&&$ee&&$x=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$K)."\nFROM ".table($Q),($Z?"\nWHERE ".implode(" AND ",$Z):"").($td&&$ee?"\nGROUP BY ".implode(", ",$td):"").($Ff?"\nORDER BY ".implode(", ",$Ff):""),($z!=""?+$z:null),($D?$z*$D:0),"\n");$Kh=microtime(true);$H=$this->_conn->query($F);if($tg)echo$b->selectQuery($F,$Kh,!$H);return$H;}function
delete($Q,$Cg,$z=0){$F="FROM ".table($Q);return
queries("DELETE".($z?limit1($Q,$F,$Cg):" $F$Cg"));}function
update($Q,$N,$Cg,$z=0,$L="\n"){$cj=array();foreach($N
as$y=>$X)$cj[]="$y = $X";$F=table($Q)." SET$L".implode(",$L",$cj);return
queries("UPDATE".($z?limit1($Q,$F,$Cg,$L):" $F$Cg"));}function
insert($Q,$N){return
queries("INSERT INTO ".table($Q).($N?" (".implode(", ",array_keys($N)).")\nVALUES (".implode(", ",$N).")":" DEFAULT VALUES"));}function
insertUpdate($Q,$J,$rg){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($F,$mi){}function
convertSearch($u,$X,$o){return$u;}function
value($X,$o){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$o):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($fh){return
q($fh);}function
warnings(){return'';}function
tableHelp($B){}}$jc["sqlite"]="SQLite 3";$jc["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){$og=array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite");define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($ad){$this->_link=new
SQLite3($ad);$fj=$this->_link->version();$this->server_info=$fj["versionString"];}function
query($F){$G=@$this->_link->query($F);$this->error="";if(!$G){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($G->numColumns())return
new
Min_Result($G);$this->affected_rows=$this->_link->changes();return
true;}function
quote($P){return(is_utf8($P)?"'".$this->_link->escapeString($P)."'":"x'".reset(unpack('H*',$P))."'");}function
store_result(){return$this->_result;}function
result($F,$o=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->_result->fetchArray();return$I[$o];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$e=$this->_offset++;$T=$this->_result->columnType($e);return(object)array("name"=>$this->_result->columnName($e),"type"=>$T,"charsetnr"=>($T==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($ad){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($ad);}function
query($F,$Ji=false){$Xe=($Ji?"unbufferedQuery":"query");$G=@$this->_link->$Xe($F,SQLITE_BOTH,$n);$this->error="";if(!$G){$this->error=$n;return
false;}elseif($G===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($G);}function
quote($P){return"'".sqlite_escape_string($P)."'";}function
store_result(){return$this->_result;}function
result($F,$o=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->_result->fetch();return$I[$o];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;if(method_exists($G,'numRows'))$this->num_rows=$G->numRows();}function
fetch_assoc(){$I=$this->_result->fetch(SQLITE_ASSOC);if(!$I)return
false;$H=array();foreach($I
as$y=>$X)$H[($y[0]=='"'?idf_unescape($y):$y)]=$X;return$H;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$B=$this->_result->fieldName($this->_offset++);$gg='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($gg\\.)?$gg\$~",$B,$A)){$Q=($A[3]!=""?$A[3]:idf_unescape($A[2]));$B=($A[5]!=""?$A[5]:idf_unescape($A[4]));}return(object)array("name"=>$B,"orgname"=>$B,"orgtable"=>$Q,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($ad){$this->dsn(DRIVER.":$ad","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($ad){if(is_readable($ad)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$ad)?$ad:dirname($_SERVER["SCRIPT_FILENAME"])."/$ad")." AS a")){parent::__construct($ad);$this->query("PRAGMA foreign_keys = 1");$this->query("PRAGMA busy_timeout = 500");return
true;}return
false;}function
multi_query($F){return$this->_result=$this->query($F);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$J,$rg){$cj=array();foreach($J
as$N)$cj[]="(".implode(", ",$N).")";return
queries("REPLACE INTO ".table($Q)." (".implode(", ",array_keys(reset($J))).") VALUES\n".implode(",\n",$cj));}function
tableHelp($B){if($B=="sqlite_sequence")return"fileformat2.html#seqtab";if($B=="sqlite_master")return"fileformat2.html#$B";}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;list(,,$E)=$b->credentials();if($E!="")return'Database does not support password.';return
new
Min_DB;}function
get_databases(){return
array();}function
limit($F,$Z,$z,$C=0,$L=" "){return" $F$Z".($z!==null?$L."LIMIT $z".($C?" OFFSET $C":""):"");}function
limit1($Q,$F,$Z,$L="\n"){global$g;return(preg_match('~^INTO~',$F)||$g->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($F,$Z,1,0,$L):" $F WHERE rowid = (SELECT rowid FROM ".table($Q).$Z.$L."LIMIT 1)");}function
db_collation($l,$pb){global$g;return$g->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($k){return
array();}function
table_status($B=""){global$g;$H=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($B!=""?"AND name = ".q($B):"ORDER BY name"))as$I){$I["Rows"]=$g->result("SELECT COUNT(*) FROM ".idf_escape($I["Name"]));$H[$I["Name"]]=$I;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$I)$H[$I["name"]]["Auto_increment"]=$I["seq"];return($B!=""?$H[$B]:$H);}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){global$g;return!$g->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($Q){global$g;$H=array();$rg="";foreach(get_rows("PRAGMA table_info(".table($Q).")")as$I){$B=$I["name"];$T=strtolower($I["type"]);$Xb=$I["dflt_value"];$H[$B]=array("field"=>$B,"type"=>(preg_match('~int~i',$T)?"integer":(preg_match('~char|clob|text~i',$T)?"text":(preg_match('~blob~i',$T)?"blob":(preg_match('~real|floa|doub~i',$T)?"real":"numeric")))),"full_type"=>$T,"default"=>(preg_match("~'(.*)'~",$Xb,$A)?str_replace("''","'",$A[1]):($Xb=="NULL"?null:$Xb)),"null"=>!$I["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$I["pk"],);if($I["pk"]){if($rg!="")$H[$rg]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$T))$H[$B]["auto_increment"]=true;$rg=$B;}}$Fh=$g->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$Fh,$Je,PREG_SET_ORDER);foreach($Je
as$A){$B=str_replace('""','"',preg_replace('~^"|"$~','',$A[1]));if($H[$B])$H[$B]["collation"]=trim($A[3],"'");}return$H;}function
indexes($Q,$h=null){global$g;if(!is_object($h))$h=$g;$H=array();$Fh=$h->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$Fh,$A)){$H[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$A[1],$Je,PREG_SET_ORDER);foreach($Je
as$A){$H[""]["columns"][]=idf_unescape($A[2]).$A[4];$H[""]["descs"][]=(preg_match('~DESC~i',$A[5])?'1':null);}}if(!$H){foreach(fields($Q)as$B=>$o){if($o["primary"])$H[""]=array("type"=>"PRIMARY","columns"=>array($B),"lengths"=>array(),"descs"=>array(null));}}$Ih=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($Q),$h);foreach(get_rows("PRAGMA index_list(".table($Q).")",$h)as$I){$B=$I["name"];$v=array("type"=>($I["unique"]?"UNIQUE":"INDEX"));$v["lengths"]=array();$v["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($B).")",$h)as$eh){$v["columns"][]=$eh["name"];$v["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($B).' ON '.idf_escape($Q),'~').' \((.*)\)$~i',$Ih[$B],$Og)){preg_match_all('/("[^"]*+")+( DESC)?/',$Og[2],$Je);foreach($Je[2]as$y=>$X){if($X)$v["descs"][$y]='1';}}if(!$H[""]||$v["type"]!="UNIQUE"||$v["columns"]!=$H[""]["columns"]||$v["descs"]!=$H[""]["descs"]||!preg_match("~^sqlite_~",$B))$H[$B]=$v;}return$H;}function
foreign_keys($Q){$H=array();foreach(get_rows("PRAGMA foreign_key_list(".table($Q).")")as$I){$q=&$H[$I["id"]];if(!$q)$q=$I;$q["source"][]=$I["from"];$q["target"][]=$I["to"];}return$H;}function
view($B){global$g;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$g->result("SELECT sql FROM sqlite_master WHERE name = ".q($B))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
check_sqlite_name($B){global$g;$Qc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($Qc)\$~",$B)){$g->error=sprintf('Please use one of the extensions %s.',str_replace("|",", ",$Qc));return
false;}return
true;}function
create_database($l,$d){global$g;if(file_exists($l)){$g->error='File exists.';return
false;}if(!check_sqlite_name($l))return
false;try{$_=new
Min_SQLite($l);}catch(Exception$Gc){$g->error=$Gc->getMessage();return
false;}$_->query('PRAGMA encoding = "UTF-8"');$_->query('CREATE TABLE adminer (i)');$_->query('DROP TABLE adminer');return
true;}function
drop_databases($k){global$g;$g->__construct(":memory:");foreach($k
as$l){if(!@unlink($l)){$g->error='File exists.';return
false;}}return
true;}function
rename_database($B,$d){global$g;if(!check_sqlite_name($B))return
false;$g->__construct(":memory:");$g->error='File exists.';return@rename(DB,$B);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){global$g;$Vi=($Q==""||$id);foreach($p
as$o){if($o[0]!=""||!$o[1]||$o[2]){$Vi=true;break;}}$c=array();$Of=array();foreach($p
as$o){if($o[1]){$c[]=($Vi?$o[1]:"ADD ".implode($o[1]));if($o[0]!="")$Of[$o[0]]=$o[1][0];}}if(!$Vi){foreach($c
as$X){if(!queries("ALTER TABLE ".table($Q)." $X"))return
false;}if($Q!=$B&&!queries("ALTER TABLE ".table($Q)." RENAME TO ".table($B)))return
false;}elseif(!recreate_table($Q,$B,$c,$Of,$id,$Ma))return
false;if($Ma){queries("BEGIN");queries("UPDATE sqlite_sequence SET seq = $Ma WHERE name = ".q($B));if(!$g->affected_rows)queries("INSERT INTO sqlite_sequence (name, seq) VALUES (".q($B).", $Ma)");queries("COMMIT");}return
true;}function
recreate_table($Q,$B,$p,$Of,$id,$Ma,$w=array()){global$g;if($Q!=""){if(!$p){foreach(fields($Q)as$y=>$o){if($w)$o["auto_increment"]=0;$p[]=process_field($o,$o);$Of[$y]=idf_escape($y);}}$sg=false;foreach($p
as$o){if($o[6])$sg=true;}$mc=array();foreach($w
as$y=>$X){if($X[2]=="DROP"){$mc[$X[1]]=true;unset($w[$y]);}}foreach(indexes($Q)as$me=>$v){$f=array();foreach($v["columns"]as$y=>$e){if(!$Of[$e])continue
2;$f[]=$Of[$e].($v["descs"][$y]?" DESC":"");}if(!$mc[$me]){if($v["type"]!="PRIMARY"||!$sg)$w[]=array($v["type"],$me,$f);}}foreach($w
as$y=>$X){if($X[0]=="PRIMARY"){unset($w[$y]);$id[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($Q)as$me=>$q){foreach($q["source"]as$y=>$e){if(!$Of[$e])continue
2;$q["source"][$y]=idf_unescape($Of[$e]);}if(!isset($id[" $me"]))$id[]=" ".format_foreign_key($q);}queries("BEGIN");}foreach($p
as$y=>$o)$p[$y]="  ".implode($o);$p=array_merge($p,array_filter($id));$gi=($Q==$B?"adminer_$B":$B);if(!queries("CREATE TABLE ".table($gi)." (\n".implode(",\n",$p)."\n)"))return
false;if($Q!=""){if($Of&&!queries("INSERT INTO ".table($gi)." (".implode(", ",$Of).") SELECT ".implode(", ",array_map('idf_escape',array_keys($Of)))." FROM ".table($Q)))return
false;$Gi=array();foreach(triggers($Q)as$Ei=>$ni){$Di=trigger($Ei);$Gi[]="CREATE TRIGGER ".idf_escape($Ei)." ".implode(" ",$ni)." ON ".table($B)."\n$Di[Statement]";}$Ma=$Ma?0:$g->result("SELECT seq FROM sqlite_sequence WHERE name = ".q($Q));if(!queries("DROP TABLE ".table($Q))||($Q==$B&&!queries("ALTER TABLE ".table($gi)." RENAME TO ".table($B)))||!alter_indexes($B,$w))return
false;if($Ma)queries("UPDATE sqlite_sequence SET seq = $Ma WHERE name = ".q($B));foreach($Gi
as$Di){if(!queries($Di))return
false;}queries("COMMIT");}return
true;}function
index_sql($Q,$T,$B,$f){return"CREATE $T ".($T!="INDEX"?"INDEX ":"").idf_escape($B!=""?$B:uniqid($Q."_"))." ON ".table($Q)." $f";}function
alter_indexes($Q,$c){foreach($c
as$rg){if($rg[0]=="PRIMARY")return
recreate_table($Q,$Q,array(),array(),array(),0,$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($Q,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($S){return
apply_queries("DELETE FROM",$S);}function
drop_views($hj){return
apply_queries("DROP VIEW",$hj);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
move_tables($S,$hj,$ei){return
false;}function
trigger($B){global$g;if($B=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$u='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$Fi=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$u\\s*(".implode("|",$Fi["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($u))?\\s+ON\\s*$u\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$g->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($B)),$A);$pf=$A[3];return
array("Timing"=>strtoupper($A[1]),"Event"=>strtoupper($A[2]).($pf?" OF":""),"Of"=>($pf[0]=='`'||$pf[0]=='"'?idf_unescape($pf):$pf),"Trigger"=>$B,"Statement"=>$A[4],);}function
triggers($Q){$H=array();$Fi=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q))as$I){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$Fi["Timing"]).')\s*(.*?)\s+ON\b~i',$I["sql"],$A);$H[$I["name"]]=array($A[1],$A[2]);}return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ROWID()");}function
explain($g,$F){return$g->query("EXPLAIN QUERY PLAN $F");}function
found_rows($R,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($ih){return
true;}function
create_sql($Q,$Ma,$Ph){global$g;$H=$g->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($Q));foreach(indexes($Q)as$B=>$v){if($B=='')continue;$H.=";\n\n".index_sql($Q,$v['type'],$B,"(".implode(", ",array_map('idf_escape',$v['columns'])).")");}return$H;}function
truncate_sql($Q){return"DELETE FROM ".table($Q);}function
use_sql($j){}function
trigger_sql($Q){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q)));}function
show_variables(){global$g;$H=array();foreach(array("auto_vacuum","cache_size","count_changes","default_cache_size","empty_result_callbacks","encoding","foreign_keys","full_column_names","fullfsync","journal_mode","journal_size_limit","legacy_file_format","locking_mode","page_size","max_page_count","read_uncommitted","recursive_triggers","reverse_unordered_selects","secure_delete","short_column_names","synchronous","temp_store","temp_store_directory","schema_version","integrity_check","quick_check")as$y)$H[$y]=$g->result("PRAGMA $y");return$H;}function
show_status(){$H=array();foreach(get_vals("PRAGMA compile_options")as$Cf){list($y,$X)=explode("=",$Cf,2);$H[$y]=$X;}return$H;}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
support($Vc){return
preg_match('~^(columns|database|drop_col|dump|indexes|descidx|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$Vc);}$x="sqlite";$U=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);$Oh=array_keys($U);$Pi=array();$Af=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");$qd=array("hex","length","lower","round","unixepoch","upper");$wd=array("avg","count","count distinct","group_concat","max","min","sum");$rc=array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",));}$jc["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){$og=array("PgSQL","PDO_PgSQL");define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($Bc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($M,$V,$E){global$b;$l=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($E,"'\\")."'";$this->_link=@pg_connect("$this->_string dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$l!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$fj=pg_version($this->_link);$this->server_info=$fj["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($P){return"'".pg_escape_string($this->_link,$P)."'";}function
value($X,$o){return($o["type"]=="bytea"?pg_unescape_bytea($X):$X);}function
quoteBinary($P){return"'".pg_escape_bytea($this->_link,$P)."'";}function
select_db($j){global$b;if($j==$b->database())return$this->_database;$H=@pg_connect("$this->_string dbname='".addcslashes($j,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($H)$this->_link=$H;return$H;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($F,$Ji=false){$G=@pg_query($this->_link,$F);$this->error="";if(!$G){$this->error=pg_last_error($this->_link);$H=false;}elseif(!pg_num_fields($G)){$this->affected_rows=pg_affected_rows($G);$H=true;}else$H=new
Min_Result($G);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$H;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$o=0){$G=$this->query($F);if(!$G||!$G->num_rows)return
false;return
pg_fetch_result($G->_result,0,$o);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;$this->num_rows=pg_num_rows($G);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$e=$this->_offset++;$H=new
stdClass;if(function_exists('pg_field_table'))$H->orgtable=pg_field_table($this->_result,$e);$H->name=pg_field_name($this->_result,$e);$H->orgname=$H->name;$H->type=pg_field_type($this->_result,$e);$H->charsetnr=($H->type=="bytea"?63:0);return$H;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($M,$V,$E){global$b;$l=$b->database();$this->dsn("pgsql:host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' client_encoding=utf8 dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'",$V,$E);return
true;}function
select_db($j){global$b;return($b->database()==$j);}function
quoteBinary($fh){return
q($fh);}function
query($F,$Ji=false){$H=parent::query($F,$Ji);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$H;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$J,$rg){global$g;foreach($J
as$N){$Qi=array();$Z=array();foreach($N
as$y=>$X){$Qi[]="$y = $X";if(isset($rg[idf_unescape($y)]))$Z[]="$y = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Qi)." WHERE ".implode(" AND ",$Z))&&$g->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).")")))return
false;}return
true;}function
slowQuery($F,$mi){$this->_conn->query("SET statement_timeout = ".(1000*$mi));$this->_conn->timeout=1000*$mi;return$F;}function
convertSearch($u,$X,$o){return(preg_match('~char|text'.(!preg_match('~LIKE~',$X["op"])?'|date|time(stamp)?|boolean|uuid|'.number_type():'').'~',$o["type"])?$u:"CAST($u AS text)");}function
quoteBinary($fh){return$this->_conn->quoteBinary($fh);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($B){$Be=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$_=$Be[$_GET["ns"]];if($_)return"$_-".str_replace("_","-",$B).".html";}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b,$U,$Oh;$g=new
Min_DB;$Lb=$b->credentials();if($g->connect($Lb[0],$Lb[1],$Lb[2])){if(min_version(9,0,$g)){$g->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$g)){$Oh['Strings'][]="json";$U["json"]=4294967295;if(min_version(9.4,0,$g)){$Oh['Strings'][]="jsonb";$U["jsonb"]=4294967295;}}}return$g;}return$g->error;}function
get_databases(){return
get_vals("SELECT datname FROM pg_database WHERE has_database_privilege(datname, 'CONNECT') ORDER BY datname");}function
limit($F,$Z,$z,$C=0,$L=" "){return" $F$Z".($z!==null?$L."LIMIT $z".($C?" OFFSET $C":""):"");}function
limit1($Q,$F,$Z,$L="\n"){return(preg_match('~^INTO~',$F)?limit($F,$Z,1,0,$L):" $F".(is_view(table_status1($Q))?$Z:" WHERE ctid = (SELECT ctid FROM ".table($Q).$Z.$L."LIMIT 1)"));}function
db_collation($l,$pb){global$g;return$g->result("SELECT datcollate FROM pg_database WHERE datname = ".q($l));}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT user");}function
tables_list(){$F="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support('materializedview'))$F.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$F.="
ORDER BY 1";return
get_key_vals($F);}function
count_tables($k){return
array();}function
table_status($B=""){$H=array();foreach(get_rows("SELECT c.relname AS \"Name\", CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\", pg_relation_size(c.oid) AS \"Data_length\", pg_total_relation_size(c.oid) - pg_relation_size(c.oid) AS \"Index_length\", obj_description(c.oid, 'pg_class') AS \"Comment\", ".(min_version(12)?"''":"CASE WHEN c.relhasoids THEN 'oid' ELSE '' END")." AS \"Oid\", c.reltuples as \"Rows\", n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f', 'p')
".($B!=""?"AND relname = ".q($B):"ORDER BY relname"))as$I)$H[$I["Name"]]=$I;return($B!=""?$H[$B]:$H);}function
is_view($R){return
in_array($R["Engine"],array("view","materialized view"));}function
fk_support($R){return
true;}function
fields($Q){$H=array();$Ca=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);$Jd=min_version(10)?'a.attidentity':'0';foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, pg_get_expr(d.adbin, d.adrelid) AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment, $Jd AS identity
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($Q)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$I){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$I["full_type"],$A);list(,$T,$ze,$I["length"],$wa,$Fa)=$A;$I["length"].=$Fa;$eb=$T.$wa;if(isset($Ca[$eb])){$I["type"]=$Ca[$eb];$I["full_type"]=$I["type"].$ze.$Fa;}else{$I["type"]=$T;$I["full_type"]=$I["type"].$ze.$wa.$Fa;}if(in_array($I['identity'],array('a','d')))$I['default']='GENERATED '.($I['identity']=='d'?'BY DEFAULT':'ALWAYS').' AS IDENTITY';$I["null"]=!$I["attnotnull"];$I["auto_increment"]=$I['identity']||preg_match('~^nextval\(~i',$I["default"]);$I["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^)]+(.*)~',$I["default"],$A))$I["default"]=($A[1]=="NULL"?null:(($A[1][0]=="'"?idf_unescape($A[1]):$A[1]).$A[2]));$H[$I["field"]]=$I;}return$H;}function
indexes($Q,$h=null){global$g;if(!is_object($h))$h=$g;$H=array();$Xh=$h->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($Q));$f=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Xh AND attnum > 0",$h);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption , (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Xh AND ci.oid = i.indexrelid",$h)as$I){$Pg=$I["relname"];$H[$Pg]["type"]=($I["indispartial"]?"INDEX":($I["indisprimary"]?"PRIMARY":($I["indisunique"]?"UNIQUE":"INDEX")));$H[$Pg]["columns"]=array();foreach(explode(" ",$I["indkey"])as$Td)$H[$Pg]["columns"][]=$f[$Td];$H[$Pg]["descs"]=array();foreach(explode(" ",$I["indoption"])as$Ud)$H[$Pg]["descs"][]=($Ud&1?'1':null);$H[$Pg]["lengths"]=array();}return$H;}function
foreign_keys($Q){global$wf;$H=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($Q)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$I){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$I['definition'],$A)){$I['source']=array_map('trim',explode(',',$A[1]));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$A[2],$Ie)){$I['ns']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Ie[2]));$I['table']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Ie[4]));}$I['target']=array_map('trim',explode(',',$A[3]));$I['on_delete']=(preg_match("~ON DELETE ($wf)~",$A[4],$Ie)?$Ie[1]:'NO ACTION');$I['on_update']=(preg_match("~ON UPDATE ($wf)~",$A[4],$Ie)?$Ie[1]:'NO ACTION');$H[$I['conname']]=$I;}}return$H;}function
constraints($Q){global$wf;$H=array();foreach(get_rows("SELECT conname, consrc
FROM pg_catalog.pg_constraint
INNER JOIN pg_catalog.pg_namespace ON pg_constraint.connamespace = pg_namespace.oid
INNER JOIN pg_catalog.pg_class ON pg_constraint.conrelid = pg_class.oid AND pg_constraint.connamespace = pg_class.relnamespace
WHERE pg_constraint.contype = 'c'
AND conrelid != 0 -- handle only CONSTRAINTs here, not TYPES
AND nspname = current_schema()
AND relname = ".q($Q)."
ORDER BY connamespace, conname")as$I)$H[$I['conname']]=$I['consrc'];return$H;}function
view($B){global$g;return
array("select"=>trim($g->result("SELECT pg_get_viewdef(".$g->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($B)).")")));}function
collations(){return
array();}function
information_schema($l){return($l=="information_schema");}function
error(){global$g;$H=h($g->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$H,$A))$H=$A[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($A[3]).'})(.*)~','\1<b>\2</b>',$A[2]).$A[4];return
nl_br($H);}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" ENCODING ".idf_escape($d):""));}function
drop_databases($k){global$g;$g->close();return
apply_queries("DROP DATABASE",$k,'idf_escape');}function
rename_database($B,$d){return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($B));}function
auto_increment(){return(min_version(11)?" PRIMARY KEY":"");}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){$c=array();$Bg=array();if($Q!=""&&$Q!=$B)$Bg[]="ALTER TABLE ".table($Q)." RENAME TO ".table($B);foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c[]="DROP $e";else{$bj=$X[5];unset($X[5]);if(isset($X[6])&&$o[0]=="")$X[1]=($X[1]==" bigint"?" big":($X[1]==" smallint"?" small":" "))."serial";if($o[0]=="")$c[]=($Q!=""?"ADD ":"  ").implode($X);else{if($e!=$X[0])$Bg[]="ALTER TABLE ".table($B)." RENAME $e TO $X[0]";$c[]="ALTER $e TYPE$X[1]";if(!$X[6]){$c[]="ALTER $e ".($X[3]?"SET$X[3]":"DROP DEFAULT");$c[]="ALTER $e ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}}if($o[0]!=""||$bj!="")$Bg[]="COMMENT ON COLUMN ".table($B).".$X[0] IS ".($bj!=""?substr($bj,9):"''");}}$c=array_merge($c,$id);if($Q=="")array_unshift($Bg,"CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($Bg,"ALTER TABLE ".table($Q)."\n".implode(",\n",$c));if($Q!=""||$ub!="")$Bg[]="COMMENT ON TABLE ".table($B)." IS ".q($ub);if($Ma!=""){}foreach($Bg
as$F){if(!queries($F))return
false;}return
true;}function
alter_indexes($Q,$c){$i=array();$kc=array();$Bg=array();foreach($c
as$X){if($X[0]!="INDEX")$i[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$kc[]=idf_escape($X[1]);else$Bg[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($i)array_unshift($Bg,"ALTER TABLE ".table($Q).implode(",",$i));if($kc)array_unshift($Bg,"DROP INDEX ".implode(", ",$kc));foreach($Bg
as$F){if(!queries($F))return
false;}return
true;}function
truncate_tables($S){return
queries("TRUNCATE ".implode(", ",array_map('table',$S)));return
true;}function
drop_views($hj){return
drop_tables($hj);}function
drop_tables($S){foreach($S
as$Q){$O=table_status($Q);if(!queries("DROP ".strtoupper($O["Engine"])." ".table($Q)))return
false;}return
true;}function
move_tables($S,$hj,$ei){foreach(array_merge($S,$hj)as$Q){$O=table_status($Q);if(!queries("ALTER ".strtoupper($O["Engine"])." ".table($Q)." SET SCHEMA ".idf_escape($ei)))return
false;}return
true;}function
trigger($B,$Q=null){if($B=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");if($Q===null)$Q=$_GET['trigger'];$J=get_rows('SELECT t.trigger_name AS "Trigger", t.action_timing AS "Timing", (SELECT STRING_AGG(event_manipulation, \' OR \') FROM information_schema.triggers WHERE event_object_table = t.event_object_table AND trigger_name = t.trigger_name ) AS "Events", t.event_manipulation AS "Event", \'FOR EACH \' || t.action_orientation AS "Type", t.action_statement AS "Statement" FROM information_schema.triggers t WHERE t.event_object_table = '.q($Q).' AND t.trigger_name = '.q($B));return
reset($J);}function
triggers($Q){$H=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE event_object_table = ".q($Q))as$I)$H[$I["trigger_name"]]=array($I["action_timing"],$I["event_manipulation"]);return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($B,$T){$J=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($B));$H=$J[0];$H["returns"]=array("type"=>$H["type_udt_name"]);$H["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($B).'
ORDER BY ordinal_position');return$H;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($B,$I){$H=array();foreach($I["fields"]as$o)$H[]=$o["type"];return
idf_escape($B)."(".implode(", ",$H).")";}function
last_id(){return
0;}function
explain($g,$F){return$g->query("EXPLAIN $F");}function
found_rows($R,$Z){global$g;if(preg_match("~ rows=([0-9]+)~",$g->result("EXPLAIN SELECT * FROM ".idf_escape($R["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$Og))return$Og[1];return
false;}function
types(){return
get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$g;return$g->result("SELECT current_schema()");}function
set_schema($hh,$h=null){global$g,$U,$Oh;if(!$h)$h=$g;$H=$h->query("SET search_path TO ".idf_escape($hh));foreach(types()as$T){if(!isset($U[$T])){$U[$T]=0;$Oh['User types'][]=$T;}}return$H;}function
foreign_keys_sql($Q){$H="";$O=table_status($Q);$fd=foreign_keys($Q);ksort($fd);foreach($fd
as$ed=>$dd)$H.="ALTER TABLE ONLY ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." ADD CONSTRAINT ".idf_escape($ed)." $dd[definition] ".($dd['deferrable']?'DEFERRABLE':'NOT DEFERRABLE').";\n";return($H?"$H\n":$H);}function
create_sql($Q,$Ma,$Ph){global$g;$H='';$Xg=array();$rh=array();$O=table_status($Q);if(is_view($O)){$gj=view($Q);return
rtrim("CREATE VIEW ".idf_escape($Q)." AS $gj[select]",";");}$p=fields($Q);$w=indexes($Q);ksort($w);$Cb=constraints($Q);if(!$O||empty($p))return
false;$H="CREATE TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." (\n    ";foreach($p
as$Xc=>$o){$Xf=idf_escape($o['field']).' '.$o['full_type'].default_value($o).($o['attnotnull']?" NOT NULL":"");$Xg[]=$Xf;if(preg_match('~nextval\(\'([^\']+)\'\)~',$o['default'],$Je)){$qh=$Je[1];$Eh=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q($qh):"SELECT * FROM $qh"));$rh[]=($Ph=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $qh;\n":"")."CREATE SEQUENCE $qh INCREMENT $Eh[increment_by] MINVALUE $Eh[min_value] MAXVALUE $Eh[max_value] START ".($Ma?$Eh['last_value']:1)." CACHE $Eh[cache_value];";}}if(!empty($rh))$H=implode("\n\n",$rh)."\n\n$H";foreach($w
as$Od=>$v){switch($v['type']){case'UNIQUE':$Xg[]="CONSTRAINT ".idf_escape($Od)." UNIQUE (".implode(', ',array_map('idf_escape',$v['columns'])).")";break;case'PRIMARY':$Xg[]="CONSTRAINT ".idf_escape($Od)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$v['columns'])).")";break;}}foreach($Cb
as$zb=>$Ab)$Xg[]="CONSTRAINT ".idf_escape($zb)." CHECK $Ab";$H.=implode(",\n    ",$Xg)."\n) WITH (oids = ".($O['Oid']?'true':'false').");";foreach($w
as$Od=>$v){if($v['type']=='INDEX'){$f=array();foreach($v['columns']as$y=>$X)$f[]=idf_escape($X).($v['descs'][$y]?" DESC":"");$H.="\n\nCREATE INDEX ".idf_escape($Od)." ON ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." USING btree (".implode(', ',$f).");";}}if($O['Comment'])$H.="\n\nCOMMENT ON TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." IS ".q($O['Comment']).";";foreach($p
as$Xc=>$o){if($o['comment'])$H.="\n\nCOMMENT ON COLUMN ".idf_escape($O['nspname']).".".idf_escape($O['Name']).".".idf_escape($Xc)." IS ".q($o['comment']).";";}return
rtrim($H,';');}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
trigger_sql($Q){$O=table_status($Q);$H="";foreach(triggers($Q)as$Ci=>$Bi){$Di=trigger($Ci,$O['Name']);$H.="\nCREATE TRIGGER ".idf_escape($Di['Trigger'])." $Di[Timing] $Di[Events] ON ".idf_escape($O["nspname"]).".".idf_escape($O['Name'])." $Di[Type] $Di[Statement];;\n";}return$H;}function
use_sql($j){return"\connect ".idf_escape($j);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
support($Vc){return
preg_match('~^(database|table|columns|sql|indexes|descidx|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$Vc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$g;return$g->result("SHOW max_connections");}$x="pgsql";$U=array();$Oh=array();foreach(array('Numbers'=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),'Date and time'=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),'Strings'=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),'Binary'=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),'Network'=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"txid_snapshot"=>0),'Geometry'=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$y=>$X){$U+=$X;$Oh[$y]=array_keys($X);}$Pi=array();$Af=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$qd=array("char_length","lower","round","to_hex","to_timestamp","upper");$wd=array("avg","count","count distinct","max","min","sum");$rc=array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",));}$jc["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){$og=array("OCI8","PDO_OCI");define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_error($Bc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($M,$V,$E){$this->_link=@oci_new_connect($V,$E,$M,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$n=oci_error();$this->error=$n["message"];return
false;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($j){return
true;}function
query($F,$Ji=false){$G=oci_parse($this->_link,$F);$this->error="";if(!$G){$n=oci_error($this->_link);$this->errno=$n["code"];$this->error=$n["message"];return
false;}set_error_handler(array($this,'_error'));$H=@oci_execute($G);restore_error_handler();if($H){if(oci_num_fields($G))return
new
Min_Result($G);$this->affected_rows=oci_num_rows($G);}return$H;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$o=1){$G=$this->query($F);if(!is_object($G)||!oci_fetch($G->_result))return
false;return
oci_result($G->_result,$o);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($G){$this->_result=$G;}function
_convert($I){foreach((array)$I
as$y=>$X){if(is_a($X,'OCI-Lob'))$I[$y]=$X->load();}return$I;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$e=$this->_offset++;$H=new
stdClass;$H->name=oci_field_name($this->_result,$e);$H->orgname=$H->name;$H->type=oci_field_type($this->_result,$e);$H->charsetnr=(preg_match("~raw|blob|bfile~",$H->type)?63:0);return$H;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";function
connect($M,$V,$E){$this->dsn("oci:dbname=//$M;charset=AL32UTF8",$V,$E);return
true;}function
select_db($j){return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$Lb=$b->credentials();if($g->connect($Lb[0],$Lb[1],$Lb[2]))return$g;return$g->error;}function
get_databases(){return
get_vals("SELECT tablespace_name FROM user_tablespaces");}function
limit($F,$Z,$z,$C=0,$L=" "){return($C?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $F$Z) t WHERE rownum <= ".($z+$C).") WHERE rnum > $C":($z!==null?" * FROM (SELECT $F$Z) WHERE rownum <= ".($z+$C):" $F$Z"));}function
limit1($Q,$F,$Z,$L="\n"){return" $F$Z";}function
db_collation($l,$pb){global$g;return$g->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT USER FROM DUAL");}function
tables_list(){return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."
UNION SELECT view_name, 'view' FROM user_views
ORDER BY 1");}function
count_tables($k){return
array();}function
table_status($B=""){$H=array();$jh=q($B);foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q(DB).($B!=""?" AND table_name = $jh":"")."
UNION SELECT view_name, 'view', 0, 0 FROM user_views".($B!=""?" WHERE view_name = $jh":"")."
ORDER BY 1")as$I){if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){return
true;}function
fields($Q){$H=array();foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($Q)." ORDER BY column_id")as$I){$T=$I["DATA_TYPE"];$ze="$I[DATA_PRECISION],$I[DATA_SCALE]";if($ze==",")$ze=$I["DATA_LENGTH"];$H[$I["COLUMN_NAME"]]=array("field"=>$I["COLUMN_NAME"],"full_type"=>$T.($ze?"($ze)":""),"type"=>strtolower($T),"length"=>$ze,"default"=>$I["DATA_DEFAULT"],"null"=>($I["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$H;}function
indexes($Q,$h=null){$H=array();foreach(get_rows("SELECT uic.*, uc.constraint_type
FROM user_ind_columns uic
LEFT JOIN user_constraints uc ON uic.index_name = uc.constraint_name AND uic.table_name = uc.table_name
WHERE uic.table_name = ".q($Q)."
ORDER BY uc.constraint_type, uic.column_position",$h)as$I){$Od=$I["INDEX_NAME"];$H[$Od]["type"]=($I["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($I["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$H[$Od]["columns"][]=$I["COLUMN_NAME"];$H[$Od]["lengths"][]=($I["CHAR_LENGTH"]&&$I["CHAR_LENGTH"]!=$I["COLUMN_LENGTH"]?$I["CHAR_LENGTH"]:null);$H[$Od]["descs"][]=($I["DESCEND"]?'1':null);}return$H;}function
view($B){$J=get_rows('SELECT text "select" FROM user_views WHERE view_name = '.q($B));return
reset($J);}function
collations(){return
array();}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
explain($g,$F){$g->query("EXPLAIN PLAN FOR $F");return$g->query("SELECT * FROM plan_table");}function
found_rows($R,$Z){}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){$c=$kc=array();foreach($p
as$o){$X=$o[1];if($X&&$o[0]!=""&&idf_escape($o[0])!=$X[0])queries("ALTER TABLE ".table($Q)." RENAME COLUMN ".idf_escape($o[0])." TO $X[0]");if($X)$c[]=($Q!=""?($o[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($Q!=""?")":"");else$kc[]=idf_escape($o[0]);}if($Q=="")return
queries("CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($Q)."\n".implode("\n",$c)))&&(!$kc||queries("ALTER TABLE ".table($Q)." DROP (".implode(", ",$kc).")"))&&($Q==$B||queries("ALTER TABLE ".table($Q)." RENAME TO ".table($B)));}function
foreign_keys($Q){$H=array();$F="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($Q);foreach(get_rows($F)as$I)$H[$I['NAME']]=array("db"=>$I['DEST_DB'],"table"=>$I['DEST_TABLE'],"source"=>array($I['SRC_COLUMN']),"target"=>array($I['DEST_COLUMN']),"on_delete"=>$I['ON_DELETE'],"on_update"=>null,);return$H;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($hj){return
apply_queries("DROP VIEW",$hj);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
last_id(){return
0;}function
schemas(){return
get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX'))");}function
get_schema(){global$g;return$g->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($ih,$h=null){global$g;if(!$h)$h=$g;return$h->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($ih));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$J=get_rows('SELECT * FROM v$instance');return
reset($J);}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
support($Vc){return
preg_match('~^(columns|database|drop_col|indexes|descidx|processlist|scheme|sql|status|table|variables|view|view_trigger)$~',$Vc);}$x="oracle";$U=array();$Oh=array();foreach(array('Numbers'=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),'Date and time'=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),'Strings'=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),'Binary'=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$y=>$X){$U+=$X;$Oh[$y]=array_keys($X);}$Pi=array();$Af=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$qd=array("length","lower","round","upper");$wd=array("avg","count","count distinct","max","min","sum");$rc=array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",));}$jc["mssql"]="MS SQL (beta)";if(isset($_GET["mssql"])){$og=array("SQLSRV","MSSQL","PDO_DBLIB");define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$n){$this->errno=$n["code"];$this->error.="$n[message]\n";}$this->error=rtrim($this->error);}function
connect($M,$V,$E){global$b;$l=$b->database();$_b=array("UID"=>$V,"PWD"=>$E,"CharacterSet"=>"UTF-8");if($l!="")$_b["Database"]=$l;$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$M),$_b);if($this->_link){$Vd=sqlsrv_server_info($this->_link);$this->server_info=$Vd['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($F,$Ji=false){$G=sqlsrv_query($this->_link,$F);$this->error="";if(!$G){$this->_get_error();return
false;}return$this->store_result($G);}function
multi_query($F){$this->_result=sqlsrv_query($this->_link,$F);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($G=null){if(!$G)$G=$this->_result;if(!$G)return
false;if(sqlsrv_field_metadata($G))return
new
Min_Result($G);$this->affected_rows=sqlsrv_rows_affected($G);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($F,$o=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->fetch_row();return$I[$o];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($G){$this->_result=$G;}function
_convert($I){foreach((array)$I
as$y=>$X){if(is_a($X,'DateTime'))$I[$y]=$X->format("Y-m-d H:i:s");}return$I;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$o=$this->_fields[$this->_offset++];$H=new
stdClass;$H->name=$o["Name"];$H->orgname=$o["Name"];$H->type=($o["Type"]==1?254:0);return$H;}function
seek($C){for($s=0;$s<$C;$s++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($M,$V,$E){$this->_link=@mssql_connect($M,$V,$E);if($this->_link){$G=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($G){$I=$G->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$I[0]] $I[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($j){return
mssql_select_db($j);}function
query($F,$Ji=false){$G=@mssql_query($F,$this->_link);$this->error="";if(!$G){$this->error=mssql_get_last_message();return
false;}if($G===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($F,$o=0){$G=$this->query($F);if(!is_object($G))return
false;return
mssql_result($G->_result,0,$o);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($G){$this->_result=$G;$this->num_rows=mssql_num_rows($G);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$H=mssql_fetch_field($this->_result);$H->orgtable=$H->table;$H->orgname=$H->name;return$H;}function
seek($C){mssql_data_seek($this->_result,$C);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($M,$V,$E){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$E);return
true;}function
select_db($j){return$this->query("USE ".idf_escape($j));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$J,$rg){foreach($J
as$N){$Qi=array();$Z=array();foreach($N
as$y=>$X){$Qi[]="$y = $X";if(isset($rg[idf_unescape($y)]))$Z[]="$y = $X";}if(!queries("MERGE ".table($Q)." USING (VALUES(".implode(", ",$N).")) AS source (c".implode(", c",range(1,count($N))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Qi)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($u){return"[".str_replace("]","]]",$u)."]";}function
table($u){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$Lb=$b->credentials();if($g->connect($Lb[0],$Lb[1],$Lb[2]))return$g;return$g->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($F,$Z,$z,$C=0,$L=" "){return($z!==null?" TOP (".($z+$C).")":"")." $F$Z";}function
limit1($Q,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($l,$pb){global$g;return$g->result("SELECT collation_name FROM sys.databases WHERE name = ".q($l));}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($k){global$g;$H=array();foreach($k
as$l){$g->select_db($l);$H[$l]=$g->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$H;}function
table_status($B=""){$H=array();foreach(get_rows("SELECT ao.name AS Name, ao.type_desc AS Engine, (SELECT value FROM fn_listextendedproperty(default, 'SCHEMA', schema_name(schema_id), 'TABLE', ao.name, null, null)) AS Comment FROM sys.all_objects AS ao WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($B!=""?"AND name = ".q($B):"ORDER BY name"))as$I){if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($R){return$R["Engine"]=="VIEW";}function
fk_support($R){return
true;}function
fields($Q){$wb=get_key_vals("SELECT objname, cast(value as varchar(max)) FROM fn_listextendedproperty('MS_DESCRIPTION', 'schema', ".q(get_schema()).", 'table', ".q($Q).", 'column', NULL)");$H=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($Q))as$I){$T=$I["type"];$ze=(preg_match("~char|binary~",$T)?$I["max_length"]:($T=="decimal"?"$I[precision],$I[scale]":""));$H[$I["name"]]=array("field"=>$I["name"],"full_type"=>$T.($ze?"($ze)":""),"type"=>$T,"length"=>$ze,"default"=>$I["default"],"null"=>$I["is_nullable"],"auto_increment"=>$I["is_identity"],"collation"=>$I["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$I["is_identity"],"comment"=>$wb[$I["name"]],);}return$H;}function
indexes($Q,$h=null){$H=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($Q),$h)as$I){$B=$I["name"];$H[$B]["type"]=($I["is_primary_key"]?"PRIMARY":($I["is_unique"]?"UNIQUE":"INDEX"));$H[$B]["lengths"]=array();$H[$B]["columns"][$I["key_ordinal"]]=$I["column_name"];$H[$B]["descs"][$I["key_ordinal"]]=($I["is_descending_key"]?'1':null);}return$H;}function
view($B){global$g;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$g->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($B))));}function
collations(){$H=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$d)$H[preg_replace('~_.*~','',$d)][]=$d;return$H;}function
information_schema($l){return
false;}function
error(){global$g;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$g->error)));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).(preg_match('~^[a-z0-9_]+$~i',$d)?" COLLATE $d":""));}function
drop_databases($k){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$k)));}function
rename_database($B,$d){if(preg_match('~^[a-z0-9_]+$~i',$d))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $d");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($B));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){$c=array();$wb=array();foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c["DROP"][]=" COLUMN $e";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);$wb[$o[0]]=$X[5];unset($X[5]);if($o[0]=="")$c["ADD"][]="\n  ".implode("",$X).($Q==""?substr($id[$X[0]],16+strlen($X[0])):"");else{unset($X[6]);if($e!=$X[0])queries("EXEC sp_rename ".q(table($Q).".$e").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";}}}if($Q=="")return
queries("CREATE TABLE ".table($B)." (".implode(",",(array)$c["ADD"])."\n)");if($Q!=$B)queries("EXEC sp_rename ".q(table($Q)).", ".q($B));if($id)$c[""]=$id;foreach($c
as$y=>$X){if(!queries("ALTER TABLE ".idf_escape($B)." $y".implode(",",$X)))return
false;}foreach($wb
as$y=>$X){$ub=substr($X,9);queries("EXEC sp_dropextendedproperty @name = N'MS_Description', @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table',  @level1name = ".q($B).", @level2type = N'Column', @level2name = ".q($y));queries("EXEC sp_addextendedproperty @name = N'MS_Description', @value = ".$ub.", @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table',  @level1name = ".q($B).", @level2type = N'Column', @level2name = ".q($y));}return
true;}function
alter_indexes($Q,$c){$v=array();$kc=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$kc[]=idf_escape($X[1]);else$v[]=idf_escape($X[1])." ON ".table($Q);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q):"ALTER TABLE ".table($Q)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$v||queries("DROP INDEX ".implode(", ",$v)))&&(!$kc||queries("ALTER TABLE ".table($Q)." DROP ".implode(", ",$kc)));}function
last_id(){global$g;return$g->result("SELECT SCOPE_IDENTITY()");}function
explain($g,$F){$g->query("SET SHOWPLAN_ALL ON");$H=$g->query($F);$g->query("SET SHOWPLAN_ALL OFF");return$H;}function
found_rows($R,$Z){}function
foreign_keys($Q){$H=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($Q))as$I){$q=&$H[$I["FK_NAME"]];$q["db"]=$I["PKTABLE_QUALIFIER"];$q["table"]=$I["PKTABLE_NAME"];$q["source"][]=$I["FKCOLUMN_NAME"];$q["target"][]=$I["PKCOLUMN_NAME"];}return$H;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($hj){return
queries("DROP VIEW ".implode(", ",array_map('table',$hj)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$hj,$ei){return
apply_queries("ALTER SCHEMA ".idf_escape($ei)." TRANSFER",array_merge($S,$hj));}function
trigger($B){if($B=="")return
array();$J=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($B));$H=reset($J);if($H)$H["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$H["text"]);return$H;}function
triggers($Q){$H=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($Q))as$I)$H[$I["name"]]=array($I["Timing"],$I["Event"]);return$H;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$g;if($_GET["ns"]!="")return$_GET["ns"];return$g->result("SELECT SCHEMA_NAME()");}function
set_schema($hh){return
true;}function
use_sql($j){return"USE ".idf_escape($j);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
support($Vc){return
preg_match('~^(comment|columns|database|drop_col|indexes|descidx|scheme|sql|table|trigger|view|view_trigger)$~',$Vc);}$x="mssql";$U=array();$Oh=array();foreach(array('Numbers'=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),'Date and time'=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),'Strings'=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),'Binary'=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$y=>$X){$U+=$X;$Oh[$y]=array_keys($X);}$Pi=array();$Af=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$qd=array("len","lower","round","upper");$wd=array("avg","count","count distinct","max","min","sum");$rc=array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",));}$jc['firebird']='Firebird (alpha)';if(isset($_GET["firebird"])){$og=array("interbase");define("DRIVER","firebird");if(extension_loaded("interbase")){class
Min_DB{var$extension="Firebird",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($M,$V,$E){$this->_link=ibase_connect($M,$V,$E);if($this->_link){$Ti=explode(':',$M);$this->service_link=ibase_service_attach($Ti[0],$V,$E);$this->server_info=ibase_server_info($this->service_link,IBASE_SVC_SERVER_VERSION);}else{$this->errno=ibase_errcode();$this->error=ibase_errmsg();}return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($j){return($j=="domain");}function
query($F,$Ji=false){$G=ibase_query($F,$this->_link);if(!$G){$this->errno=ibase_errcode();$this->error=ibase_errmsg();return
false;}$this->error="";if($G===true){$this->affected_rows=ibase_affected_rows($this->_link);return
true;}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$o=0){$G=$this->query($F);if(!$G||!$G->num_rows)return
false;$I=$G->fetch_row();return$I[$o];}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($G){$this->_result=$G;}function
fetch_assoc(){return
ibase_fetch_assoc($this->_result);}function
fetch_row(){return
ibase_fetch_row($this->_result);}function
fetch_field(){$o=ibase_field_info($this->_result,$this->_offset++);return(object)array('name'=>$o['name'],'orgname'=>$o['name'],'type'=>$o['type'],'charsetnr'=>$o['length'],);}function
__destruct(){ibase_free_result($this->_result);}}}class
Min_Driver
extends
Min_SQL{}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$Lb=$b->credentials();if($g->connect($Lb[0],$Lb[1],$Lb[2]))return$g;return$g->error;}function
get_databases($gd){return
array("domain");}function
limit($F,$Z,$z,$C=0,$L=" "){$H='';$H.=($z!==null?$L."FIRST $z".($C?" SKIP $C":""):"");$H.=" $F$Z";return$H;}function
limit1($Q,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($l,$pb){}function
engines(){return
array();}function
logged_user(){global$b;$Lb=$b->credentials();return$Lb[1];}function
tables_list(){global$g;$F='SELECT RDB$RELATION_NAME FROM rdb$relations WHERE rdb$system_flag = 0';$G=ibase_query($g->_link,$F);$H=array();while($I=ibase_fetch_assoc($G))$H[$I['RDB$RELATION_NAME']]='table';ksort($H);return$H;}function
count_tables($k){return
array();}function
table_status($B="",$Uc=false){global$g;$H=array();$Qb=tables_list();foreach($Qb
as$v=>$X){$v=trim($v);$H[$v]=array('Name'=>$v,'Engine'=>'standard',);if($B==$v)return$H[$v];}return$H;}function
is_view($R){return
false;}function
fk_support($R){return
preg_match('~InnoDB|IBMDB2I~i',$R["Engine"]);}function
fields($Q){global$g;$H=array();$F='SELECT r.RDB$FIELD_NAME AS field_name,
r.RDB$DESCRIPTION AS field_description,
r.RDB$DEFAULT_VALUE AS field_default_value,
r.RDB$NULL_FLAG AS field_not_null_constraint,
f.RDB$FIELD_LENGTH AS field_length,
f.RDB$FIELD_PRECISION AS field_precision,
f.RDB$FIELD_SCALE AS field_scale,
CASE f.RDB$FIELD_TYPE
WHEN 261 THEN \'BLOB\'
WHEN 14 THEN \'CHAR\'
WHEN 40 THEN \'CSTRING\'
WHEN 11 THEN \'D_FLOAT\'
WHEN 27 THEN \'DOUBLE\'
WHEN 10 THEN \'FLOAT\'
WHEN 16 THEN \'INT64\'
WHEN 8 THEN \'INTEGER\'
WHEN 9 THEN \'QUAD\'
WHEN 7 THEN \'SMALLINT\'
WHEN 12 THEN \'DATE\'
WHEN 13 THEN \'TIME\'
WHEN 35 THEN \'TIMESTAMP\'
WHEN 37 THEN \'VARCHAR\'
ELSE \'UNKNOWN\'
END AS field_type,
f.RDB$FIELD_SUB_TYPE AS field_subtype,
coll.RDB$COLLATION_NAME AS field_collation,
cset.RDB$CHARACTER_SET_NAME AS field_charset
FROM RDB$RELATION_FIELDS r
LEFT JOIN RDB$FIELDS f ON r.RDB$FIELD_SOURCE = f.RDB$FIELD_NAME
LEFT JOIN RDB$COLLATIONS coll ON f.RDB$COLLATION_ID = coll.RDB$COLLATION_ID
LEFT JOIN RDB$CHARACTER_SETS cset ON f.RDB$CHARACTER_SET_ID = cset.RDB$CHARACTER_SET_ID
WHERE r.RDB$RELATION_NAME = '.q($Q).'
ORDER BY r.RDB$FIELD_POSITION';$G=ibase_query($g->_link,$F);while($I=ibase_fetch_assoc($G))$H[trim($I['FIELD_NAME'])]=array("field"=>trim($I["FIELD_NAME"]),"full_type"=>trim($I["FIELD_TYPE"]),"type"=>trim($I["FIELD_SUB_TYPE"]),"default"=>trim($I['FIELD_DEFAULT_VALUE']),"null"=>(trim($I["FIELD_NOT_NULL_CONSTRAINT"])=="YES"),"auto_increment"=>'0',"collation"=>trim($I["FIELD_COLLATION"]),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"comment"=>trim($I["FIELD_DESCRIPTION"]),);return$H;}function
indexes($Q,$h=null){$H=array();return$H;}function
foreign_keys($Q){return
array();}function
collations(){return
array();}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($hh){return
true;}function
support($Vc){return
preg_match("~^(columns|sql|status|table)$~",$Vc);}$x="firebird";$Af=array("=");$qd=array();$wd=array();$rc=array();}$jc["simpledb"]="SimpleDB";if(isset($_GET["simpledb"])){$og=array("SimpleXML + allow_url_fopen");define("DRIVER","simpledb");if(class_exists('SimpleXMLElement')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="SimpleXML",$server_info='2009-04-15',$error,$timeout,$next,$affected_rows,$_result;function
select_db($j){return($j=="domain");}function
query($F,$Ji=false){$Uf=array('SelectExpression'=>$F,'ConsistentRead'=>'true');if($this->next)$Uf['NextToken']=$this->next;$G=sdb_request_all('Select','Item',$Uf,$this->timeout);$this->timeout=0;if($G===false)return$G;if(preg_match('~^\s*SELECT\s+COUNT\(~i',$F)){$Sh=0;foreach($G
as$he)$Sh+=$he->Attribute->Value;$G=array((object)array('Attribute'=>array((object)array('Name'=>'Count','Value'=>$Sh,))));}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
quote($P){return"'".str_replace("'","''",$P)."'";}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0;function
__construct($G){foreach($G
as$he){$I=array();if($he->Name!='')$I['itemName()']=(string)$he->Name;foreach($he->Attribute
as$Ia){$B=$this->_processValue($Ia->Name);$Y=$this->_processValue($Ia->Value);if(isset($I[$B])){$I[$B]=(array)$I[$B];$I[$B][]=$Y;}else$I[$B]=$Y;}$this->_rows[]=$I;foreach($I
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=count($this->_rows);}function
_processValue($uc){return(is_object($uc)&&$uc['encoding']=='base64'?base64_decode($uc):(string)$uc);}function
fetch_assoc(){$I=current($this->_rows);if(!$I)return$I;$H=array();foreach($this->_rows[0]as$y=>$X)$H[$y]=$I[$y];next($this->_rows);return$H;}function
fetch_row(){$H=$this->fetch_assoc();if(!$H)return$H;return
array_values($H);}function
fetch_field(){$ne=array_keys($this->_rows[0]);return(object)array('name'=>$ne[$this->_offset++]);}}}class
Min_Driver
extends
Min_SQL{public$rg="itemName()";function
_chunkRequest($Kd,$va,$Uf,$Kc=array()){global$g;foreach(array_chunk($Kd,25)as$ib){$Vf=$Uf;foreach($ib
as$s=>$t){$Vf["Item.$s.ItemName"]=$t;foreach($Kc
as$y=>$X)$Vf["Item.$s.$y"]=$X;}if(!sdb_request($va,$Vf))return
false;}$g->affected_rows=count($Kd);return
true;}function
_extractIds($Q,$Cg,$z){$H=array();if(preg_match_all("~itemName\(\) = (('[^']*+')+)~",$Cg,$Je))$H=array_map('idf_unescape',$Je[1]);else{foreach(sdb_request_all('Select','Item',array('SelectExpression'=>'SELECT itemName() FROM '.table($Q).$Cg.($z?" LIMIT 1":"")))as$he)$H[]=$he->Name;}return$H;}function
select($Q,$K,$Z,$td,$Ff=array(),$z=1,$D=0,$tg=false){global$g;$g->next=$_GET["next"];$H=parent::select($Q,$K,$Z,$td,$Ff,$z,$D,$tg);$g->next=0;return$H;}function
delete($Q,$Cg,$z=0){return$this->_chunkRequest($this->_extractIds($Q,$Cg,$z),'BatchDeleteAttributes',array('DomainName'=>$Q));}function
update($Q,$N,$Cg,$z=0,$L="\n"){$ac=array();$Zd=array();$s=0;$Kd=$this->_extractIds($Q,$Cg,$z);$t=idf_unescape($N["`itemName()`"]);unset($N["`itemName()`"]);foreach($N
as$y=>$X){$y=idf_unescape($y);if($X=="NULL"||($t!=""&&array($t)!=$Kd))$ac["Attribute.".count($ac).".Name"]=$y;if($X!="NULL"){foreach((array)$X
as$je=>$W){$Zd["Attribute.$s.Name"]=$y;$Zd["Attribute.$s.Value"]=(is_array($X)?$W:idf_unescape($W));if(!$je)$Zd["Attribute.$s.Replace"]="true";$s++;}}}$Uf=array('DomainName'=>$Q);return(!$Zd||$this->_chunkRequest(($t!=""?array($t):$Kd),'BatchPutAttributes',$Uf,$Zd))&&(!$ac||$this->_chunkRequest($Kd,'BatchDeleteAttributes',$Uf,$ac));}function
insert($Q,$N){$Uf=array("DomainName"=>$Q);$s=0;foreach($N
as$B=>$Y){if($Y!="NULL"){$B=idf_unescape($B);if($B=="itemName()")$Uf["ItemName"]=idf_unescape($Y);else{foreach((array)$Y
as$X){$Uf["Attribute.$s.Name"]=$B;$Uf["Attribute.$s.Value"]=(is_array($Y)?$X:idf_unescape($Y));$s++;}}}}return
sdb_request('PutAttributes',$Uf);}function
insertUpdate($Q,$J,$rg){foreach($J
as$N){if(!$this->update($Q,$N,"WHERE `itemName()` = ".q($N["`itemName()`"])))return
false;}return
true;}function
begin(){return
false;}function
commit(){return
false;}function
rollback(){return
false;}function
slowQuery($F,$mi){$this->_conn->timeout=$mi;return$F;}}function
connect(){global$b;list(,,$E)=$b->credentials();if($E!="")return'Database does not support password.';return
new
Min_DB;}function
support($Vc){return
preg_match('~sql~',$Vc);}function
logged_user(){global$b;$Lb=$b->credentials();return$Lb[1];}function
get_databases(){return
array("domain");}function
collations(){return
array();}function
db_collation($l,$pb){}function
tables_list(){global$g;$H=array();foreach(sdb_request_all('ListDomains','DomainName')as$Q)$H[(string)$Q]='table';if($g->error&&defined("PAGE_HEADER"))echo"<p class='error'>".error()."\n";return$H;}function
table_status($B="",$Uc=false){$H=array();foreach(($B!=""?array($B=>true):tables_list())as$Q=>$T){$I=array("Name"=>$Q,"Auto_increment"=>"");if(!$Uc){$We=sdb_request('DomainMetadata',array('DomainName'=>$Q));if($We){foreach(array("Rows"=>"ItemCount","Data_length"=>"ItemNamesSizeBytes","Index_length"=>"AttributeValuesSizeBytes","Data_free"=>"AttributeNamesSizeBytes",)as$y=>$X)$I[$y]=(string)$We->$X;}}if($B!="")return$I;$H[$Q]=$I;}return$H;}function
explain($g,$F){}function
error(){global$g;return
h($g->error);}function
information_schema(){}function
is_view($R){}function
indexes($Q,$h=null){return
array(array("type"=>"PRIMARY","columns"=>array("itemName()")),);}function
fields($Q){return
fields_from_edit();}function
foreign_keys($Q){return
array();}function
table($u){return
idf_escape($u);}function
idf_escape($u){return"`".str_replace("`","``",$u)."`";}function
limit($F,$Z,$z,$C=0,$L=" "){return" $F$Z".($z!==null?$L."LIMIT $z":"");}function
unconvert_field($o,$H){return$H;}function
fk_support($R){}function
engines(){return
array();}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){return($Q==""&&sdb_request('CreateDomain',array('DomainName'=>$B)));}function
drop_tables($S){foreach($S
as$Q){if(!sdb_request('DeleteDomain',array('DomainName'=>$Q)))return
false;}return
true;}function
count_tables($k){foreach($k
as$l)return
array($l=>count(tables_list()));}function
found_rows($R,$Z){return($Z?null:$R["Rows"]);}function
last_id(){}function
hmac($Ba,$Qb,$y,$Gg=false){$Va=64;if(strlen($y)>$Va)$y=pack("H*",$Ba($y));$y=str_pad($y,$Va,"\0");$ke=$y^str_repeat("\x36",$Va);$le=$y^str_repeat("\x5C",$Va);$H=$Ba($le.pack("H*",$Ba($ke.$Qb)));if($Gg)$H=pack("H*",$H);return$H;}function
sdb_request($va,$Uf=array()){global$b,$g;list($Gd,$Uf['AWSAccessKeyId'],$kh)=$b->credentials();$Uf['Action']=$va;$Uf['Timestamp']=gmdate('Y-m-d\TH:i:s+00:00');$Uf['Version']='2009-04-15';$Uf['SignatureVersion']=2;$Uf['SignatureMethod']='HmacSHA1';ksort($Uf);$F='';foreach($Uf
as$y=>$X)$F.='&'.rawurlencode($y).'='.rawurlencode($X);$F=str_replace('%7E','~',substr($F,1));$F.="&Signature=".urlencode(base64_encode(hmac('sha1',"POST\n".preg_replace('~^https?://~','',$Gd)."\n/\n$F",$kh,true)));@ini_set('track_errors',1);$Zc=@file_get_contents((preg_match('~^https?://~',$Gd)?$Gd:"http://$Gd"),false,stream_context_create(array('http'=>array('method'=>'POST','content'=>$F,'ignore_errors'=>1,))));if(!$Zc){$g->error=$php_errormsg;return
false;}libxml_use_internal_errors(true);$uj=simplexml_load_string($Zc);if(!$uj){$n=libxml_get_last_error();$g->error=$n->message;return
false;}if($uj->Errors){$n=$uj->Errors->Error;$g->error="$n->Message ($n->Code)";return
false;}$g->error='';$di=$va."Result";return($uj->$di?$uj->$di:true);}function
sdb_request_all($va,$di,$Uf=array(),$mi=0){$H=array();$Kh=($mi?microtime(true):0);$z=(preg_match('~LIMIT\s+(\d+)\s*$~i',$Uf['SelectExpression'],$A)?$A[1]:0);do{$uj=sdb_request($va,$Uf);if(!$uj)break;foreach($uj->$di
as$uc)$H[]=$uc;if($z&&count($H)>=$z){$_GET["next"]=$uj->NextToken;break;}if($mi&&microtime(true)-$Kh>$mi)return
false;$Uf['NextToken']=$uj->NextToken;if($z)$Uf['SelectExpression']=preg_replace('~\d+\s*$~',$z-count($H),$Uf['SelectExpression']);}while($uj->NextToken);return$H;}$x="simpledb";$Af=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","IS NOT NULL");$qd=array();$wd=array("count");$rc=array(array("json"));}$jc["mongo"]="MongoDB";if(isset($_GET["mongo"])){$og=array("mongo","mongodb");define("DRIVER","mongo");if(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Ri,$Df){$kb='MongoDB\Driver\Manager';return
new$kb($Ri,$Df);}function
query($F){return
false;}function
select_db($j){$this->_db_name=$j;return
true;}function
quote($P){return$P;}function
ping($_){$kb='MongoDB\Driver\Command';$_->executeCommand('admin',new$kb(array('ping'=>1)));}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($G){foreach($G
as$he){$I=array();foreach($he
as$y=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$y]=63;$I[$y]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'.strval($X).'")':(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->bin:(is_a($X,'MongoDB\BSON\Regex')?strval($X):(is_object($X)?json_encode($X,256):$X)))));}$this->_rows[]=$I;foreach($I
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=$G->count;}function
fetch_assoc(){$I=current($this->_rows);if(!$I)return$I;$H=array();foreach($this->_rows[0]as$y=>$X)$H[$y]=$I[$y];next($this->_rows);return$H;}function
fetch_row(){$H=$this->fetch_assoc();if(!$H)return$H;return
array_values($H);}function
fetch_field(){$ne=array_keys($this->_rows[0]);$B=$ne[$this->_offset++];return(object)array('name'=>$B,'charsetnr'=>$this->_charset[$B],);}}class
Min_Driver
extends
Min_SQL{public$rg="_id";function
select($Q,$K,$Z,$td,$Ff=array(),$z=1,$D=0,$tg=false){global$g;$K=($K==array("*")?array():array_fill_keys($K,1));if(count($K)&&!isset($K['_id']))$K['_id']=0;$Z=where_to_query($Z);$Bh=array();foreach($Ff
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Ib);$Bh[$X]=($Ib?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$z=$_GET['limit'];$z=min(200,max(1,(int)$z));$zh=$D*$z;$kb='MongoDB\Driver\Query';$F=new$kb($Z,array('projection'=>$K,'limit'=>$z,'skip'=>$zh,'sort'=>$Bh));$Wg=$g->_link->executeQuery("$g->_db_name.$Q",$F);return
new
Min_Result($Wg);}function
update($Q,$N,$Cg,$z=0,$L="\n"){global$g;$l=$g->_db_name;$Z=sql_query_where_parser($Cg);$kb='MongoDB\Driver\BulkWrite';$Za=new$kb(array());if(isset($N['_id']))unset($N['_id']);$Qg=array();foreach($N
as$y=>$Y){if($Y=='NULL'){$Qg[$y]=1;unset($N[$y]);}}$Qi=array('$set'=>$N);if(count($Qg))$Qi['$unset']=$Qg;$Za->update($Z,$Qi,array('upsert'=>false));$Wg=$g->_link->executeBulkWrite("$l.$Q",$Za);$g->affected_rows=$Wg->getModifiedCount();return
true;}function
delete($Q,$Cg,$z=0){global$g;$l=$g->_db_name;$Z=sql_query_where_parser($Cg);$kb='MongoDB\Driver\BulkWrite';$Za=new$kb(array());$Za->delete($Z,array('limit'=>$z));$Wg=$g->_link->executeBulkWrite("$l.$Q",$Za);$g->affected_rows=$Wg->getDeletedCount();return
true;}function
insert($Q,$N){global$g;$l=$g->_db_name;$kb='MongoDB\Driver\BulkWrite';$Za=new$kb(array());if(isset($N['_id'])&&empty($N['_id']))unset($N['_id']);$Za->insert($N);$Wg=$g->_link->executeBulkWrite("$l.$Q",$Za);$g->affected_rows=$Wg->getInsertedCount();return
true;}}function
get_databases($gd){global$g;$H=array();$kb='MongoDB\Driver\Command';$sb=new$kb(array('listDatabases'=>1));$Wg=$g->_link->executeCommand('admin',$sb);foreach($Wg
as$Vb){foreach($Vb->databases
as$l)$H[]=$l->name;}return$H;}function
count_tables($k){$H=array();return$H;}function
tables_list(){global$g;$kb='MongoDB\Driver\Command';$sb=new$kb(array('listCollections'=>1));$Wg=$g->_link->executeCommand($g->_db_name,$sb);$qb=array();foreach($Wg
as$G)$qb[$G->name]='table';return$qb;}function
drop_databases($k){return
false;}function
indexes($Q,$h=null){global$g;$H=array();$kb='MongoDB\Driver\Command';$sb=new$kb(array('listIndexes'=>$Q));$Wg=$g->_link->executeCommand($g->_db_name,$sb);foreach($Wg
as$v){$dc=array();$f=array();foreach(get_object_vars($v->key)as$e=>$T){$dc[]=($T==-1?'1':null);$f[]=$e;}$H[$v->name]=array("type"=>($v->name=="_id_"?"PRIMARY":(isset($v->unique)?"UNIQUE":"INDEX")),"columns"=>$f,"lengths"=>array(),"descs"=>$dc,);}return$H;}function
fields($Q){$p=fields_from_edit();if(!count($p)){global$m;$G=$m->select($Q,array("*"),null,null,array(),10);while($I=$G->fetch_assoc()){foreach($I
as$y=>$X){$I[$y]=null;$p[$y]=array("field"=>$y,"type"=>"string","null"=>($y!=$m->primary),"auto_increment"=>($y==$m->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}return$p;}function
found_rows($R,$Z){global$g;$Z=where_to_query($Z);$kb='MongoDB\Driver\Command';$sb=new$kb(array('count'=>$R['Name'],'query'=>$Z));$Wg=$g->_link->executeCommand($g->_db_name,$sb);$ui=$Wg->toArray();return$ui[0]->n;}function
sql_query_where_parser($Cg){$Cg=trim(preg_replace('/WHERE[\s]?[(]?\(?/','',$Cg));$Cg=preg_replace('/\)\)\)$/',')',$Cg);$rj=explode(' AND ',$Cg);$sj=explode(') OR (',$Cg);$Z=array();foreach($rj
as$pj)$Z[]=trim($pj);if(count($sj)==1)$sj=array();elseif(count($sj)>1)$Z=array();return
where_to_query($Z,$sj);}function
where_to_query($nj=array(),$oj=array()){global$b;$Qb=array();foreach(array('and'=>$nj,'or'=>$oj)as$T=>$Z){if(is_array($Z)){foreach($Z
as$Nc){list($nb,$zf,$X)=explode(" ",$Nc,3);if($nb=="_id"){$X=str_replace('MongoDB\BSON\ObjectID("',"",$X);$X=str_replace('")',"",$X);$kb='MongoDB\BSON\ObjectID';$X=new$kb($X);}if(!in_array($zf,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$zf,$A)){$X=(float)$X;$zf=$A[1];}elseif(preg_match('~^\(date\)(.+)~',$zf,$A)){$Sb=new
DateTime($X);$kb='MongoDB\BSON\UTCDatetime';$X=new$kb($Sb->getTimestamp()*1000);$zf=$A[1];}switch($zf){case'=':$zf='$eq';break;case'!=':$zf='$ne';break;case'>':$zf='$gt';break;case'<':$zf='$lt';break;case'>=':$zf='$gte';break;case'<=':$zf='$lte';break;case'regex':$zf='$regex';break;default:continue
2;}if($T=='and')$Qb['$and'][]=array($nb=>array($zf=>$X));elseif($T=='or')$Qb['$or'][]=array($nb=>array($zf=>$X));}}}return$Qb;}$Af=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);}elseif(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Ri,$Df){return@new
MongoClient($Ri,$Df);}function
query($F){return
false;}function
select_db($j){try{$this->_db=$this->_link->selectDB($j);return
true;}catch(Exception$Gc){$this->error=$Gc->getMessage();return
false;}}function
quote($P){return$P;}function
ping($_){}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($G){foreach($G
as$he){$I=array();foreach($he
as$y=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$y]=63;$I[$y]=(is_a($X,'MongoId')?'ObjectId("'.strval($X).'")':(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?strval($X):(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$I;foreach($I
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);if(!$I)return$I;$H=array();foreach($this->_rows[0]as$y=>$X)$H[$y]=$I[$y];next($this->_rows);return$H;}function
fetch_row(){$H=$this->fetch_assoc();if(!$H)return$H;return
array_values($H);}function
fetch_field(){$ne=array_keys($this->_rows[0]);$B=$ne[$this->_offset++];return(object)array('name'=>$B,'charsetnr'=>$this->_charset[$B],);}}class
Min_Driver
extends
Min_SQL{public$rg="_id";function
select($Q,$K,$Z,$td,$Ff=array(),$z=1,$D=0,$tg=false){$K=($K==array("*")?array():array_fill_keys($K,true));$Bh=array();foreach($Ff
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Ib);$Bh[$X]=($Ib?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($Q)->find(array(),$K)->sort($Bh)->limit($z!=""?+$z:0)->skip($D*$z));}function
insert($Q,$N){try{$H=$this->_conn->_db->selectCollection($Q)->insert($N);$this->_conn->errno=$H['code'];$this->_conn->error=$H['err'];$this->_conn->last_id=$N['_id'];return!$H['err'];}catch(Exception$Gc){$this->_conn->error=$Gc->getMessage();return
false;}}}function
get_databases($gd){global$g;$H=array();$Vb=$g->_link->listDBs();foreach($Vb['databases']as$l)$H[]=$l['name'];return$H;}function
count_tables($k){global$g;$H=array();foreach($k
as$l)$H[$l]=count($g->_link->selectDB($l)->getCollectionNames(true));return$H;}function
tables_list(){global$g;return
array_fill_keys($g->_db->getCollectionNames(true),'table');}function
drop_databases($k){global$g;foreach($k
as$l){$Tg=$g->_link->selectDB($l)->drop();if(!$Tg['ok'])return
false;}return
true;}function
indexes($Q,$h=null){global$g;$H=array();foreach($g->_db->selectCollection($Q)->getIndexInfo()as$v){$dc=array();foreach($v["key"]as$e=>$T)$dc[]=($T==-1?'1':null);$H[$v["name"]]=array("type"=>($v["name"]=="_id_"?"PRIMARY":($v["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($v["key"]),"lengths"=>array(),"descs"=>$dc,);}return$H;}function
fields($Q){return
fields_from_edit();}function
found_rows($R,$Z){global$g;return$g->_db->selectCollection($_GET["select"])->count($Z);}$Af=array("=");}function
table($u){return$u;}function
idf_escape($u){return$u;}function
table_status($B="",$Uc=false){$H=array();foreach(tables_list()as$Q=>$T){$H[$Q]=array("Name"=>$Q);if($B==$Q)return$H[$Q];}return$H;}function
create_database($l,$d){return
true;}function
last_id(){global$g;return$g->last_id;}function
error(){global$g;return
h($g->error);}function
collations(){return
array();}function
logged_user(){global$b;$Lb=$b->credentials();return$Lb[1];}function
connect(){global$b;$g=new
Min_DB;list($M,$V,$E)=$b->credentials();$Df=array();if($V.$E!=""){$Df["username"]=$V;$Df["password"]=$E;}$l=$b->database();if($l!="")$Df["db"]=$l;if(($La=getenv("MONGO_AUTH_SOURCE")))$Df["authSource"]=$La;try{$g->_link=$g->connect("mongodb://$M",$Df);if($E!=""){$Df["password"]="";try{$g->ping($g->connect("mongodb://$M",$Df));return'Database does not support password.';}catch(Exception$Gc){}}return$g;}catch(Exception$Gc){return$Gc->getMessage();}}function
alter_indexes($Q,$c){global$g;foreach($c
as$X){list($T,$B,$N)=$X;if($N=="DROP")$H=$g->_db->command(array("deleteIndexes"=>$Q,"index"=>$B));else{$f=array();foreach($N
as$e){$e=preg_replace('~ DESC$~','',$e,1,$Ib);$f[$e]=($Ib?-1:1);}$H=$g->_db->selectCollection($Q)->ensureIndex($f,array("unique"=>($T=="UNIQUE"),"name"=>$B,));}if($H['errmsg']){$g->error=$H['errmsg'];return
false;}}return
true;}function
support($Vc){return
preg_match("~database|indexes|descidx~",$Vc);}function
db_collation($l,$pb){}function
information_schema(){}function
is_view($R){}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
foreign_keys($Q){return
array();}function
fk_support($R){}function
engines(){return
array();}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){global$g;if($Q==""){$g->_db->createCollection($B);return
true;}}function
drop_tables($S){global$g;foreach($S
as$Q){$Tg=$g->_db->selectCollection($Q)->drop();if(!$Tg['ok'])return
false;}return
true;}function
truncate_tables($S){global$g;foreach($S
as$Q){$Tg=$g->_db->selectCollection($Q)->remove();if(!$Tg['ok'])return
false;}return
true;}$x="mongo";$qd=array();$wd=array();$rc=array(array("json"));}$jc["elastic"]="Elasticsearch (beta)";if(isset($_GET["elastic"])){$og=array("json + allow_url_fopen");define("DRIVER","elastic");if(function_exists('json_decode')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="JSON",$server_info,$errno,$error,$_url,$_db;function
rootQuery($eg,$Db=array(),$Xe='GET'){@ini_set('track_errors',1);$Zc=@file_get_contents("$this->_url/".ltrim($eg,'/'),false,stream_context_create(array('http'=>array('method'=>$Xe,'content'=>$Db===null?$Db:json_encode($Db),'header'=>'Content-Type: application/json','ignore_errors'=>1,))));if(!$Zc){$this->error=$php_errormsg;return$Zc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error='Invalid credentials.'." $http_response_header[0]";return
false;}$H=json_decode($Zc,true);if($H===null){$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$Bb=get_defined_constants(true);foreach($Bb['json']as$B=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$B)){$this->error=$B;break;}}}}return$H;}function
query($eg,$Db=array(),$Xe='GET'){return$this->rootQuery(($this->_db!=""?"$this->_db/":"/").ltrim($eg,'/'),$Db,$Xe);}function
connect($M,$V,$E){preg_match('~^(https?://)?(.*)~',$M,$A);$this->_url=($A[1]?$A[1]:"http://")."$V:$E@$A[2]";$H=$this->query('');if($H)$this->server_info=$H['version']['number'];return(bool)$H;}function
select_db($j){$this->_db=$j;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows;function
__construct($J){$this->num_rows=count($J);$this->_rows=$J;reset($this->_rows);}function
fetch_assoc(){$H=current($this->_rows);next($this->_rows);return$H;}function
fetch_row(){return
array_values($this->fetch_assoc());}}}class
Min_Driver
extends
Min_SQL{function
select($Q,$K,$Z,$td,$Ff=array(),$z=1,$D=0,$tg=false){global$b;$Qb=array();$F="$Q/_search";if($K!=array("*"))$Qb["fields"]=$K;if($Ff){$Bh=array();foreach($Ff
as$nb){$nb=preg_replace('~ DESC$~','',$nb,1,$Ib);$Bh[]=($Ib?array($nb=>"desc"):$nb);}$Qb["sort"]=$Bh;}if($z){$Qb["size"]=+$z;if($D)$Qb["from"]=($D*$z);}foreach($Z
as$X){list($nb,$zf,$X)=explode(" ",$X,3);if($nb=="_id")$Qb["query"]["ids"]["values"][]=$X;elseif($nb.$X!=""){$hi=array("term"=>array(($nb!=""?$nb:"_all")=>$X));if($zf=="=")$Qb["query"]["filtered"]["filter"]["and"][]=$hi;else$Qb["query"]["filtered"]["query"]["bool"]["must"][]=$hi;}}if($Qb["query"]&&!$Qb["query"]["filtered"]["query"]&&!$Qb["query"]["ids"])$Qb["query"]["filtered"]["query"]=array("match_all"=>array());$Kh=microtime(true);$jh=$this->_conn->query($F,$Qb);if($tg)echo$b->selectQuery("$F: ".json_encode($Qb),$Kh,!$jh);if(!$jh)return
false;$H=array();foreach($jh['hits']['hits']as$Fd){$I=array();if($K==array("*"))$I["_id"]=$Fd["_id"];$p=$Fd['_source'];if($K!=array("*")){$p=array();foreach($K
as$y)$p[$y]=$Fd['fields'][$y];}foreach($p
as$y=>$X){if($Qb["fields"])$X=$X[0];$I[$y]=(is_array($X)?json_encode($X):$X);}$H[]=$I;}return
new
Min_Result($H);}function
update($T,$Hg,$Cg,$z=0,$L="\n"){$cg=preg_split('~ *= *~',$Cg);if(count($cg)==2){$t=trim($cg[1]);$F="$T/$t";return$this->_conn->query($F,$Hg,'POST');}return
false;}function
insert($T,$Hg){$t="";$F="$T/$t";$Tg=$this->_conn->query($F,$Hg,'POST');$this->_conn->last_id=$Tg['_id'];return$Tg['created'];}function
delete($T,$Cg,$z=0){$Kd=array();if(is_array($_GET["where"])&&$_GET["where"]["_id"])$Kd[]=$_GET["where"]["_id"];if(is_array($_POST['check'])){foreach($_POST['check']as$db){$cg=preg_split('~ *= *~',$db);if(count($cg)==2)$Kd[]=trim($cg[1]);}}$this->_conn->affected_rows=0;foreach($Kd
as$t){$F="{$T}/{$t}";$Tg=$this->_conn->query($F,'{}','DELETE');if(is_array($Tg)&&$Tg['found']==true)$this->_conn->affected_rows++;}return$this->_conn->affected_rows;}}function
connect(){global$b;$g=new
Min_DB;list($M,$V,$E)=$b->credentials();if($E!=""&&$g->connect($M,$V,""))return'Database does not support password.';if($g->connect($M,$V,$E))return$g;return$g->error;}function
support($Vc){return
preg_match("~database|table|columns~",$Vc);}function
logged_user(){global$b;$Lb=$b->credentials();return$Lb[1];}function
get_databases(){global$g;$H=$g->rootQuery('_aliases');if($H){$H=array_keys($H);sort($H,SORT_STRING);}return$H;}function
collations(){return
array();}function
db_collation($l,$pb){}function
engines(){return
array();}function
count_tables($k){global$g;$H=array();$G=$g->query('_stats');if($G&&$G['indices']){$Sd=$G['indices'];foreach($Sd
as$Rd=>$Lh){$Qd=$Lh['total']['indexing'];$H[$Rd]=$Qd['index_total'];}}return$H;}function
tables_list(){global$g;if(min_version(6))return
array('_doc'=>'table');$H=$g->query('_mapping');if($H)$H=array_fill_keys(array_keys($H[$g->_db]["mappings"]),'table');return$H;}function
table_status($B="",$Uc=false){global$g;$jh=$g->query("_search",array("size"=>0,"aggregations"=>array("count_by_type"=>array("terms"=>array("field"=>"_type")))),"POST");$H=array();if($jh){$S=$jh["aggregations"]["count_by_type"]["buckets"];foreach($S
as$Q){$H[$Q["key"]]=array("Name"=>$Q["key"],"Engine"=>"table","Rows"=>$Q["doc_count"],);if($B!=""&&$B==$Q["key"])return$H[$B];}}return$H;}function
error(){global$g;return
h($g->error);}function
information_schema(){}function
is_view($R){}function
indexes($Q,$h=null){return
array(array("type"=>"PRIMARY","columns"=>array("_id")),);}function
fields($Q){global$g;$Fe=array();if(min_version(6)){$G=$g->query("_mapping");if($G)$Fe=$G[$g->_db]['mappings']['properties'];}else{$G=$g->query("$Q/_mapping");if($G){$Fe=$G[$Q]['properties'];if(!$Fe)$Fe=$G[$g->_db]['mappings'][$Q]['properties'];}}$H=array();if($Fe){foreach($Fe
as$B=>$o){$H[$B]=array("field"=>$B,"full_type"=>$o["type"],"type"=>$o["type"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);if($o["properties"]){unset($H[$B]["privileges"]["insert"]);unset($H[$B]["privileges"]["update"]);}}}return$H;}function
foreign_keys($Q){return
array();}function
table($u){return$u;}function
idf_escape($u){return$u;}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
fk_support($R){}function
found_rows($R,$Z){return
null;}function
create_database($l){global$g;return$g->rootQuery(urlencode($l),null,'PUT');}function
drop_databases($k){global$g;return$g->rootQuery(urlencode(implode(',',$k)),array(),'DELETE');}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){global$g;$zg=array();foreach($p
as$Sc){$Xc=trim($Sc[1][0]);$Yc=trim($Sc[1][1]?$Sc[1][1]:"text");$zg[$Xc]=array('type'=>$Yc);}if(!empty($zg))$zg=array('properties'=>$zg);return$g->query("_mapping/{$B}",$zg,'PUT');}function
drop_tables($S){global$g;$H=true;foreach($S
as$Q)$H=$H&&$g->query(urlencode($Q),array(),'DELETE');return$H;}function
last_id(){global$g;return$g->last_id;}$x="elastic";$Af=array("=","query");$qd=array();$wd=array();$rc=array(array("json"));$U=array();$Oh=array();foreach(array('Numbers'=>array("long"=>3,"integer"=>5,"short"=>8,"byte"=>10,"double"=>20,"float"=>66,"half_float"=>12,"scaled_float"=>21),'Date and time'=>array("date"=>10),'Strings'=>array("string"=>65535,"text"=>65535),'Binary'=>array("binary"=>255),)as$y=>$X){$U+=$X;$Oh[$y]=array_keys($X);}}$jc["clickhouse"]="ClickHouse (alpha)";if(isset($_GET["clickhouse"])){define("DRIVER","clickhouse");class
Min_DB{var$extension="JSON",$server_info,$errno,$_result,$error,$_url;var$_db='default';function
rootQuery($l,$F){@ini_set('track_errors',1);$Zc=@file_get_contents("$this->_url/?database=$l",false,stream_context_create(array('http'=>array('method'=>'POST','content'=>$this->isQuerySelectLike($F)?"$F FORMAT JSONCompact":$F,'header'=>'Content-type: application/x-www-form-urlencoded','ignore_errors'=>1,))));if($Zc===false){$this->error=$php_errormsg;return$Zc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error='Invalid credentials.'." $http_response_header[0]";return
false;}$H=json_decode($Zc,true);if($H===null){if(!$this->isQuerySelectLike($F)&&$Zc==='')return
true;$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$Bb=get_defined_constants(true);foreach($Bb['json']as$B=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$B)){$this->error=$B;break;}}}}return
new
Min_Result($H);}function
isQuerySelectLike($F){return(bool)preg_match('~^(select|show)~i',$F);}function
query($F){return$this->rootQuery($this->_db,$F);}function
connect($M,$V,$E){preg_match('~^(https?://)?(.*)~',$M,$A);$this->_url=($A[1]?$A[1]:"http://")."$V:$E@$A[2]";$H=$this->query('SELECT 1');return(bool)$H;}function
select_db($j){$this->_db=$j;return
true;}function
quote($P){return"'".addcslashes($P,"\\'")."'";}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$o=0){$G=$this->query($F);return$G['data'];}}class
Min_Result{var$num_rows,$_rows,$columns,$meta,$_offset=0;function
__construct($G){$this->num_rows=$G['rows'];$this->_rows=$G['data'];$this->meta=$G['meta'];$this->columns=array_column($this->meta,'name');reset($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);next($this->_rows);return$I===false?false:array_combine($this->columns,$I);}function
fetch_row(){$I=current($this->_rows);next($this->_rows);return$I;}function
fetch_field(){$e=$this->_offset++;$H=new
stdClass;if($e<count($this->columns)){$H->name=$this->meta[$e]['name'];$H->orgname=$H->name;$H->type=$this->meta[$e]['type'];}return$H;}}class
Min_Driver
extends
Min_SQL{function
delete($Q,$Cg,$z=0){if($Cg==='')$Cg='WHERE 1=1';return
queries("ALTER TABLE ".table($Q)." DELETE $Cg");}function
update($Q,$N,$Cg,$z=0,$L="\n"){$cj=array();foreach($N
as$y=>$X)$cj[]="$y = $X";$F=$L.implode(",$L",$cj);return
queries("ALTER TABLE ".table($Q)." UPDATE $F$Cg");}}function
idf_escape($u){return"`".str_replace("`","``",$u)."`";}function
table($u){return
idf_escape($u);}function
explain($g,$F){return'';}function
found_rows($R,$Z){$J=get_vals("SELECT COUNT(*) FROM ".idf_escape($R["Name"]).($Z?" WHERE ".implode(" AND ",$Z):""));return
empty($J)?false:$J[0];}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){$c=$Ff=array();foreach($p
as$o){if($o[1][2]===" NULL")$o[1][1]=" Nullable({$o[1][1]})";elseif($o[1][2]===' NOT NULL')$o[1][2]='';if($o[1][3])$o[1][3]='';$c[]=($o[1]?($Q!=""?($o[0]!=""?"MODIFY COLUMN ":"ADD COLUMN "):" ").implode($o[1]):"DROP COLUMN ".idf_escape($o[0]));$Ff[]=$o[1][0];}$c=array_merge($c,$id);$O=($zc?" ENGINE ".$zc:"");if($Q=="")return
queries("CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)$O$ag".' ORDER BY ('.implode(',',$Ff).')');if($Q!=$B){$G=queries("RENAME TABLE ".table($Q)." TO ".table($B));if($c)$Q=$B;else
return$G;}if($O)$c[]=ltrim($O);return($c||$ag?queries("ALTER TABLE ".table($Q)."\n".implode(",\n",$c).$ag):true);}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($hj){return
drop_tables($hj);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
connect(){global$b;$g=new
Min_DB;$Lb=$b->credentials();if($g->connect($Lb[0],$Lb[1],$Lb[2]))return$g;return$g->error;}function
get_databases($gd){global$g;$G=get_rows('SHOW DATABASES');$H=array();foreach($G
as$I)$H[]=$I['name'];sort($H);return$H;}function
limit($F,$Z,$z,$C=0,$L=" "){return" $F$Z".($z!==null?$L."LIMIT $z".($C?", $C":""):"");}function
limit1($Q,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($l,$pb){}function
engines(){return
array('MergeTree');}function
logged_user(){global$b;$Lb=$b->credentials();return$Lb[1];}function
tables_list(){$G=get_rows('SHOW TABLES');$H=array();foreach($G
as$I)$H[$I['name']]='table';ksort($H);return$H;}function
count_tables($k){return
array();}function
table_status($B="",$Uc=false){global$g;$H=array();$S=get_rows("SELECT name, engine FROM system.tables WHERE database = ".q($g->_db));foreach($S
as$Q){$H[$Q['name']]=array('Name'=>$Q['name'],'Engine'=>$Q['engine'],);if($B===$Q['name'])return$H[$Q['name']];}return$H;}function
is_view($R){return
false;}function
fk_support($R){return
false;}function
convert_field($o){}function
unconvert_field($o,$H){if(in_array($o['type'],array("Int8","Int16","Int32","Int64","UInt8","UInt16","UInt32","UInt64","Float32","Float64")))return"to$o[type]($H)";return$H;}function
fields($Q){$H=array();$G=get_rows("SELECT name, type, default_expression FROM system.columns WHERE ".idf_escape('table')." = ".q($Q));foreach($G
as$I){$T=trim($I['type']);$lf=strpos($T,'Nullable(')===0;$H[trim($I['name'])]=array("field"=>trim($I['name']),"full_type"=>$T,"type"=>$T,"default"=>trim($I['default_expression']),"null"=>$lf,"auto_increment"=>'0',"privileges"=>array("insert"=>1,"select"=>1,"update"=>0),);}return$H;}function
indexes($Q,$h=null){return
array();}function
foreign_keys($Q){return
array();}function
collations(){return
array();}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($hh){return
true;}function
auto_increment(){return'';}function
last_id(){return
0;}function
support($Vc){return
preg_match("~^(columns|sql|status|table|drop_col)$~",$Vc);}$x="clickhouse";$U=array();$Oh=array();foreach(array('Numbers'=>array("Int8"=>3,"Int16"=>5,"Int32"=>10,"Int64"=>19,"UInt8"=>3,"UInt16"=>5,"UInt32"=>10,"UInt64"=>20,"Float32"=>7,"Float64"=>16,'Decimal'=>38,'Decimal32'=>9,'Decimal64'=>18,'Decimal128'=>38),'Date and time'=>array("Date"=>13,"DateTime"=>20),'Strings'=>array("String"=>0),'Binary'=>array("FixedString"=>0),)as$y=>$X){$U+=$X;$Oh[$y]=array_keys($X);}$Pi=array();$Af=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");$qd=array();$wd=array("avg","count","count distinct","max","min","sum");$rc=array();}$jc=array("server"=>"MySQL")+$jc;if(!defined("DRIVER")){$og=array("MySQLi","MySQL","PDO_MySQL");define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($M="",$V="",$E="",$j=null,$kg=null,$Ah=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($Gd,$kg)=explode(":",$M,2);$Jh=$b->connectSsl();if($Jh)$this->ssl_set($Jh['key'],$Jh['cert'],$Jh['ca'],'','');$H=@$this->real_connect(($M!=""?$Gd:ini_get("mysqli.default_host")),($M.$V!=""?$V:ini_get("mysqli.default_user")),($M.$V.$E!=""?$E:ini_get("mysqli.default_pw")),$j,(is_numeric($kg)?$kg:ini_get("mysqli.default_port")),(!is_numeric($kg)?$kg:$Ah),($Jh?64:0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$H;}function
set_charset($cb){if(parent::set_charset($cb))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $cb");}function
result($F,$o=0){$G=$this->query($F);if(!$G)return
false;$I=$G->fetch_array();return$I[$o];}function
quote($P){return"'".$this->escape_string($P)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($M,$V,$E){if(ini_bool("mysql.allow_local_infile")){$this->error=sprintf('Disable %s or enable %s or %s extensions.',"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($M!=""?$M:ini_get("mysql.default_host")),("$M$V"!=""?$V:ini_get("mysql.default_user")),("$M$V$E"!=""?$E:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($cb){if(function_exists('mysql_set_charset')){if(mysql_set_charset($cb,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $cb");}function
quote($P){return"'".mysql_real_escape_string($P,$this->_link)."'";}function
select_db($j){return
mysql_select_db($j,$this->_link);}function
query($F,$Ji=false){$G=@($Ji?mysql_unbuffered_query($F,$this->_link):mysql_query($F,$this->_link));$this->error="";if(!$G){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($G===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$o=0){$G=$this->query($F);if(!$G||!$G->num_rows)return
false;return
mysql_result($G->_result,0,$o);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($G){$this->_result=$G;$this->num_rows=mysql_num_rows($G);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$H=mysql_fetch_field($this->_result,$this->_offset++);$H->orgtable=$H->table;$H->orgname=$H->name;$H->charsetnr=($H->blob?63:0);return$H;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($M,$V,$E){global$b;$Df=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$Jh=$b->connectSsl();if($Jh){if(!empty($Jh['key']))$Df[PDO::MYSQL_ATTR_SSL_KEY]=$Jh['key'];if(!empty($Jh['cert']))$Df[PDO::MYSQL_ATTR_SSL_CERT]=$Jh['cert'];if(!empty($Jh['ca']))$Df[PDO::MYSQL_ATTR_SSL_CA]=$Jh['ca'];}$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$E,$Df);return
true;}function
set_charset($cb){$this->query("SET NAMES $cb");}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($F,$Ji=false){$this->pdo->setAttribute(1000,!$Ji);return
parent::query($F,$Ji);}}}class
Min_Driver
extends
Min_SQL{function
insert($Q,$N){return($N?parent::insert($Q,$N):queries("INSERT INTO ".table($Q)." ()\nVALUES ()"));}function
insertUpdate($Q,$J,$rg){$f=array_keys(reset($J));$pg="INSERT INTO ".table($Q)." (".implode(", ",$f).") VALUES\n";$cj=array();foreach($f
as$y)$cj[$y]="$y = VALUES($y)";$Rh="\nON DUPLICATE KEY UPDATE ".implode(", ",$cj);$cj=array();$ze=0;foreach($J
as$N){$Y="(".implode(", ",$N).")";if($cj&&(strlen($pg)+$ze+strlen($Y)+strlen($Rh)>1e6)){if(!queries($pg.implode(",\n",$cj).$Rh))return
false;$cj=array();$ze=0;}$cj[]=$Y;$ze+=strlen($Y)+2;}return
queries($pg.implode(",\n",$cj).$Rh);}function
slowQuery($F,$mi){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$mi FOR $F";elseif(preg_match('~^(SELECT\b)(.+)~is',$F,$A))return"$A[1] /*+ MAX_EXECUTION_TIME(".($mi*1000).") */ $A[2]";}}function
convertSearch($u,$X,$o){return(preg_match('~char|text|enum|set~',$o["type"])&&!preg_match("~^utf8~",$o["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($u USING ".charset($this->_conn).")":$u);}function
warnings(){$G=$this->_conn->query("SHOW WARNINGS");if($G&&$G->num_rows){ob_start();select($G);return
ob_get_clean();}}function
tableHelp($B){$Ge=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower(($Ge?"information-schema-$B-table/":str_replace("_","-",$B)."-table.html"));if(DB=="mysql")return($Ge?"mysql$B-table/":"system-database.html");}}function
idf_escape($u){return"`".str_replace("`","``",$u)."`";}function
table($u){return
idf_escape($u);}function
connect(){global$b,$U,$Oh;$g=new
Min_DB;$Lb=$b->credentials();if($g->connect($Lb[0],$Lb[1],$Lb[2])){$g->set_charset(charset($g));$g->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$g)){$Oh['Strings'][]="json";$U["json"]=4294967295;}return$g;}$H=$g->error;if(function_exists('iconv')&&!is_utf8($H)&&strlen($fh=iconv("windows-1250","utf-8",$H))>strlen($H))$H=$fh;return$H;}function
get_databases($gd){$H=get_session("dbs");if($H===null){$F=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$H=($gd?slow_query($F):get_vals($F));restart_session();set_session("dbs",$H);stop_session();}return$H;}function
limit($F,$Z,$z,$C=0,$L=" "){return" $F$Z".($z!==null?$L."LIMIT $z".($C?" OFFSET $C":""):"");}function
limit1($Q,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($l,$pb){global$g;$H=null;$i=$g->result("SHOW CREATE DATABASE ".idf_escape($l),1);if(preg_match('~ COLLATE ([^ ]+)~',$i,$A))$H=$A[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$i,$A))$H=$pb[$A[1]][-1];return$H;}function
engines(){$H=array();foreach(get_rows("SHOW ENGINES")as$I){if(preg_match("~YES|DEFAULT~",$I["Support"]))$H[]=$I["Engine"];}return$H;}function
logged_user(){global$g;return$g->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($k){$H=array();foreach($k
as$l)$H[$l]=count(get_vals("SHOW TABLES IN ".idf_escape($l)));return$H;}function
table_status($B="",$Uc=false){$H=array();foreach(get_rows($Uc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($B!=""?"AND TABLE_NAME = ".q($B):"ORDER BY Name"):"SHOW TABLE STATUS".($B!=""?" LIKE ".q(addcslashes($B,"%_\\")):""))as$I){if($I["Engine"]=="InnoDB")$I["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$I["Comment"]);if(!isset($I["Engine"]))$I["Comment"]="";if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($R){return$R["Engine"]===null;}function
fk_support($R){return
preg_match('~InnoDB|IBMDB2I~i',$R["Engine"])||(preg_match('~NDB~i',$R["Engine"])&&min_version(5.6));}function
fields($Q){$H=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($Q))as$I){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$I["Type"],$A);$H[$I["Field"]]=array("field"=>$I["Field"],"full_type"=>$I["Type"],"type"=>$A[1],"length"=>$A[2],"unsigned"=>ltrim($A[3].$A[4]),"default"=>($I["Default"]!=""||preg_match("~char|set~",$A[1])?(preg_match('~text~',$A[1])?stripslashes(preg_replace("~^'(.*)'\$~",'\1',$I["Default"])):$I["Default"]):null),"null"=>($I["Null"]=="YES"),"auto_increment"=>($I["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$I["Extra"],$A)?$A[1]:""),"collation"=>$I["Collation"],"privileges"=>array_flip(preg_split('~, *~',$I["Privileges"])),"comment"=>$I["Comment"],"primary"=>($I["Key"]=="PRI"),"generated"=>preg_match('~^(VIRTUAL|PERSISTENT|STORED)~',$I["Extra"]),);}return$H;}function
indexes($Q,$h=null){$H=array();foreach(get_rows("SHOW INDEX FROM ".table($Q),$h)as$I){$B=$I["Key_name"];$H[$B]["type"]=($B=="PRIMARY"?"PRIMARY":($I["Index_type"]=="FULLTEXT"?"FULLTEXT":($I["Non_unique"]?($I["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$H[$B]["columns"][]=$I["Column_name"];$H[$B]["lengths"][]=($I["Index_type"]=="SPATIAL"?null:$I["Sub_part"]);$H[$B]["descs"][]=null;}return$H;}function
foreign_keys($Q){global$g,$wf;static$gg='(?:`(?:[^`]|``)+`|"(?:[^"]|"")+")';$H=array();$Jb=$g->result("SHOW CREATE TABLE ".table($Q),1);if($Jb){preg_match_all("~CONSTRAINT ($gg) FOREIGN KEY ?\\(((?:$gg,? ?)+)\\) REFERENCES ($gg)(?:\\.($gg))? \\(((?:$gg,? ?)+)\\)(?: ON DELETE ($wf))?(?: ON UPDATE ($wf))?~",$Jb,$Je,PREG_SET_ORDER);foreach($Je
as$A){preg_match_all("~$gg~",$A[2],$Ch);preg_match_all("~$gg~",$A[5],$ei);$H[idf_unescape($A[1])]=array("db"=>idf_unescape($A[4]!=""?$A[3]:$A[4]),"table"=>idf_unescape($A[4]!=""?$A[4]:$A[3]),"source"=>array_map('idf_unescape',$Ch[0]),"target"=>array_map('idf_unescape',$ei[0]),"on_delete"=>($A[6]?$A[6]:"RESTRICT"),"on_update"=>($A[7]?$A[7]:"RESTRICT"),);}}return$H;}function
view($B){global$g;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$g->result("SHOW CREATE VIEW ".table($B),1)));}function
collations(){$H=array();foreach(get_rows("SHOW COLLATION")as$I){if($I["Default"])$H[$I["Charset"]][-1]=$I["Collation"];else$H[$I["Charset"]][]=$I["Collation"];}ksort($H);foreach($H
as$y=>$X)asort($H[$y]);return$H;}function
information_schema($l){return(min_version(5)&&$l=="information_schema")||(min_version(5.5)&&$l=="performance_schema");}function
error(){global$g;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$g->error));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" COLLATE ".q($d):""));}function
drop_databases($k){$H=apply_queries("DROP DATABASE",$k,'idf_escape');restart_session();set_session("dbs",null);return$H;}function
rename_database($B,$d){$H=false;if(create_database($B,$d)){$Rg=array();foreach(tables_list()as$Q=>$T)$Rg[]=table($Q)." TO ".idf_escape($B).".".table($Q);$H=(!$Rg||queries("RENAME TABLE ".implode(", ",$Rg)));if($H)queries("DROP DATABASE ".idf_escape(DB));restart_session();set_session("dbs",null);}return$H;}function
auto_increment(){$Na=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$v){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$v["columns"],true)){$Na="";break;}if($v["type"]=="PRIMARY")$Na=" UNIQUE";}}return" AUTO_INCREMENT$Na";}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){$c=array();foreach($p
as$o)$c[]=($o[1]?($Q!=""?($o[0]!=""?"CHANGE ".idf_escape($o[0]):"ADD"):" ")." ".implode($o[1]).($Q!=""?$o[2]:""):"DROP ".idf_escape($o[0]));$c=array_merge($c,$id);$O=($ub!==null?" COMMENT=".q($ub):"").($zc?" ENGINE=".q($zc):"").($d?" COLLATE ".q($d):"").($Ma!=""?" AUTO_INCREMENT=$Ma":"");if($Q=="")return
queries("CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)$O$ag");if($Q!=$B)$c[]="RENAME TO ".table($B);if($O)$c[]=ltrim($O);return($c||$ag?queries("ALTER TABLE ".table($Q)."\n".implode(",\n",$c).$ag):true);}function
alter_indexes($Q,$c){foreach($c
as$y=>$X)$c[$y]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($Q).implode(",",$c));}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($hj){return
queries("DROP VIEW ".implode(", ",array_map('table',$hj)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$hj,$ei){$Rg=array();foreach(array_merge($S,$hj)as$Q)$Rg[]=table($Q)." TO ".idf_escape($ei).".".table($Q);return
queries("RENAME TABLE ".implode(", ",$Rg));}function
copy_tables($S,$hj,$ei){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($S
as$Q){$B=($ei==DB?table("copy_$Q"):idf_escape($ei).".".table($Q));if(($_POST["overwrite"]&&!queries("\nDROP TABLE IF EXISTS $B"))||!queries("CREATE TABLE $B LIKE ".table($Q))||!queries("INSERT INTO $B SELECT * FROM ".table($Q)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$I){$Di=$I["Trigger"];if(!queries("CREATE TRIGGER ".($ei==DB?idf_escape("copy_$Di"):idf_escape($ei).".".idf_escape($Di))." $I[Timing] $I[Event] ON $B FOR EACH ROW\n$I[Statement];"))return
false;}}foreach($hj
as$Q){$B=($ei==DB?table("copy_$Q"):idf_escape($ei).".".table($Q));$gj=view($Q);if(($_POST["overwrite"]&&!queries("DROP VIEW IF EXISTS $B"))||!queries("CREATE VIEW $B AS $gj[select]"))return
false;}return
true;}function
trigger($B){if($B=="")return
array();$J=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($B));return
reset($J);}function
triggers($Q){$H=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$I)$H[$I["Trigger"]]=array($I["Timing"],$I["Event"]);return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($B,$T){global$g,$Ac,$Xd,$U;$Ca=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$Dh="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$Ii="((".implode("|",array_merge(array_keys($U),$Ca)).")\\b(?:\\s*\\(((?:[^'\")]|$Ac)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$gg="$Dh*(".($T=="FUNCTION"?"":$Xd).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$Ii";$i=$g->result("SHOW CREATE $T ".idf_escape($B),2);preg_match("~\\(((?:$gg\\s*,?)*)\\)\\s*".($T=="FUNCTION"?"RETURNS\\s+$Ii\\s+":"")."(.*)~is",$i,$A);$p=array();preg_match_all("~$gg\\s*,?~is",$A[1],$Je,PREG_SET_ORDER);foreach($Je
as$Tf)$p[]=array("field"=>str_replace("``","`",$Tf[2]).$Tf[3],"type"=>strtolower($Tf[5]),"length"=>preg_replace_callback("~$Ac~s",'normalize_enum',$Tf[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$Tf[8] $Tf[7]"))),"null"=>1,"full_type"=>$Tf[4],"inout"=>strtoupper($Tf[1]),"collation"=>strtolower($Tf[9]),);if($T!="FUNCTION")return
array("fields"=>$p,"definition"=>$A[11]);return
array("fields"=>$p,"returns"=>array("type"=>$A[12],"length"=>$A[13],"unsigned"=>$A[15],"collation"=>$A[16]),"definition"=>$A[17],"language"=>"SQL",);}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($B,$I){return
idf_escape($B);}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ID()");}function
explain($g,$F){return$g->query("EXPLAIN ".(min_version(5.1)?"PARTITIONS ":"").$F);}function
found_rows($R,$Z){return($Z||$R["Engine"]!="InnoDB"?null:$R["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($hh,$h=null){return
true;}function
create_sql($Q,$Ma,$Ph){global$g;$H=$g->result("SHOW CREATE TABLE ".table($Q),1);if(!$Ma)$H=preg_replace('~ AUTO_INCREMENT=\d+~','',$H);return$H;}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
use_sql($j){return"USE ".idf_escape($j);}function
trigger_sql($Q){$H="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")),null,"-- ")as$I)$H.="\nCREATE TRIGGER ".idf_escape($I["Trigger"])." $I[Timing] $I[Event] ON ".table($I["Table"])." FOR EACH ROW\n$I[Statement];;\n";return$H;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($o){if(preg_match("~binary~",$o["type"]))return"HEX(".idf_escape($o["field"]).")";if($o["type"]=="bit")return"BIN(".idf_escape($o["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$o["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($o["field"]).")";}function
unconvert_field($o,$H){if(preg_match("~binary~",$o["type"]))$H="UNHEX($H)";if($o["type"]=="bit")$H="CONV($H, 2, 10) + 0";if(preg_match("~geometry|point|linestring|polygon~",$o["type"]))$H=(min_version(8)?"ST_":"")."GeomFromText($H, SRID($o[field]))";return$H;}function
support($Vc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(8)?"":"|descidx".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view")))."~",$Vc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$g;return$g->result("SELECT @@max_connections");}$x="sql";$U=array();$Oh=array();foreach(array('Numbers'=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),'Date and time'=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),'Strings'=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),'Lists'=>array("enum"=>65535,"set"=>64),'Binary'=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),'Geometry'=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$y=>$X){$U+=$X;$Oh[$y]=array_keys($X);}$Pi=array("unsigned","zerofill","unsigned zerofill");$Af=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$qd=array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper");$wd=array("avg","count","count distinct","group_concat","max","min","sum");$rc=array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",));}define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~\?.*~','',relative_uri()).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));$ia="4.7.9";class
Adminer{var$operators;function
name(){return"<a href='https://www.adminer.org/'".target_blank()." id='h1'>Adminer</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($i=false){return
password_file($i);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($M){return
h($M);}function
database(){return
DB;}function
databases($gd=true){return
get_databases($gd);}function
schemas(){return
schemas();}function
queryTimeout(){return
2;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$H=array();$ad="adminer.css";if(file_exists($ad))$H[]="$ad?v=".crc32(file_get_contents($ad));return$H;}function
loginForm(){global$jc;echo"<table cellspacing='0' class='layout'>\n",$this->loginFormField('driver','<tr><th>'.'System'.'<td>',html_select("auth[driver]",$jc,DRIVER,"loginDriver(this);")."\n"),$this->loginFormField('server','<tr><th>'.'Server'.'<td>','<input name="auth[server]" value="'.h(SERVER).'" title="hostname[:port]" placeholder="localhost" autocapitalize="off">'."\n"),$this->loginFormField('username','<tr><th>'.'Username'.'<td>','<input name="auth[username]" id="username" value="'.h($_GET["username"]).'" autocomplete="username" autocapitalize="off">'.script("focus(qs('#username')); qs('#username').form['auth[driver]'].onchange();")),$this->loginFormField('password','<tr><th>'.'Password'.'<td>','<input type="password" name="auth[password]" autocomplete="current-password">'."\n"),$this->loginFormField('db','<tr><th>'.'Database'.'<td>','<input name="auth[db]" value="'.h($_GET["db"]).'" autocapitalize="off">'."\n"),"</table>\n","<p><input type='submit' value='".'Login'."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],'Permanent login')."\n";}function
loginFormField($B,$Cd,$Y){return$Cd.$Y;}function
login($De,$E){if($E=="")return
sprintf('Adminer does not support accessing a database without a password, <a href="https://www.adminer.org/en/password/"%s>more information</a>.',target_blank());return
true;}function
tableName($Vh){return
h($Vh["Name"]);}function
fieldName($o,$Ff=0){return'<span title="'.h($o["full_type"]).'">'.h($o["field"]).'</span>';}function
selectLinks($Vh,$N=""){global$x,$m;echo'<p class="links">';$Be=array("select"=>'Select data');if(support("table")||support("indexes"))$Be["table"]='Show structure';if(support("table")){if(is_view($Vh))$Be["view"]='Alter view';else$Be["create"]='Alter table';}if($N!==null)$Be["edit"]='New item';$B=$Vh["Name"];foreach($Be
as$y=>$X)echo" <a href='".h(ME)."$y=".urlencode($B).($y=="edit"?$N:"")."'".bold(isset($_GET[$y])).">$X</a>";echo
doc_link(array($x=>$m->tableHelp($B)),"?"),"\n";}function
foreignKeys($Q){return
foreign_keys($Q);}function
backwardKeys($Q,$Uh){return
array();}function
backwardKeysPrint($Pa,$I){}function
selectQuery($F,$Kh,$Tc=false){global$x,$m;$H="</p>\n";if(!$Tc&&($kj=$m->warnings())){$t="warnings";$H=", <a href='#$t'>".'Warnings'."</a>".script("qsl('a').onclick = partial(toggle, '$t');","")."$H<div id='$t' class='hidden'>\n$kj</div>\n";}return"<p><code class='jush-$x'>".h(str_replace("\n"," ",$F))."</code> <span class='time'>(".format_time($Kh).")</span>".(support("sql")?" <a href='".h(ME)."sql=".urlencode($F)."'>".'Edit'."</a>":"").$H;}function
sqlCommandQuery($F){return
shorten_utf8(trim($F),1000);}function
rowDescription($Q){return"";}function
rowDescriptions($J,$jd){return$J;}function
selectLink($X,$o){}function
selectVal($X,$_,$o,$Nf){$H=($X===null?"<i>NULL</i>":(preg_match("~char|binary|boolean~",$o["type"])&&!preg_match("~var~",$o["type"])?"<code>$X</code>":$X));if(preg_match('~blob|bytea|raw|file~',$o["type"])&&!is_utf8($X))$H="<i>".lang(array('%d byte','%d bytes'),strlen($Nf))."</i>";if(preg_match('~json~',$o["type"]))$H="<code class='jush-js'>$H</code>";return($_?"<a href='".h($_)."'".(is_url($_)?target_blank():"").">$H</a>":$H);}function
editVal($X,$o){return$X;}function
tableStructurePrint($p){echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap'>\n","<thead><tr><th>".'Column'."<td>".'Type'.(support("comment")?"<td>".'Comment':"")."</thead>\n";foreach($p
as$o){echo"<tr".odd()."><th>".h($o["field"]),"<td><span title='".h($o["collation"])."'>".h($o["full_type"])."</span>",($o["null"]?" <i>NULL</i>":""),($o["auto_increment"]?" <i>".'Auto Increment'."</i>":""),(isset($o["default"])?" <span title='".'Default value'."'>[<b>".h($o["default"])."</b>]</span>":""),(support("comment")?"<td>".h($o["comment"]):""),"\n";}echo"</table>\n","</div>\n";}function
tableIndexesPrint($w){echo"<table cellspacing='0'>\n";foreach($w
as$B=>$v){ksort($v["columns"]);$tg=array();foreach($v["columns"]as$y=>$X)$tg[]="<i>".h($X)."</i>".($v["lengths"][$y]?"(".$v["lengths"][$y].")":"").($v["descs"][$y]?" DESC":"");echo"<tr title='".h($B)."'><th>$v[type]<td>".implode(", ",$tg)."\n";}echo"</table>\n";}function
selectColumnsPrint($K,$f){global$qd,$wd;print_fieldset("select",'Select',$K);$s=0;$K[""]=array();foreach($K
as$y=>$X){$X=$_GET["columns"][$y];$e=select_input(" name='columns[$s][col]'",$f,$X["col"],($y!==""?"selectFieldChange":"selectAddRow"));echo"<div>".($qd||$wd?"<select name='columns[$s][fun]'>".optionlist(array(-1=>"")+array_filter(array('Functions'=>$qd,'Aggregation'=>$wd)),$X["fun"])."</select>".on_help("getTarget(event).value && getTarget(event).value.replace(/ |\$/, '(') + ')'",1).script("qsl('select').onchange = function () { helpClose();".($y!==""?"":" qsl('select, input', this.parentNode).onchange();")." };","")."($e)":$e)."</div>\n";$s++;}echo"</div></fieldset>\n";}function
selectSearchPrint($Z,$f,$w){print_fieldset("search",'Search',$Z);foreach($w
as$s=>$v){if($v["type"]=="FULLTEXT"){echo"<div>(<i>".implode("</i>, <i>",array_map('h',$v["columns"]))."</i>) AGAINST"," <input type='search' name='fulltext[$s]' value='".h($_GET["fulltext"][$s])."'>",script("qsl('input').oninput = selectFieldChange;",""),checkbox("boolean[$s]",1,isset($_GET["boolean"][$s]),"BOOL"),"</div>\n";}}$bb="this.parentNode.firstChild.onchange();";foreach(array_merge((array)$_GET["where"],array(array()))as$s=>$X){if(!$X||("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators))){echo"<div>".select_input(" name='where[$s][col]'",$f,$X["col"],($X?"selectFieldChange":"selectAddRow"),"(".'anywhere'.")"),html_select("where[$s][op]",$this->operators,$X["op"],$bb),"<input type='search' name='where[$s][val]' value='".h($X["val"])."'>",script("mixin(qsl('input'), {oninput: function () { $bb }, onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});",""),"</div>\n";}}echo"</div></fieldset>\n";}function
selectOrderPrint($Ff,$f,$w){print_fieldset("sort",'Sort',$Ff);$s=0;foreach((array)$_GET["order"]as$y=>$X){if($X!=""){echo"<div>".select_input(" name='order[$s]'",$f,$X,"selectFieldChange"),checkbox("desc[$s]",1,isset($_GET["desc"][$y]),'descending')."</div>\n";$s++;}}echo"<div>".select_input(" name='order[$s]'",$f,"","selectAddRow"),checkbox("desc[$s]",1,false,'descending')."</div>\n","</div></fieldset>\n";}function
selectLimitPrint($z){echo"<fieldset><legend>".'Limit'."</legend><div>";echo"<input type='number' name='limit' class='size' value='".h($z)."'>",script("qsl('input').oninput = selectFieldChange;",""),"</div></fieldset>\n";}function
selectLengthPrint($ki){if($ki!==null){echo"<fieldset><legend>".'Text length'."</legend><div>","<input type='number' name='text_length' class='size' value='".h($ki)."'>","</div></fieldset>\n";}}function
selectActionPrint($w){echo"<fieldset><legend>".'Action'."</legend><div>","<input type='submit' value='".'Select'."'>"," <span id='noindex' title='".'Full table scan'."'></span>","<script".nonce().">\n","var indexColumns = ";$f=array();foreach($w
as$v){$Pb=reset($v["columns"]);if($v["type"]!="FULLTEXT"&&$Pb)$f[$Pb]=1;}$f[""]=1;foreach($f
as$y=>$X)json_row($y);echo";\n","selectFieldChange.call(qs('#form')['select']);\n","</script>\n","</div></fieldset>\n";}function
selectCommandPrint(){return!information_schema(DB);}function
selectImportPrint(){return!information_schema(DB);}function
selectEmailPrint($wc,$f){}function
selectColumnsProcess($f,$w){global$qd,$wd;$K=array();$td=array();foreach((array)$_GET["columns"]as$y=>$X){if($X["fun"]=="count"||($X["col"]!=""&&(!$X["fun"]||in_array($X["fun"],$qd)||in_array($X["fun"],$wd)))){$K[$y]=apply_sql_function($X["fun"],($X["col"]!=""?idf_escape($X["col"]):"*"));if(!in_array($X["fun"],$wd))$td[]=$K[$y];}}return
array($K,$td);}function
selectSearchProcess($p,$w){global$g,$m;$H=array();foreach($w
as$s=>$v){if($v["type"]=="FULLTEXT"&&$_GET["fulltext"][$s]!="")$H[]="MATCH (".implode(", ",array_map('idf_escape',$v["columns"])).") AGAINST (".q($_GET["fulltext"][$s]).(isset($_GET["boolean"][$s])?" IN BOOLEAN MODE":"").")";}foreach((array)$_GET["where"]as$y=>$X){if("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators)){$pg="";$xb=" $X[op]";if(preg_match('~IN$~',$X["op"])){$Nd=process_length($X["val"]);$xb.=" ".($Nd!=""?$Nd:"(NULL)");}elseif($X["op"]=="SQL")$xb=" $X[val]";elseif($X["op"]=="LIKE %%")$xb=" LIKE ".$this->processInput($p[$X["col"]],"%$X[val]%");elseif($X["op"]=="ILIKE %%")$xb=" ILIKE ".$this->processInput($p[$X["col"]],"%$X[val]%");elseif($X["op"]=="FIND_IN_SET"){$pg="$X[op](".q($X["val"]).", ";$xb=")";}elseif(!preg_match('~NULL$~',$X["op"]))$xb.=" ".$this->processInput($p[$X["col"]],$X["val"]);if($X["col"]!="")$H[]=$pg.$m->convertSearch(idf_escape($X["col"]),$X,$p[$X["col"]]).$xb;else{$rb=array();foreach($p
as$B=>$o){if((preg_match('~^[-\d.'.(preg_match('~IN$~',$X["op"])?',':'').']+$~',$X["val"])||!preg_match('~'.number_type().'|bit~',$o["type"]))&&(!preg_match("~[\x80-\xFF]~",$X["val"])||preg_match('~char|text|enum|set~',$o["type"])))$rb[]=$pg.$m->convertSearch(idf_escape($B),$X,$o).$xb;}$H[]=($rb?"(".implode(" OR ",$rb).")":"1 = 0");}}}return$H;}function
selectOrderProcess($p,$w){$H=array();foreach((array)$_GET["order"]as$y=>$X){if($X!="")$H[]=(preg_match('~^((COUNT\(DISTINCT |[A-Z0-9_]+\()(`(?:[^`]|``)+`|"(?:[^"]|"")+")\)|COUNT\(\*\))$~',$X)?$X:idf_escape($X)).(isset($_GET["desc"][$y])?" DESC":"");}return$H;}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return(isset($_GET["text_length"])?$_GET["text_length"]:"100");}function
selectEmailProcess($Z,$jd){return
false;}function
selectQueryBuild($K,$Z,$td,$Ff,$z,$D){return"";}function
messageQuery($F,$li,$Tc=false){global$x,$m;restart_session();$Dd=&get_session("queries");if(!$Dd[$_GET["db"]])$Dd[$_GET["db"]]=array();if(strlen($F)>1e6)$F=preg_replace('~[\x80-\xFF]+$~','',substr($F,0,1e6))."\n…";$Dd[$_GET["db"]][]=array($F,time(),$li);$Hh="sql-".count($Dd[$_GET["db"]]);$H="<a href='#$Hh' class='toggle'>".'SQL command'."</a>\n";if(!$Tc&&($kj=$m->warnings())){$t="warnings-".count($Dd[$_GET["db"]]);$H="<a href='#$t' class='toggle'>".'Warnings'."</a>, $H<div id='$t' class='hidden'>\n$kj</div>\n";}return" <span class='time'>".@date("H:i:s")."</span>"." $H<div id='$Hh' class='hidden'><pre><code class='jush-$x'>".shorten_utf8($F,1000)."</code></pre>".($li?" <span class='time'>($li)</span>":'').(support("sql")?'<p><a href="'.h(str_replace("db=".urlencode(DB),"db=".urlencode($_GET["db"]),ME).'sql=&history='.(count($Dd[$_GET["db"]])-1)).'">'.'Edit'.'</a>':'').'</div>';}function
editFunctions($o){global$rc;$H=($o["null"]?"NULL/":"");foreach($rc
as$y=>$qd){if(!$y||(!isset($_GET["call"])&&(isset($_GET["select"])||where($_GET)))){foreach($qd
as$gg=>$X){if(!$gg||preg_match("~$gg~",$o["type"]))$H.="/$X";}if($y&&!preg_match('~set|blob|bytea|raw|file|bool~',$o["type"]))$H.="/SQL";}}if($o["auto_increment"]&&!isset($_GET["select"])&&!where($_GET))$H='Auto Increment';return
explode("/",$H);}function
editInput($Q,$o,$Ja,$Y){if($o["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$Ja value='-1' checked><i>".'original'."</i></label> ":"").($o["null"]?"<label><input type='radio'$Ja value=''".($Y!==null||isset($_GET["select"])?"":" checked")."><i>NULL</i></label> ":"").enum_input("radio",$Ja,$o,$Y,0);return"";}function
editHint($Q,$o,$Y){return"";}function
processInput($o,$Y,$r=""){if($r=="SQL")return$Y;$B=$o["field"];$H=q($Y);if(preg_match('~^(now|getdate|uuid)$~',$r))$H="$r()";elseif(preg_match('~^current_(date|timestamp)$~',$r))$H=$r;elseif(preg_match('~^([+-]|\|\|)$~',$r))$H=idf_escape($B)." $r $H";elseif(preg_match('~^[+-] interval$~',$r))$H=idf_escape($B)." $r ".(preg_match("~^(\\d+|'[0-9.: -]') [A-Z_]+\$~i",$Y)?$Y:$H);elseif(preg_match('~^(addtime|subtime|concat)$~',$r))$H="$r(".idf_escape($B).", $H)";elseif(preg_match('~^(md5|sha1|password|encrypt)$~',$r))$H="$r($H)";return
unconvert_field($o,$H);}function
dumpOutput(){$H=array('text'=>'open','file'=>'save');if(function_exists('gzencode'))$H['gz']='gzip';return$H;}function
dumpFormat(){return
array('sql'=>'SQL','csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($l){}function
dumpTable($Q,$Ph,$ge=0){if($_POST["format"]!="sql"){echo"\xef\xbb\xbf";if($Ph)dump_csv(array_keys(fields($Q)));}else{if($ge==2){$p=array();foreach(fields($Q)as$B=>$o)$p[]=idf_escape($B)." $o[full_type]";$i="CREATE TABLE ".table($Q)." (".implode(", ",$p).")";}else$i=create_sql($Q,$_POST["auto_increment"],$Ph);set_utf8mb4($i);if($Ph&&$i){if($Ph=="DROP+CREATE"||$ge==1)echo"DROP ".($ge==2?"VIEW":"TABLE")." IF EXISTS ".table($Q).";\n";if($ge==1)$i=remove_definer($i);echo"$i;\n\n";}}}function
dumpData($Q,$Ph,$F){global$g,$x;$Le=($x=="sqlite"?0:1048576);if($Ph){if($_POST["format"]=="sql"){if($Ph=="TRUNCATE+INSERT")echo
truncate_sql($Q).";\n";$p=fields($Q);}$G=$g->query($F,1);if($G){$Zd="";$Ya="";$ne=array();$Rh="";$Wc=($Q!=''?'fetch_assoc':'fetch_row');while($I=$G->$Wc()){if(!$ne){$cj=array();foreach($I
as$X){$o=$G->fetch_field();$ne[]=$o->name;$y=idf_escape($o->name);$cj[]="$y = VALUES($y)";}$Rh=($Ph=="INSERT+UPDATE"?"\nON DUPLICATE KEY UPDATE ".implode(", ",$cj):"").";\n";}if($_POST["format"]!="sql"){if($Ph=="table"){dump_csv($ne);$Ph="INSERT";}dump_csv($I);}else{if(!$Zd)$Zd="INSERT INTO ".table($Q)." (".implode(", ",array_map('idf_escape',$ne)).") VALUES";foreach($I
as$y=>$X){$o=$p[$y];$I[$y]=($X!==null?unconvert_field($o,preg_match(number_type(),$o["type"])&&!preg_match('~\[~',$o["full_type"])&&is_numeric($X)?$X:q(($X===false?0:$X))):"NULL");}$fh=($Le?"\n":" ")."(".implode(",\t",$I).")";if(!$Ya)$Ya=$Zd.$fh;elseif(strlen($Ya)+4+strlen($fh)+strlen($Rh)<$Le)$Ya.=",$fh";else{echo$Ya.$Rh;$Ya=$Zd.$fh;}}}if($Ya)echo$Ya.$Rh;}elseif($_POST["format"]=="sql")echo"-- ".str_replace("\n"," ",$g->error)."\n";}}function
dumpFilename($Id){return
friendly_url($Id!=""?$Id:(SERVER!=""?SERVER:"localhost"));}function
dumpHeaders($Id,$af=false){$Qf=$_POST["output"];$Oc=(preg_match('~sql~',$_POST["format"])?"sql":($af?"tar":"csv"));header("Content-Type: ".($Qf=="gz"?"application/x-gzip":($Oc=="tar"?"application/x-tar":($Oc=="sql"||$Qf!="file"?"text/plain":"text/csv")."; charset=utf-8")));if($Qf=="gz")ob_start('ob_gzencode',1e6);return$Oc;}function
importServerPath(){return"adminer.sql";}function
homepage(){echo'<p class="links">'.($_GET["ns"]==""&&support("database")?'<a href="'.h(ME).'database=">'.'Alter database'."</a>\n":""),(support("scheme")?"<a href='".h(ME)."scheme='>".($_GET["ns"]!=""?'Alter schema':'Create schema')."</a>\n":""),($_GET["ns"]!==""?'<a href="'.h(ME).'schema=">'.'Database schema'."</a>\n":""),(support("privileges")?"<a href='".h(ME)."privileges='>".'Privileges'."</a>\n":"");return
true;}function
navigation($Ze){global$ia,$x,$jc,$g;echo'<h1>
',$this->name(),' <span class="version">',$ia,'</span>
<a href="https://www.adminer.org/#download"',target_blank(),' id="version">',(version_compare($ia,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</h1>
';if($Ze=="auth"){$Qf="";foreach((array)$_SESSION["pwds"]as$ej=>$th){foreach($th
as$M=>$Zi){foreach($Zi
as$V=>$E){if($E!==null){$Vb=$_SESSION["db"][$ej][$M][$V];foreach(($Vb?array_keys($Vb):array(""))as$l)$Qf.="<li><a href='".h(auth_url($ej,$M,$V,$l))."'>($jc[$ej]) ".h($V.($M!=""?"@".$this->serverName($M):"").($l!=""?" - $l":""))."</a>\n";}}}}if($Qf)echo"<ul id='logins'>\n$Qf</ul>\n".script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");}else{if($_GET["ns"]!==""&&!$Ze&&DB!=""){$g->select_db(DB);$S=table_status('',true);}echo
script_src(preg_replace("~\\?.*~","",ME)."?file=jush.js&version=4.7.9");if(support("sql")){echo'<script',nonce(),'>
';if($S){$Be=array();foreach($S
as$Q=>$T)$Be[]=preg_quote($Q,'/');echo"var jushLinks = { $x: [ '".js_escape(ME).(support("table")?"table=":"select=")."\$&', /\\b(".implode("|",$Be).")\\b/g ] };\n";foreach(array("bac","bra","sqlite_quo","mssql_bra")as$X)echo"jushLinks.$X = jushLinks.$x;\n";}$sh=$g->server_info;echo'bodyLoad(\'',(is_object($g)?preg_replace('~^(\d\.?\d).*~s','\1',$sh):""),'\'',(preg_match('~MariaDB~',$sh)?", true":""),');
</script>
';}$this->databasesPrint($Ze);if(DB==""||!$Ze){echo"<p class='links'>".(support("sql")?"<a href='".h(ME)."sql='".bold(isset($_GET["sql"])&&!isset($_GET["import"])).">".'SQL command'."</a>\n<a href='".h(ME)."import='".bold(isset($_GET["import"])).">".'Import'."</a>\n":"")."";if(support("dump"))echo"<a href='".h(ME)."dump=".urlencode(isset($_GET["table"])?$_GET["table"]:$_GET["select"])."' id='dump'".bold(isset($_GET["dump"])).">".'Export'."</a>\n";}if($_GET["ns"]!==""&&!$Ze&&DB!=""){echo'<a href="'.h(ME).'create="'.bold($_GET["create"]==="").">".'Create table'."</a>\n";if(!$S)echo"<p class='message'>".'No tables.'."\n";else$this->tablesPrint($S);}}}function
databasesPrint($Ze){global$b,$g;$k=$this->databases();if(DB&&$k&&!in_array(DB,$k))array_unshift($k,DB);echo'<form action="">
<p id="dbs">
';hidden_fields_get();$Tb=script("mixin(qsl('select'), {onmousedown: dbMouseDown, onchange: dbChange});");echo"<span title='".'database'."'>".'DB'."</span>: ".($k?"<select name='db'>".optionlist(array(""=>"")+$k,DB)."</select>$Tb":"<input name='db' value='".h(DB)."' autocapitalize='off'>\n"),"<input type='submit' value='".'Use'."'".($k?" class='hidden'":"").">\n";if($Ze!="db"&&DB!=""&&$g->select_db(DB)){if(support("scheme")){echo"<br>".'Schema'.": <select name='ns'>".optionlist(array(""=>"")+$b->schemas(),$_GET["ns"])."</select>$Tb";if($_GET["ns"]!="")set_schema($_GET["ns"]);}}foreach(array("import","sql","schema","dump","privileges")as$X){if(isset($_GET[$X])){echo"<input type='hidden' name='$X' value=''>";break;}}echo"</p></form>\n";}function
tablesPrint($S){echo"<ul id='tables'>".script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($S
as$Q=>$O){$B=$this->tableName($O);if($B!=""){echo'<li><a href="'.h(ME).'select='.urlencode($Q).'"'.bold($_GET["select"]==$Q||$_GET["edit"]==$Q,"select")." title='".'Select data'."'>".'select'."</a> ",(support("table")||support("indexes")?'<a href="'.h(ME).'table='.urlencode($Q).'"'.bold(in_array($Q,array($_GET["table"],$_GET["create"],$_GET["indexes"],$_GET["foreign"],$_GET["trigger"])),(is_view($O)?"view":"structure"))." title='".'Show structure'."'>$B</a>":"<span>$B</span>")."\n";}}echo"</ul>\n";}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);if($b->operators===null)$b->operators=$Af;function
page_header($oi,$n="",$Xa=array(),$pi=""){global$ca,$ia,$b,$jc,$x;page_headers();if(is_ajax()&&$n){page_messages($n);exit;}$qi=$oi.($pi!=""?": $pi":"");$ri=strip_tags($qi.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>',$ri,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.7.9"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.7.9");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.7.9"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.7.9"),'">
';foreach($b->css()as$Nb){echo'<link rel="stylesheet" type="text/css" href="',h($Nb),'">
';}}echo'
<body class="ltr nojs">
';$ad=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($ad)&&filemtime($ad)+86400>time()){$fj=unserialize(file_get_contents($ad));$_g="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($fj["version"],base64_decode($fj["signature"]),$_g)==1)$_COOKIE["adminer_version"]=$fj["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ia', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape('You are offline.'),'\';
var thousandsSeparator = \'',js_escape(','),'\';
</script>

<div id="help" class="jush-',$x,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Xa!==null){$_=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($_?$_:".").'">'.$jc[DRIVER].'</a> &raquo; ';$_=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$M=$b->serverName(SERVER);$M=($M!=""?$M:'Server');if($Xa===false)echo"$M\n";else{echo"<a href='".h($_)."' accesskey='1' title='Alt+Shift+1'>$M</a> &raquo; ";if($_GET["ns"]!=""||(DB!=""&&is_array($Xa)))echo'<a href="'.h($_."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> &raquo; ';if(is_array($Xa)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> &raquo; ';foreach($Xa
as$y=>$X){$cc=(is_array($X)?$X[1]:h($X));if($cc!="")echo"<a href='".h(ME."$y=").urlencode(is_array($X)?$X[0]:$X)."'>$cc</a> &raquo; ";}}echo"$oi\n";}}echo"<h2>$qi</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($n);$k=&get_session("dbs");if(DB!=""&&$k&&!in_array(DB,$k,true))$k=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$Mb){$Bd=array();foreach($Mb
as$y=>$X)$Bd[]="$y $X";header("Content-Security-Policy: ".implode("; ",$Bd));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$jf;if(!$jf)$jf=base64_encode(rand_string());return$jf;}function
page_messages($n){$Ri=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Ve=$_SESSION["messages"][$Ri];if($Ve){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Ve)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Ri]);}if($n)echo"<div class='error'>$n</div>\n";}function
page_footer($Ze=""){global$b,$vi;echo'</div>

';if($Ze!="auth"){echo'<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="Logout" id="logout">
<input type="hidden" name="token" value="',$vi,'">
</p>
</form>
';}echo'<div id="menu">
';$b->navigation($Ze);echo'</div>
',script("setupSubmitHighlight(document);");}function
int32($cf){while($cf>=2147483648)$cf-=4294967296;while($cf<=-2147483649)$cf+=4294967296;return(int)$cf;}function
long2str($W,$jj){$fh='';foreach($W
as$X)$fh.=pack('V',$X);if($jj)return
substr($fh,0,end($W));return$fh;}function
str2long($fh,$jj){$W=array_values(unpack('V*',str_pad($fh,4*ceil(strlen($fh)/4),"\0")));if($jj)$W[]=strlen($fh);return$W;}function
xxtea_mx($wj,$vj,$Sh,$je){return
int32((($wj>>5&0x7FFFFFF)^$vj<<2)+(($vj>>3&0x1FFFFFFF)^$wj<<4))^int32(($Sh^$vj)+($je^$wj));}function
encrypt_string($Nh,$y){if($Nh=="")return"";$y=array_values(unpack("V*",pack("H*",md5($y))));$W=str2long($Nh,true);$cf=count($W)-1;$wj=$W[$cf];$vj=$W[0];$Ag=floor(6+52/($cf+1));$Sh=0;while($Ag-->0){$Sh=int32($Sh+0x9E3779B9);$qc=$Sh>>2&3;for($Rf=0;$Rf<$cf;$Rf++){$vj=$W[$Rf+1];$bf=xxtea_mx($wj,$vj,$Sh,$y[$Rf&3^$qc]);$wj=int32($W[$Rf]+$bf);$W[$Rf]=$wj;}$vj=$W[0];$bf=xxtea_mx($wj,$vj,$Sh,$y[$Rf&3^$qc]);$wj=int32($W[$cf]+$bf);$W[$cf]=$wj;}return
long2str($W,false);}function
decrypt_string($Nh,$y){if($Nh=="")return"";if(!$y)return
false;$y=array_values(unpack("V*",pack("H*",md5($y))));$W=str2long($Nh,false);$cf=count($W)-1;$wj=$W[$cf];$vj=$W[0];$Ag=floor(6+52/($cf+1));$Sh=int32($Ag*0x9E3779B9);while($Sh){$qc=$Sh>>2&3;for($Rf=$cf;$Rf>0;$Rf--){$wj=$W[$Rf-1];$bf=xxtea_mx($wj,$vj,$Sh,$y[$Rf&3^$qc]);$vj=int32($W[$Rf]-$bf);$W[$Rf]=$vj;}$wj=$W[$cf];$bf=xxtea_mx($wj,$vj,$Sh,$y[$Rf&3^$qc]);$vj=int32($W[0]-$bf);$W[0]=$vj;$Sh=int32($Sh-0x9E3779B9);}return
long2str($W,true);}$g='';$Ad=$_SESSION["token"];if(!$Ad)$_SESSION["token"]=rand(1,1e6);$vi=get_token();$ig=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($y)=explode(":",$X);$ig[$y]=$X;}}function
add_invalid_login(){global$b;$od=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$od)return;$ce=unserialize(stream_get_contents($od));$li=time();if($ce){foreach($ce
as$de=>$X){if($X[0]<$li)unset($ce[$de]);}}$be=&$ce[$b->bruteForceKey()];if(!$be)$be=array($li+30*60,0);$be[1]++;file_write_unlock($od,serialize($ce));}function
check_invalid_login(){global$b;$ce=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$be=$ce[$b->bruteForceKey()];$if=($be[1]>29?$be[0]-time():0);if($if>0)auth_error(lang(array('Too many unsuccessful logins, try again in %d minute.','Too many unsuccessful logins, try again in %d minutes.'),ceil($if/60)));}$Ka=$_POST["auth"];if($Ka){session_regenerate_id();$ej=$Ka["driver"];$M=$Ka["server"];$V=$Ka["username"];$E=(string)$Ka["password"];$l=$Ka["db"];set_password($ej,$M,$V,$E);$_SESSION["db"][$ej][$M][$V][$l]=true;if($Ka["permanent"]){$y=base64_encode($ej)."-".base64_encode($M)."-".base64_encode($V)."-".base64_encode($l);$ug=$b->permanentLogin(true);$ig[$y]="$y:".base64_encode($ug?encrypt_string($E,$ug):"");cookie("adminer_permanent",implode(" ",$ig));}if(count($_POST)==1||DRIVER!=$ej||SERVER!=$M||$_GET["username"]!==$V||DB!=$l)redirect(auth_url($ej,$M,$V,$l));}elseif($_POST["logout"]&&(!$Ad||verify_token())){foreach(array("pwds","db","dbs","queries")as$y)set_session($y,null);unset_permanent();redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),'Logout successful.'.' '.'Thanks for using Adminer, consider <a href="https://www.adminer.org/en/donation/">donating</a>.');}elseif($ig&&!$_SESSION["pwds"]){session_regenerate_id();$ug=$b->permanentLogin();foreach($ig
as$y=>$X){list(,$jb)=explode(":",$X);list($ej,$M,$V,$l)=array_map('base64_decode',explode("-",$y));set_password($ej,$M,$V,decrypt_string(base64_decode($jb),$ug));$_SESSION["db"][$ej][$M][$V][$l]=true;}}function
unset_permanent(){global$ig;foreach($ig
as$y=>$X){list($ej,$M,$V,$l)=array_map('base64_decode',explode("-",$y));if($ej==DRIVER&&$M==SERVER&&$V==$_GET["username"]&&$l==DB)unset($ig[$y]);}cookie("adminer_permanent",implode(" ",$ig));}function
auth_error($n){global$b,$Ad;$uh=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$uh]||$_GET[$uh])&&!$Ad)$n='Session expired, please login again.';else{restart_session();add_invalid_login();$E=get_password();if($E!==null){if($E===false)$n.='<br>'.sprintf('Master password expired. <a href="https://www.adminer.org/en/extension/"%s>Implement</a> %s method to make it permanent.',target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$uh]&&$_GET[$uh]&&ini_bool("session.use_only_cookies"))$n='Session support must be enabled.';$Uf=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$Uf["lifetime"]);page_header('Login',$n,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".'The action will be performed after successful login with the same credentials.'."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header('No extension',sprintf('None of the supported PHP extensions (%s) are available.',implode(", ",$og)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])&&is_string(get_password())){list($Gd,$kg)=explode(":",SERVER,2);if(preg_match('~^\s*([-+]?\d+)~',$kg,$A)&&($A[1]<1024||$A[1]>65535))auth_error('Connecting to privileged ports is not allowed.');check_invalid_login();$g=connect();$m=new
Min_Driver($g);}$De=null;if(!is_object($g)||($De=$b->login($_GET["username"],get_password()))!==true){$n=(is_string($g)?h($g):(is_string($De)?$De:'Invalid credentials.'));auth_error($n.(preg_match('~^ | $~',get_password())?'<br>'.'There is a space in the input password which might be the cause.':''));}if($_POST["logout"]&&$Ad&&!verify_token()){page_header('Logout','Invalid CSRF token. Send the form again.');page_footer("db");exit;}if($Ka&&$_POST["token"])$_POST["token"]=$vi;$n='';if($_POST){if(!verify_token()){$Wd="max_input_vars";$Pe=ini_get($Wd);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$y){$X=ini_get($y);if($X&&(!$Pe||$X<$Pe)){$Wd=$y;$Pe=$X;}}}$n=(!$_POST["token"]&&$Pe?sprintf('Maximum number of allowed fields exceeded. Please increase %s.',"'$Wd'"):'Invalid CSRF token. Send the form again.'.' '.'If you did not send this request from Adminer then close this page.');}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$n=sprintf('Too big POST data. Reduce the data or increase the %s configuration directive.',"'post_max_size'");if(isset($_GET["sql"]))$n.=' '.'You can upload a big SQL file via FTP and import it from server.';}function
select($G,$h=null,$If=array(),$z=0){global$x;$Be=array();$w=array();$f=array();$Ua=array();$U=array();$H=array();odd('');for($s=0;(!$z||$s<$z)&&($I=$G->fetch_row());$s++){if(!$s){echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap'>\n","<thead><tr>";for($ie=0;$ie<count($I);$ie++){$o=$G->fetch_field();$B=$o->name;$Hf=$o->orgtable;$Gf=$o->orgname;$H[$o->table]=$Hf;if($If&&$x=="sql")$Be[$ie]=($B=="table"?"table=":($B=="possible_keys"?"indexes=":null));elseif($Hf!=""){if(!isset($w[$Hf])){$w[$Hf]=array();foreach(indexes($Hf,$h)as$v){if($v["type"]=="PRIMARY"){$w[$Hf]=array_flip($v["columns"]);break;}}$f[$Hf]=$w[$Hf];}if(isset($f[$Hf][$Gf])){unset($f[$Hf][$Gf]);$w[$Hf][$Gf]=$ie;$Be[$ie]=$Hf;}}if($o->charsetnr==63)$Ua[$ie]=true;$U[$ie]=$o->type;echo"<th".($Hf!=""||$o->name!=$Gf?" title='".h(($Hf!=""?"$Hf.":"").$Gf)."'":"").">".h($B).($If?doc_link(array('sql'=>"explain-output.html#explain_".strtolower($B),'mariadb'=>"explain/#the-columns-in-explain-select",)):"");}echo"</thead>\n";}echo"<tr".odd().">";foreach($I
as$y=>$X){$_="";if(isset($Be[$y])&&!$f[$Be[$y]]){if($If&&$x=="sql"){$Q=$I[array_search("table=",$Be)];$_=ME.$Be[$y].urlencode($If[$Q]!=""?$If[$Q]:$Q);}else{$_=ME."edit=".urlencode($Be[$y]);foreach($w[$Be[$y]]as$nb=>$ie)$_.="&where".urlencode("[".bracket_escape($nb)."]")."=".urlencode($I[$ie]);}}elseif(is_url($X))$_=$X;if($X===null)$X="<i>NULL</i>";elseif($Ua[$y]&&!is_utf8($X))$X="<i>".lang(array('%d byte','%d bytes'),strlen($X))."</i>";else{$X=h($X);if($U[$y]==254)$X="<code>$X</code>";}if($_)$X="<a href='".h($_)."'".(is_url($_)?target_blank():'').">$X</a>";echo"<td>$X";}}echo($s?"</table>\n</div>":"<p class='message'>".'No rows.')."\n";return$H;}function
referencable_primary($oh){$H=array();foreach(table_status('',true)as$Wh=>$Q){if($Wh!=$oh&&fk_support($Q)){foreach(fields($Wh)as$o){if($o["primary"]){if($H[$Wh]){unset($H[$Wh]);break;}$H[$Wh]=$o;}}}}return$H;}function
adminer_settings(){parse_str($_COOKIE["adminer_settings"],$wh);return$wh;}function
adminer_setting($y){$wh=adminer_settings();return$wh[$y];}function
set_adminer_settings($wh){return
cookie("adminer_settings",http_build_query($wh+adminer_settings()));}function
textarea($B,$Y,$J=10,$rb=80){global$x;echo"<textarea name='$B' rows='$J' cols='$rb' class='sqlarea jush-$x' spellcheck='false' wrap='off'>";if(is_array($Y)){foreach($Y
as$X)echo
h($X[0])."\n\n\n";}else
echo
h($Y);echo"</textarea>";}function
edit_type($y,$o,$pb,$kd=array(),$Rc=array()){global$Oh,$U,$Pi,$wf;$T=$o["type"];echo'<td><select name="',h($y),'[type]" class="type" aria-labelledby="label-type">';if($T&&!isset($U[$T])&&!isset($kd[$T])&&!in_array($T,$Rc))$Rc[]=$T;if($kd)$Oh['Foreign keys']=$kd;echo
optionlist(array_merge($Rc,$Oh),$T),'</select><td><input name="',h($y),'[length]" value="',h($o["length"]),'" size="3"',(!$o["length"]&&preg_match('~var(char|binary)$~',$T)?" class='required'":"");echo' aria-labelledby="label-length"><td class="options">',"<select name='".h($y)."[collation]'".(preg_match('~(char|text|enum|set)$~',$T)?"":" class='hidden'").'><option value="">('.'collation'.')'.optionlist($pb,$o["collation"]).'</select>',($Pi?"<select name='".h($y)."[unsigned]'".(!$T||preg_match(number_type(),$T)?"":" class='hidden'").'><option>'.optionlist($Pi,$o["unsigned"]).'</select>':''),(isset($o['on_update'])?"<select name='".h($y)."[on_update]'".(preg_match('~timestamp|datetime~',$T)?"":" class='hidden'").'>'.optionlist(array(""=>"(".'ON UPDATE'.")","CURRENT_TIMESTAMP"),(preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?"CURRENT_TIMESTAMP":$o["on_update"])).'</select>':''),($kd?"<select name='".h($y)."[on_delete]'".(preg_match("~`~",$T)?"":" class='hidden'")."><option value=''>(".'ON DELETE'.")".optionlist(explode("|",$wf),$o["on_delete"])."</select> ":" ");}function
process_length($ze){global$Ac;return(preg_match("~^\\s*\\(?\\s*$Ac(?:\\s*,\\s*$Ac)*+\\s*\\)?\\s*\$~",$ze)&&preg_match_all("~$Ac~",$ze,$Je)?"(".implode(",",$Je[0]).")":preg_replace('~^[0-9].*~','(\0)',preg_replace('~[^-0-9,+()[\]]~','',$ze)));}function
process_type($o,$ob="COLLATE"){global$Pi;return" $o[type]".process_length($o["length"]).(preg_match(number_type(),$o["type"])&&in_array($o["unsigned"],$Pi)?" $o[unsigned]":"").(preg_match('~char|text|enum|set~',$o["type"])&&$o["collation"]?" $ob ".q($o["collation"]):"");}function
process_field($o,$Hi){return
array(idf_escape(trim($o["field"])),process_type($Hi),($o["null"]?" NULL":" NOT NULL"),default_value($o),(preg_match('~timestamp|datetime~',$o["type"])&&$o["on_update"]?" ON UPDATE $o[on_update]":""),(support("comment")&&$o["comment"]!=""?" COMMENT ".q($o["comment"]):""),($o["auto_increment"]?auto_increment():null),);}function
default_value($o){$Xb=$o["default"];return($Xb===null?"":" DEFAULT ".(preg_match('~char|binary|text|enum|set~',$o["type"])||preg_match('~^(?![a-z])~i',$Xb)?q($Xb):$Xb));}function
type_class($T){foreach(array('char'=>'text','date'=>'time|year','binary'=>'blob','enum'=>'set',)as$y=>$X){if(preg_match("~$y|$X~",$T))return" class='$y'";}}function
edit_fields($p,$pb,$T="TABLE",$kd=array()){global$Xd;$p=array_values($p);$Yb=(($_POST?$_POST["defaults"]:adminer_setting("defaults"))?"":" class='hidden'");$vb=(($_POST?$_POST["comments"]:adminer_setting("comments"))?"":" class='hidden'");echo'<thead><tr>
';if($T=="PROCEDURE"){echo'<td>';}echo'<th id="label-name">',($T=="TABLE"?'Column name':'Parameter name'),'<td id="label-type">Type<textarea id="enum-edit" rows="4" cols="12" wrap="off" style="display: none;"></textarea>',script("qs('#enum-edit').onblur = editingLengthBlur;"),'<td id="label-length">Length
<td>','Options';if($T=="TABLE"){echo'<td id="label-null">NULL
<td><input type="radio" name="auto_increment_col" value=""><acronym id="label-ai" title="Auto Increment">AI</acronym>',doc_link(array('sql'=>"example-auto-increment.html",'mariadb'=>"auto_increment/",'sqlite'=>"autoinc.html",'pgsql'=>"datatype.html#DATATYPE-SERIAL",'mssql'=>"ms186775.aspx",)),'<td id="label-default"',$Yb,'>Default value
',(support("comment")?"<td id='label-comment'$vb>".'Comment':"");}echo'<td>',"<input type='image' class='icon' name='add[".(support("move_col")?0:count($p))."]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.7.9")."' alt='+' title='".'Add next'."'>".script("row_count = ".count($p).";"),'</thead>
<tbody>
',script("mixin(qsl('tbody'), {onclick: editingClick, onkeydown: editingKeydown, oninput: editingInput});");foreach($p
as$s=>$o){$s++;$Jf=$o[($_POST?"orig":"field")];$gc=(isset($_POST["add"][$s-1])||(isset($o["field"])&&!$_POST["drop_col"][$s]))&&(support("drop_col")||$Jf=="");echo'<tr',($gc?"":" style='display: none;'"),'>
',($T=="PROCEDURE"?"<td>".html_select("fields[$s][inout]",explode("|",$Xd),$o["inout"]):""),'<th>';if($gc){echo'<input name="fields[',$s,'][field]" value="',h($o["field"]),'" data-maxlength="64" autocapitalize="off" aria-labelledby="label-name">';}echo'<input type="hidden" name="fields[',$s,'][orig]" value="',h($Jf),'">';edit_type("fields[$s]",$o,$pb,$kd);if($T=="TABLE"){echo'<td>',checkbox("fields[$s][null]",1,$o["null"],"","","block","label-null"),'<td><label class="block"><input type="radio" name="auto_increment_col" value="',$s,'"';if($o["auto_increment"]){echo' checked';}echo' aria-labelledby="label-ai"></label><td',$Yb,'>',checkbox("fields[$s][has_default]",1,$o["has_default"],"","","","label-default"),'<input name="fields[',$s,'][default]" value="',h($o["default"]),'" aria-labelledby="label-default">',(support("comment")?"<td$vb><input name='fields[$s][comment]' value='".h($o["comment"])."' data-maxlength='".(min_version(5.5)?1024:255)."' aria-labelledby='label-comment'>":"");}echo"<td>",(support("move_col")?"<input type='image' class='icon' name='add[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.7.9")."' alt='+' title='".'Add next'."'> "."<input type='image' class='icon' name='up[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=up.gif&version=4.7.9")."' alt='↑' title='".'Move up'."'> "."<input type='image' class='icon' name='down[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=down.gif&version=4.7.9")."' alt='↓' title='".'Move down'."'> ":""),($Jf==""||support("drop_col")?"<input type='image' class='icon' name='drop_col[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.7.9")."' alt='x' title='".'Remove'."'>":"");}}function
process_fields(&$p){$C=0;if($_POST["up"]){$te=0;foreach($p
as$y=>$o){if(key($_POST["up"])==$y){unset($p[$y]);array_splice($p,$te,0,array($o));break;}if(isset($o["field"]))$te=$C;$C++;}}elseif($_POST["down"]){$md=false;foreach($p
as$y=>$o){if(isset($o["field"])&&$md){unset($p[key($_POST["down"])]);array_splice($p,$C,0,array($md));break;}if(key($_POST["down"])==$y)$md=$o;$C++;}}elseif($_POST["add"]){$p=array_values($p);array_splice($p,key($_POST["add"]),0,array(array()));}elseif(!$_POST["drop_col"])return
false;return
true;}function
normalize_enum($A){return"'".str_replace("'","''",addcslashes(stripcslashes(str_replace($A[0][0].$A[0][0],$A[0][0],substr($A[0],1,-1))),'\\'))."'";}function
grant($rd,$wg,$f,$vf){if(!$wg)return
true;if($wg==array("ALL PRIVILEGES","GRANT OPTION"))return($rd=="GRANT"?queries("$rd ALL PRIVILEGES$vf WITH GRANT OPTION"):queries("$rd ALL PRIVILEGES$vf")&&queries("$rd GRANT OPTION$vf"));return
queries("$rd ".preg_replace('~(GRANT OPTION)\([^)]*\)~','\1',implode("$f, ",$wg).$f).$vf);}function
drop_create($kc,$i,$lc,$ii,$nc,$Ce,$Ue,$Se,$Te,$sf,$ff){if($_POST["drop"])query_redirect($kc,$Ce,$Ue);elseif($sf=="")query_redirect($i,$Ce,$Te);elseif($sf!=$ff){$Kb=queries($i);queries_redirect($Ce,$Se,$Kb&&queries($kc));if($Kb)queries($lc);}else
queries_redirect($Ce,$Se,queries($ii)&&queries($nc)&&queries($kc)&&queries($i));}function
create_trigger($vf,$I){global$x;$ni=" $I[Timing] $I[Event]".($I["Event"]=="UPDATE OF"?" ".idf_escape($I["Of"]):"");return"CREATE TRIGGER ".idf_escape($I["Trigger"]).($x=="mssql"?$vf.$ni:$ni.$vf).rtrim(" $I[Type]\n$I[Statement]",";").";";}function
create_routine($bh,$I){global$Xd,$x;$N=array();$p=(array)$I["fields"];ksort($p);foreach($p
as$o){if($o["field"]!="")$N[]=(preg_match("~^($Xd)\$~",$o["inout"])?"$o[inout] ":"").idf_escape($o["field"]).process_type($o,"CHARACTER SET");}$Zb=rtrim("\n$I[definition]",";");return"CREATE $bh ".idf_escape(trim($I["name"]))." (".implode(", ",$N).")".(isset($_GET["function"])?" RETURNS".process_type($I["returns"],"CHARACTER SET"):"").($I["language"]?" LANGUAGE $I[language]":"").($x=="pgsql"?" AS ".q($Zb):"$Zb;");}function
remove_definer($F){return
preg_replace('~^([A-Z =]+) DEFINER=`'.preg_replace('~@(.*)~','`@`(%|\1)',logged_user()).'`~','\1',$F);}function
format_foreign_key($q){global$wf;$l=$q["db"];$kf=$q["ns"];return" FOREIGN KEY (".implode(", ",array_map('idf_escape',$q["source"])).") REFERENCES ".($l!=""&&$l!=$_GET["db"]?idf_escape($l).".":"").($kf!=""&&$kf!=$_GET["ns"]?idf_escape($kf).".":"").table($q["table"])." (".implode(", ",array_map('idf_escape',$q["target"])).")".(preg_match("~^($wf)\$~",$q["on_delete"])?" ON DELETE $q[on_delete]":"").(preg_match("~^($wf)\$~",$q["on_update"])?" ON UPDATE $q[on_update]":"");}function
tar_file($ad,$si){$H=pack("a100a8a8a8a12a12",$ad,644,0,0,decoct($si->size),decoct(time()));$hb=8*32;for($s=0;$s<strlen($H);$s++)$hb+=ord($H[$s]);$H.=sprintf("%06o",$hb)."\0 ";echo$H,str_repeat("\0",512-strlen($H));$si->send();echo
str_repeat("\0",511-($si->size+511)%512);}function
ini_bytes($Wd){$X=ini_get($Wd);switch(strtolower(substr($X,-1))){case'g':$X*=1024;case'm':$X*=1024;case'k':$X*=1024;}return$X;}function
doc_link($fg,$ji="<sup>?</sup>"){global$x,$g;$sh=$g->server_info;$fj=preg_replace('~^(\d\.?\d).*~s','\1',$sh);$Ui=array('sql'=>"https://dev.mysql.com/doc/refman/$fj/en/",'sqlite'=>"https://www.sqlite.org/",'pgsql'=>"https://www.postgresql.org/docs/$fj/",'mssql'=>"https://msdn.microsoft.com/library/",'oracle'=>"https://www.oracle.com/pls/topic/lookup?ctx=db".preg_replace('~^.* (\d+)\.(\d+)\.\d+\.\d+\.\d+.*~s','\1\2',$sh)."&id=",);if(preg_match('~MariaDB~',$sh)){$Ui['sql']="https://mariadb.com/kb/en/library/";$fg['sql']=(isset($fg['mariadb'])?$fg['mariadb']:str_replace(".html","/",$fg['sql']));}return($fg[$x]?"<a href='$Ui[$x]$fg[$x]'".target_blank().">$ji</a>":"");}function
ob_gzencode($P){return
gzencode($P);}function
db_size($l){global$g;if(!$g->select_db($l))return"?";$H=0;foreach(table_status()as$R)$H+=$R["Data_length"]+$R["Index_length"];return
format_number($H);}function
set_utf8mb4($i){global$g;static$N=false;if(!$N&&preg_match('~\butf8mb4~i',$i)){$N=true;echo"SET NAMES ".charset($g).";\n\n";}}function
connect_error(){global$b,$g,$vi,$n,$jc;if(DB!=""){header("HTTP/1.1 404 Not Found");page_header('Database'.": ".h(DB),'Invalid database.',true);}else{if($_POST["db"]&&!$n)queries_redirect(substr(ME,0,-1),'Databases have been dropped.',drop_databases($_POST["db"]));page_header('Select database',$n,false);echo"<p class='links'>\n";foreach(array('database'=>'Create database','privileges'=>'Privileges','processlist'=>'Process list','variables'=>'Variables','status'=>'Status',)as$y=>$X){if(support($y))echo"<a href='".h(ME)."$y='>$X</a>\n";}echo"<p>".sprintf('%s version: %s through PHP extension %s',$jc[DRIVER],"<b>".h($g->server_info)."</b>","<b>$g->extension</b>")."\n","<p>".sprintf('Logged as: %s',"<b>".h(logged_user())."</b>")."\n";$k=$b->databases();if($k){$ih=support("scheme");$pb=collations();echo"<form action='' method='post'>\n","<table cellspacing='0' class='checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),"<thead><tr>".(support("database")?"<td>":"")."<th>".'Database'." - <a href='".h(ME)."refresh=1'>".'Refresh'."</a>"."<td>".'Collation'."<td>".'Tables'."<td>".'Size'." - <a href='".h(ME)."dbsize=1'>".'Compute'."</a>".script("qsl('a').onclick = partial(ajaxSetHtml, '".js_escape(ME)."script=connect');","")."</thead>\n";$k=($_GET["dbsize"]?count_tables($k):array_flip($k));foreach($k
as$l=>$S){$ah=h(ME)."db=".urlencode($l);$t=h("Db-".$l);echo"<tr".odd().">".(support("database")?"<td>".checkbox("db[]",$l,in_array($l,(array)$_POST["db"]),"","","",$t):""),"<th><a href='$ah' id='$t'>".h($l)."</a>";$d=h(db_collation($l,$pb));echo"<td>".(support("database")?"<a href='$ah".($ih?"&amp;ns=":"")."&amp;database=' title='".'Alter database'."'>$d</a>":$d),"<td align='right'><a href='$ah&amp;schema=' id='tables-".h($l)."' title='".'Database schema'."'>".($_GET["dbsize"]?$S:"?")."</a>","<td align='right' id='size-".h($l)."'>".($_GET["dbsize"]?db_size($l):"?"),"\n";}echo"</table>\n",(support("database")?"<div class='footer'><div>\n"."<fieldset><legend>".'Selected'." <span id='selected'></span></legend><div>\n"."<input type='hidden' name='all' value=''>".script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^db/)); };")."<input type='submit' name='drop' value='".'Drop'."'>".confirm()."\n"."</div></fieldset>\n"."</div></div>\n":""),"<input type='hidden' name='token' value='$vi'>\n","</form>\n",script("tableCheck();");}}page_footer("db");}if(isset($_GET["status"]))$_GET["variables"]=$_GET["status"];if(isset($_GET["import"]))$_GET["sql"]=$_GET["import"];if(!(DB!=""?$g->select_db(DB):isset($_GET["sql"])||isset($_GET["dump"])||isset($_GET["database"])||isset($_GET["processlist"])||isset($_GET["privileges"])||isset($_GET["user"])||isset($_GET["variables"])||$_GET["script"]=="connect"||$_GET["script"]=="kill")){if(DB!=""||$_GET["refresh"]){restart_session();set_session("dbs",null);}connect_error();exit;}if(support("scheme")&&DB!=""&&$_GET["ns"]!==""){if(!isset($_GET["ns"]))redirect(preg_replace('~ns=[^&]*&~','',ME)."ns=".get_schema());if(!set_schema($_GET["ns"])){header("HTTP/1.1 404 Not Found");page_header('Schema'.": ".h($_GET["ns"]),'Invalid schema.',true);page_footer("ns");exit;}}$wf="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";class
TmpFile{var$handler;var$size;function
__construct(){$this->handler=tmpfile();}function
write($Eb){$this->size+=strlen($Eb);fwrite($this->handler,$Eb);}function
send(){fseek($this->handler,0);fpassthru($this->handler);fclose($this->handler);}}$Ac="'(?:''|[^'\\\\]|\\\\.)*'";$Xd="IN|OUT|INOUT";if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["callf"]))$_GET["call"]=$_GET["callf"];if(isset($_GET["function"]))$_GET["procedure"]=$_GET["function"];if(isset($_GET["download"])){$a=$_GET["download"];$p=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$K=array(idf_escape($_GET["field"]));$G=$m->select($a,$K,array(where($_GET,$p)),$K);$I=($G?$G->fetch_row():array());echo$m->value($I[0],$p[$_GET["field"]]);exit;}elseif(isset($_GET["table"])){$a=$_GET["table"];$p=fields($a);if(!$p)$n=error();$R=table_status1($a,true);$B=$b->tableName($R);page_header(($p&&is_view($R)?$R['Engine']=='materialized view'?'Materialized view':'View':'Table').": ".($B!=""?$B:h($a)),$n);$b->selectLinks($R);$ub=$R["Comment"];if($ub!="")echo"<p class='nowrap'>".'Comment'.": ".h($ub)."\n";if($p)$b->tableStructurePrint($p);if(!is_view($R)){if(support("indexes")){echo"<h3 id='indexes'>".'Indexes'."</h3>\n";$w=indexes($a);if($w)$b->tableIndexesPrint($w);echo'<p class="links"><a href="'.h(ME).'indexes='.urlencode($a).'">'.'Alter indexes'."</a>\n";}if(fk_support($R)){echo"<h3 id='foreign-keys'>".'Foreign keys'."</h3>\n";$kd=foreign_keys($a);if($kd){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Source'."<td>".'Target'."<td>".'ON DELETE'."<td>".'ON UPDATE'."<td></thead>\n";foreach($kd
as$B=>$q){echo"<tr title='".h($B)."'>","<th><i>".implode("</i>, <i>",array_map('h',$q["source"]))."</i>","<td><a href='".h($q["db"]!=""?preg_replace('~db=[^&]*~',"db=".urlencode($q["db"]),ME):($q["ns"]!=""?preg_replace('~ns=[^&]*~',"ns=".urlencode($q["ns"]),ME):ME))."table=".urlencode($q["table"])."'>".($q["db"]!=""?"<b>".h($q["db"])."</b>.":"").($q["ns"]!=""?"<b>".h($q["ns"])."</b>.":"").h($q["table"])."</a>","(<i>".implode("</i>, <i>",array_map('h',$q["target"]))."</i>)","<td>".h($q["on_delete"])."\n","<td>".h($q["on_update"])."\n",'<td><a href="'.h(ME.'foreign='.urlencode($a).'&name='.urlencode($B)).'">'.'Alter'.'</a>';}echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'foreign='.urlencode($a).'">'.'Add foreign key'."</a>\n";}}if(support(is_view($R)?"view_trigger":"trigger")){echo"<h3 id='triggers'>".'Triggers'."</h3>\n";$Gi=triggers($a);if($Gi){echo"<table cellspacing='0'>\n";foreach($Gi
as$y=>$X)echo"<tr valign='top'><td>".h($X[0])."<td>".h($X[1])."<th>".h($y)."<td><a href='".h(ME.'trigger='.urlencode($a).'&name='.urlencode($y))."'>".'Alter'."</a>\n";echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'trigger='.urlencode($a).'">'.'Add trigger'."</a>\n";}}elseif(isset($_GET["schema"])){page_header('Database schema',"",array(),h(DB.($_GET["ns"]?".$_GET[ns]":"")));$Yh=array();$Zh=array();$ea=($_GET["schema"]?$_GET["schema"]:$_COOKIE["adminer_schema-".str_replace(".","_",DB)]);preg_match_all('~([^:]+):([-0-9.]+)x([-0-9.]+)(_|$)~',$ea,$Je,PREG_SET_ORDER);foreach($Je
as$s=>$A){$Yh[$A[1]]=array($A[2],$A[3]);$Zh[]="\n\t'".js_escape($A[1])."': [ $A[2], $A[3] ]";}$wi=0;$Ra=-1;$hh=array();$Mg=array();$xe=array();foreach(table_status('',true)as$Q=>$R){if(is_view($R))continue;$lg=0;$hh[$Q]["fields"]=array();foreach(fields($Q)as$B=>$o){$lg+=1.25;$o["pos"]=$lg;$hh[$Q]["fields"][$B]=$o;}$hh[$Q]["pos"]=($Yh[$Q]?$Yh[$Q]:array($wi,0));foreach($b->foreignKeys($Q)as$X){if(!$X["db"]){$ve=$Ra;if($Yh[$Q][1]||$Yh[$X["table"]][1])$ve=min(floatval($Yh[$Q][1]),floatval($Yh[$X["table"]][1]))-1;else$Ra-=.1;while($xe[(string)$ve])$ve-=.0001;$hh[$Q]["references"][$X["table"]][(string)$ve]=array($X["source"],$X["target"]);$Mg[$X["table"]][$Q][(string)$ve]=$X["target"];$xe[(string)$ve]=true;}}$wi=max($wi,$hh[$Q]["pos"][0]+2.5+$lg);}echo'<div id="schema" style="height: ',$wi,'em;">
<script',nonce(),'>
qs(\'#schema\').onselectstart = function () { return false; };
var tablePos = {',implode(",",$Zh)."\n",'};
var em = qs(\'#schema\').offsetHeight / ',$wi,';
document.onmousemove = schemaMousemove;
document.onmouseup = partialArg(schemaMouseup, \'',js_escape(DB),'\');
</script>
';foreach($hh
as$B=>$Q){echo"<div class='table' style='top: ".$Q["pos"][0]."em; left: ".$Q["pos"][1]."em;'>",'<a href="'.h(ME).'table='.urlencode($B).'"><b>'.h($B)."</b></a>",script("qsl('div').onmousedown = schemaMousedown;");foreach($Q["fields"]as$o){$X='<span'.type_class($o["type"]).' title="'.h($o["full_type"].($o["null"]?" NULL":'')).'">'.h($o["field"]).'</span>';echo"<br>".($o["primary"]?"<i>$X</i>":$X);}foreach((array)$Q["references"]as$fi=>$Ng){foreach($Ng
as$ve=>$Jg){$we=$ve-$Yh[$B][1];$s=0;foreach($Jg[0]as$Ch)echo"\n<div class='references' title='".h($fi)."' id='refs$ve-".($s++)."' style='left: $we"."em; top: ".$Q["fields"][$Ch]["pos"]."em; padding-top: .5em;'><div style='border-top: 1px solid Gray; width: ".(-$we)."em;'></div></div>";}}foreach((array)$Mg[$B]as$fi=>$Ng){foreach($Ng
as$ve=>$f){$we=$ve-$Yh[$B][1];$s=0;foreach($f
as$ei)echo"\n<div class='references' title='".h($fi)."' id='refd$ve-".($s++)."' style='left: $we"."em; top: ".$Q["fields"][$ei]["pos"]."em; height: 1.25em; background: url(".h(preg_replace("~\\?.*~","",ME)."?file=arrow.gif) no-repeat right center;&version=4.7.9")."'><div style='height: .5em; border-bottom: 1px solid Gray; width: ".(-$we)."em;'></div></div>";}}echo"\n</div>\n";}foreach($hh
as$B=>$Q){foreach((array)$Q["references"]as$fi=>$Ng){foreach($Ng
as$ve=>$Jg){$Ye=$wi;$Ne=-10;foreach($Jg[0]as$y=>$Ch){$mg=$Q["pos"][0]+$Q["fields"][$Ch]["pos"];$ng=$hh[$fi]["pos"][0]+$hh[$fi]["fields"][$Jg[1][$y]]["pos"];$Ye=min($Ye,$mg,$ng);$Ne=max($Ne,$mg,$ng);}echo"<div class='references' id='refl$ve' style='left: $ve"."em; top: $Ye"."em; padding: .5em 0;'><div style='border-right: 1px solid Gray; margin-top: 1px; height: ".($Ne-$Ye)."em;'></div></div>\n";}}}echo'</div>
<p class="links"><a href="',h(ME."schema=".urlencode($ea)),'" id="schema-link">Permanent link</a>
';}elseif(isset($_GET["dump"])){$a=$_GET["dump"];if($_POST&&!$n){$Hb="";foreach(array("output","format","db_style","routines","events","table_style","auto_increment","triggers","data_style")as$y)$Hb.="&$y=".urlencode($_POST[$y]);cookie("adminer_export",substr($Hb,1));$S=array_flip((array)$_POST["tables"])+array_flip((array)$_POST["data"]);$Oc=dump_headers((count($S)==1?key($S):DB),(DB==""||count($S)>1));$fe=preg_match('~sql~',$_POST["format"]);if($fe){echo"-- Adminer $ia ".$jc[DRIVER]." dump\n\n";if($x=="sql"){echo"SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
".($_POST["data_style"]?"SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
":"")."
";$g->query("SET time_zone = '+00:00'");$g->query("SET sql_mode = ''");}}$Ph=$_POST["db_style"];$k=array(DB);if(DB==""){$k=$_POST["databases"];if(is_string($k))$k=explode("\n",rtrim(str_replace("\r","",$k),"\n"));}foreach((array)$k
as$l){$b->dumpDatabase($l);if($g->select_db($l)){if($fe&&preg_match('~CREATE~',$Ph)&&($i=$g->result("SHOW CREATE DATABASE ".idf_escape($l),1))){set_utf8mb4($i);if($Ph=="DROP+CREATE")echo"DROP DATABASE IF EXISTS ".idf_escape($l).";\n";echo"$i;\n";}if($fe){if($Ph)echo
use_sql($l).";\n\n";$Pf="";if($_POST["routines"]){foreach(array("FUNCTION","PROCEDURE")as$bh){foreach(get_rows("SHOW $bh STATUS WHERE Db = ".q($l),null,"-- ")as$I){$i=remove_definer($g->result("SHOW CREATE $bh ".idf_escape($I["Name"]),2));set_utf8mb4($i);$Pf.=($Ph!='DROP+CREATE'?"DROP $bh IF EXISTS ".idf_escape($I["Name"]).";;\n":"")."$i;;\n\n";}}}if($_POST["events"]){foreach(get_rows("SHOW EVENTS",null,"-- ")as$I){$i=remove_definer($g->result("SHOW CREATE EVENT ".idf_escape($I["Name"]),3));set_utf8mb4($i);$Pf.=($Ph!='DROP+CREATE'?"DROP EVENT IF EXISTS ".idf_escape($I["Name"]).";;\n":"")."$i;;\n\n";}}if($Pf)echo"DELIMITER ;;\n\n$Pf"."DELIMITER ;\n\n";}if($_POST["table_style"]||$_POST["data_style"]){$hj=array();foreach(table_status('',true)as$B=>$R){$Q=(DB==""||in_array($B,(array)$_POST["tables"]));$Qb=(DB==""||in_array($B,(array)$_POST["data"]));if($Q||$Qb){if($Oc=="tar"){$si=new
TmpFile;ob_start(array($si,'write'),1e5);}$b->dumpTable($B,($Q?$_POST["table_style"]:""),(is_view($R)?2:0));if(is_view($R))$hj[]=$B;elseif($Qb){$p=fields($B);$b->dumpData($B,$_POST["data_style"],"SELECT *".convert_fields($p,$p)." FROM ".table($B));}if($fe&&$_POST["triggers"]&&$Q&&($Gi=trigger_sql($B)))echo"\nDELIMITER ;;\n$Gi\nDELIMITER ;\n";if($Oc=="tar"){ob_end_flush();tar_file((DB!=""?"":"$l/")."$B.csv",$si);}elseif($fe)echo"\n";}}if(function_exists('foreign_keys_sql')){foreach(table_status('',true)as$B=>$R){$Q=(DB==""||in_array($B,(array)$_POST["tables"]));if($Q&&!is_view($R))echo
foreign_keys_sql($B);}}foreach($hj
as$gj)$b->dumpTable($gj,$_POST["table_style"],1);if($Oc=="tar")echo
pack("x512");}}}if($fe)echo"-- ".$g->result("SELECT NOW()")."\n";exit;}page_header('Export',$n,($_GET["export"]!=""?array("table"=>$_GET["export"]):array()),h(DB));echo'
<form action="" method="post">
<table cellspacing="0" class="layout">
';$Ub=array('','USE','DROP+CREATE','CREATE');$ai=array('','DROP+CREATE','CREATE');$Rb=array('','TRUNCATE+INSERT','INSERT');if($x=="sql")$Rb[]='INSERT+UPDATE';parse_str($_COOKIE["adminer_export"],$I);if(!$I)$I=array("output"=>"text","format"=>"sql","db_style"=>(DB!=""?"":"CREATE"),"table_style"=>"DROP+CREATE","data_style"=>"INSERT");if(!isset($I["events"])){$I["routines"]=$I["events"]=($_GET["dump"]=="");$I["triggers"]=$I["table_style"];}echo"<tr><th>".'Output'."<td>".html_select("output",$b->dumpOutput(),$I["output"],0)."\n";echo"<tr><th>".'Format'."<td>".html_select("format",$b->dumpFormat(),$I["format"],0)."\n";echo($x=="sqlite"?"":"<tr><th>".'Database'."<td>".html_select('db_style',$Ub,$I["db_style"]).(support("routine")?checkbox("routines",1,$I["routines"],'Routines'):"").(support("event")?checkbox("events",1,$I["events"],'Events'):"")),"<tr><th>".'Tables'."<td>".html_select('table_style',$ai,$I["table_style"]).checkbox("auto_increment",1,$I["auto_increment"],'Auto Increment').(support("trigger")?checkbox("triggers",1,$I["triggers"],'Triggers'):""),"<tr><th>".'Data'."<td>".html_select('data_style',$Rb,$I["data_style"]),'</table>
<p><input type="submit" value="Export">
<input type="hidden" name="token" value="',$vi,'">

<table cellspacing="0">
',script("qsl('table').onclick = dumpClick;");$qg=array();if(DB!=""){$fb=($a!=""?"":" checked");echo"<thead><tr>","<th style='text-align: left;'><label class='block'><input type='checkbox' id='check-tables'$fb>".'Tables'."</label>".script("qs('#check-tables').onclick = partial(formCheck, /^tables\\[/);",""),"<th style='text-align: right;'><label class='block'>".'Data'."<input type='checkbox' id='check-data'$fb></label>".script("qs('#check-data').onclick = partial(formCheck, /^data\\[/);",""),"</thead>\n";$hj="";$bi=tables_list();foreach($bi
as$B=>$T){$pg=preg_replace('~_.*~','',$B);$fb=($a==""||$a==(substr($a,-1)=="%"?"$pg%":$B));$tg="<tr><td>".checkbox("tables[]",$B,$fb,$B,"","block");if($T!==null&&!preg_match('~table~i',$T))$hj.="$tg\n";else
echo"$tg<td align='right'><label class='block'><span id='Rows-".h($B)."'></span>".checkbox("data[]",$B,$fb)."</label>\n";$qg[$pg]++;}echo$hj;if($bi)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}else{echo"<thead><tr><th style='text-align: left;'>","<label class='block'><input type='checkbox' id='check-databases'".($a==""?" checked":"").">".'Database'."</label>",script("qs('#check-databases').onclick = partial(formCheck, /^databases\\[/);",""),"</thead>\n";$k=$b->databases();if($k){foreach($k
as$l){if(!information_schema($l)){$pg=preg_replace('~_.*~','',$l);echo"<tr><td>".checkbox("databases[]",$l,$a==""||$a=="$pg%",$l,"","block")."\n";$qg[$pg]++;}}}else
echo"<tr><td><textarea name='databases' rows='10' cols='20'></textarea>";}echo'</table>
</form>
';$cd=true;foreach($qg
as$y=>$X){if($y!=""&&$X>1){echo($cd?"<p>":" ")."<a href='".h(ME)."dump=".urlencode("$y%")."'>".h($y)."</a>";$cd=false;}}}elseif(isset($_GET["privileges"])){page_header('Privileges');echo'<p class="links"><a href="'.h(ME).'user=">'.'Create user'."</a>";$G=$g->query("SELECT User, Host FROM mysql.".(DB==""?"user":"db WHERE ".q(DB)." LIKE Db")." ORDER BY Host, User");$rd=$G;if(!$G)$G=$g->query("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1) AS User, SUBSTRING_INDEX(CURRENT_USER, '@', -1) AS Host");echo"<form action=''><p>\n";hidden_fields_get();echo"<input type='hidden' name='db' value='".h(DB)."'>\n",($rd?"":"<input type='hidden' name='grant' value=''>\n"),"<table cellspacing='0'>\n","<thead><tr><th>".'Username'."<th>".'Server'."<th></thead>\n";while($I=$G->fetch_assoc())echo'<tr'.odd().'><td>'.h($I["User"])."<td>".h($I["Host"]).'<td><a href="'.h(ME.'user='.urlencode($I["User"]).'&host='.urlencode($I["Host"])).'">'.'Edit'."</a>\n";if(!$rd||DB!="")echo"<tr".odd()."><td><input name='user' autocapitalize='off'><td><input name='host' value='localhost' autocapitalize='off'><td><input type='submit' value='".'Edit'."'>\n";echo"</table>\n","</form>\n";}elseif(isset($_GET["sql"])){if(!$n&&$_POST["export"]){dump_headers("sql");$b->dumpTable("","");$b->dumpData("","table",$_POST["query"]);exit;}restart_session();$Ed=&get_session("queries");$Dd=&$Ed[DB];if(!$n&&$_POST["clear"]){$Dd=array();redirect(remove_from_uri("history"));}page_header((isset($_GET["import"])?'Import':'SQL command'),$n);if(!$n&&$_POST){$od=false;if(!isset($_GET["import"]))$F=$_POST["query"];elseif($_POST["webfile"]){$Gh=$b->importServerPath();$od=@fopen((file_exists($Gh)?$Gh:"compress.zlib://$Gh.gz"),"rb");$F=($od?fread($od,1e6):false);}else$F=get_file("sql_file",true);if(is_string($F)){if(function_exists('memory_get_usage'))@ini_set("memory_limit",max(ini_bytes("memory_limit"),2*strlen($F)+memory_get_usage()+8e6));if($F!=""&&strlen($F)<1e6){$Ag=$F.(preg_match("~;[ \t\r\n]*\$~",$F)?"":";");if(!$Dd||reset(end($Dd))!=$Ag){restart_session();$Dd[]=array($Ag,time());set_session("queries",$Ed);stop_session();}}$Dh="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$bc=";";$C=0;$yc=true;$h=connect();if(is_object($h)&&DB!=""){$h->select_db(DB);if($_GET["ns"]!="")set_schema($_GET["ns"],$h);}$tb=0;$Cc=array();$Wf='[\'"'.($x=="sql"?'`#':($x=="sqlite"?'`[':($x=="mssql"?'[':''))).']|/\*|-- |$'.($x=="pgsql"?'|\$[^$]*\$':'');$xi=microtime(true);parse_str($_COOKIE["adminer_export"],$xa);$pc=$b->dumpFormat();unset($pc["sql"]);while($F!=""){if(!$C&&preg_match("~^$Dh*+DELIMITER\\s+(\\S+)~i",$F,$A)){$bc=$A[1];$F=substr($F,strlen($A[0]));}else{preg_match('('.preg_quote($bc)."\\s*|$Wf)",$F,$A,PREG_OFFSET_CAPTURE,$C);list($md,$lg)=$A[0];if(!$md&&$od&&!feof($od))$F.=fread($od,1e5);else{if(!$md&&rtrim($F)=="")break;$C=$lg+strlen($md);if($md&&rtrim($md)!=$bc){while(preg_match('('.($md=='/*'?'\*/':($md=='['?']':(preg_match('~^-- |^#~',$md)?"\n":preg_quote($md)."|\\\\."))).'|$)s',$F,$A,PREG_OFFSET_CAPTURE,$C)){$fh=$A[0][0];if(!$fh&&$od&&!feof($od))$F.=fread($od,1e5);else{$C=$A[0][1]+strlen($fh);if($fh[0]!="\\")break;}}}else{$yc=false;$Ag=substr($F,0,$lg);$tb++;$tg="<pre id='sql-$tb'><code class='jush-$x'>".$b->sqlCommandQuery($Ag)."</code></pre>\n";if($x=="sqlite"&&preg_match("~^$Dh*+ATTACH\\b~i",$Ag,$A)){echo$tg,"<p class='error'>".'ATTACH queries are not supported.'."\n";$Cc[]=" <a href='#sql-$tb'>$tb</a>";if($_POST["error_stops"])break;}else{if(!$_POST["only_errors"]){echo$tg;ob_flush();flush();}$Kh=microtime(true);if($g->multi_query($Ag)&&is_object($h)&&preg_match("~^$Dh*+USE\\b~i",$Ag))$h->query($Ag);do{$G=$g->store_result();if($g->error){echo($_POST["only_errors"]?$tg:""),"<p class='error'>".'Error in query'.($g->errno?" ($g->errno)":"").": ".error()."\n";$Cc[]=" <a href='#sql-$tb'>$tb</a>";if($_POST["error_stops"])break
2;}else{$li=" <span class='time'>(".format_time($Kh).")</span>".(strlen($Ag)<1000?" <a href='".h(ME)."sql=".urlencode(trim($Ag))."'>".'Edit'."</a>":"");$za=$g->affected_rows;$kj=($_POST["only_errors"]?"":$m->warnings());$lj="warnings-$tb";if($kj)$li.=", <a href='#$lj'>".'Warnings'."</a>".script("qsl('a').onclick = partial(toggle, '$lj');","");$Lc=null;$Mc="explain-$tb";if(is_object($G)){$z=$_POST["limit"];$If=select($G,$h,array(),$z);if(!$_POST["only_errors"]){echo"<form action='' method='post'>\n";$mf=$G->num_rows;echo"<p>".($mf?($z&&$mf>$z?sprintf('%d / ',$z):"").lang(array('%d row','%d rows'),$mf):""),$li;if($h&&preg_match("~^($Dh|\\()*+SELECT\\b~i",$Ag)&&($Lc=explain($h,$Ag)))echo", <a href='#$Mc'>Explain</a>".script("qsl('a').onclick = partial(toggle, '$Mc');","");$t="export-$tb";echo", <a href='#$t'>".'Export'."</a>".script("qsl('a').onclick = partial(toggle, '$t');","")."<span id='$t' class='hidden'>: ".html_select("output",$b->dumpOutput(),$xa["output"])." ".html_select("format",$pc,$xa["format"])."<input type='hidden' name='query' value='".h($Ag)."'>"." <input type='submit' name='export' value='".'Export'."'><input type='hidden' name='token' value='$vi'></span>\n"."</form>\n";}}else{if(preg_match("~^$Dh*+(CREATE|DROP|ALTER)$Dh++(DATABASE|SCHEMA)\\b~i",$Ag)){restart_session();set_session("dbs",null);stop_session();}if(!$_POST["only_errors"])echo"<p class='message' title='".h($g->info)."'>".lang(array('Query executed OK, %d row affected.','Query executed OK, %d rows affected.'),$za)."$li\n";}echo($kj?"<div id='$lj' class='hidden'>\n$kj</div>\n":"");if($Lc){echo"<div id='$Mc' class='hidden'>\n";select($Lc,$h,$If);echo"</div>\n";}}$Kh=microtime(true);}while($g->next_result());}$F=substr($F,$C);$C=0;}}}}if($yc)echo"<p class='message'>".'No commands to execute.'."\n";elseif($_POST["only_errors"]){echo"<p class='message'>".lang(array('%d query executed OK.','%d queries executed OK.'),$tb-count($Cc))," <span class='time'>(".format_time($xi).")</span>\n";}elseif($Cc&&$tb>1)echo"<p class='error'>".'Error in query'.": ".implode("",$Cc)."\n";}else
echo"<p class='error'>".upload_error($F)."\n";}echo'
<form action="" method="post" enctype="multipart/form-data" id="form">
';$Ic="<input type='submit' value='".'Execute'."' title='Ctrl+Enter'>";if(!isset($_GET["import"])){$Ag=$_GET["sql"];if($_POST)$Ag=$_POST["query"];elseif($_GET["history"]=="all")$Ag=$Dd;elseif($_GET["history"]!="")$Ag=$Dd[$_GET["history"]][0];echo"<p>";textarea("query",$Ag,20);echo
script(($_POST?"":"qs('textarea').focus();\n")."qs('#form').onsubmit = partial(sqlSubmit, qs('#form'), '".js_escape(remove_from_uri("sql|limit|error_stops|only_errors|history"))."');"),"<p>$Ic\n",'Limit rows'.": <input type='number' name='limit' class='size' value='".h($_POST?$_POST["limit"]:$_GET["limit"])."'>\n";}else{echo"<fieldset><legend>".'File upload'."</legend><div>";$xd=(extension_loaded("zlib")?"[.gz]":"");echo(ini_bool("file_uploads")?"SQL$xd (&lt; ".ini_get("upload_max_filesize")."B): <input type='file' name='sql_file[]' multiple>\n$Ic":'File uploads are disabled.'),"</div></fieldset>\n";$Md=$b->importServerPath();if($Md){echo"<fieldset><legend>".'From server'."</legend><div>",sprintf('Webserver file %s',"<code>".h($Md)."$xd</code>"),' <input type="submit" name="webfile" value="'.'Run file'.'">',"</div></fieldset>\n";}echo"<p>";}echo
checkbox("error_stops",1,($_POST?$_POST["error_stops"]:isset($_GET["import"])||$_GET["error_stops"]),'Stop on error')."\n",checkbox("only_errors",1,($_POST?$_POST["only_errors"]:isset($_GET["import"])||$_GET["only_errors"]),'Show only errors')."\n","<input type='hidden' name='token' value='$vi'>\n";if(!isset($_GET["import"])&&$Dd){print_fieldset("history",'History',$_GET["history"]!="");for($X=end($Dd);$X;$X=prev($Dd)){$y=key($Dd);list($Ag,$li,$tc)=$X;echo'<a href="'.h(ME."sql=&history=$y").'">'.'Edit'."</a>"." <span class='time' title='".@date('Y-m-d',$li)."'>".@date("H:i:s",$li)."</span>"." <code class='jush-$x'>".shorten_utf8(ltrim(str_replace("\n"," ",str_replace("\r","",preg_replace('~^(#|-- ).*~m','',$Ag)))),80,"</code>").($tc?" <span class='time'>($tc)</span>":"")."<br>\n";}echo"<input type='submit' name='clear' value='".'Clear'."'>\n","<a href='".h(ME."sql=&history=all")."'>".'Edit all'."</a>\n","</div></fieldset>\n";}echo'</form>
';}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$p=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$p):""):where($_GET,$p));$Qi=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($p
as$B=>$o){if(!isset($o["privileges"][$Qi?"update":"insert"])||$b->fieldName($o)==""||$o["generated"])unset($p[$B]);}if($_POST&&!$n&&!isset($_GET["select"])){$Ce=$_POST["referer"];if($_POST["insert"])$Ce=($Qi?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$Ce))$Ce=ME."select=".urlencode($a);$w=indexes($a);$Li=unique_array($_GET["where"],$w);$Dg="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($Ce,'Item has been deleted.',$m->delete($a,$Dg,!$Li));else{$N=array();foreach($p
as$B=>$o){$X=process_input($o);if($X!==false&&$X!==null)$N[idf_escape($B)]=$X;}if($Qi){if(!$N)redirect($Ce);queries_redirect($Ce,'Item has been updated.',$m->update($a,$N,$Dg,!$Li));if(is_ajax()){page_headers();page_messages($n);exit;}}else{$G=$m->insert($a,$N);$ue=($G?last_id():0);queries_redirect($Ce,sprintf('Item%s has been inserted.',($ue?" $ue":"")),$G);}}}$I=null;if($_POST["save"])$I=(array)$_POST["fields"];elseif($Z){$K=array();foreach($p
as$B=>$o){if(isset($o["privileges"]["select"])){$Ga=convert_field($o);if($_POST["clone"]&&$o["auto_increment"])$Ga="''";if($x=="sql"&&preg_match("~enum|set~",$o["type"]))$Ga="1*".idf_escape($B);$K[]=($Ga?"$Ga AS ":"").idf_escape($B);}}$I=array();if(!support("table"))$K=array("*");if($K){$G=$m->select($a,$K,array($Z),$K,array(),(isset($_GET["select"])?2:1));if(!$G)$n=error();else{$I=$G->fetch_assoc();if(!$I)$I=false;}if(isset($_GET["select"])&&(!$I||$G->fetch_assoc()))$I=null;}}if(!support("table")&&!$p){if(!$Z){$G=$m->select($a,array("*"),$Z,array("*"));$I=($G?$G->fetch_assoc():false);if(!$I)$I=array($m->primary=>"");}if($I){foreach($I
as$y=>$X){if(!$Z)$I[$y]=null;$p[$y]=array("field"=>$y,"null"=>($y!=$m->primary),"auto_increment"=>($y==$m->primary));}}}edit_form($a,$p,$I,$Qi);}elseif(isset($_GET["create"])){$a=$_GET["create"];$Yf=array();foreach(array('HASH','LINEAR HASH','KEY','LINEAR KEY','RANGE','LIST')as$y)$Yf[$y]=$y;$Lg=referencable_primary($a);$kd=array();foreach($Lg
as$Wh=>$o)$kd[str_replace("`","``",$Wh)."`".str_replace("`","``",$o["field"])]=$Wh;$Lf=array();$R=array();if($a!=""){$Lf=fields($a);$R=table_status($a);if(!$R)$n='No tables.';}$I=$_POST;$I["fields"]=(array)$I["fields"];if($I["auto_increment_col"])$I["fields"][$I["auto_increment_col"]]["auto_increment"]=true;if($_POST)set_adminer_settings(array("comments"=>$_POST["comments"],"defaults"=>$_POST["defaults"]));if($_POST&&!process_fields($I["fields"])&&!$n){if($_POST["drop"])queries_redirect(substr(ME,0,-1),'Table has been dropped.',drop_tables(array($a)));else{$p=array();$Da=array();$Vi=false;$id=array();$Kf=reset($Lf);$Aa=" FIRST";foreach($I["fields"]as$y=>$o){$q=$kd[$o["type"]];$Hi=($q!==null?$Lg[$q]:$o);if($o["field"]!=""){if(!$o["has_default"])$o["default"]=null;if($y==$I["auto_increment_col"])$o["auto_increment"]=true;$yg=process_field($o,$Hi);$Da[]=array($o["orig"],$yg,$Aa);if($yg!=process_field($Kf,$Kf)){$p[]=array($o["orig"],$yg,$Aa);if($o["orig"]!=""||$Aa)$Vi=true;}if($q!==null)$id[idf_escape($o["field"])]=($a!=""&&$x!="sqlite"?"ADD":" ").format_foreign_key(array('table'=>$kd[$o["type"]],'source'=>array($o["field"]),'target'=>array($Hi["field"]),'on_delete'=>$o["on_delete"],));$Aa=" AFTER ".idf_escape($o["field"]);}elseif($o["orig"]!=""){$Vi=true;$p[]=array($o["orig"]);}if($o["orig"]!=""){$Kf=next($Lf);if(!$Kf)$Aa="";}}$ag="";if($Yf[$I["partition_by"]]){$bg=array();if($I["partition_by"]=='RANGE'||$I["partition_by"]=='LIST'){foreach(array_filter($I["partition_names"])as$y=>$X){$Y=$I["partition_values"][$y];$bg[]="\n  PARTITION ".idf_escape($X)." VALUES ".($I["partition_by"]=='RANGE'?"LESS THAN":"IN").($Y!=""?" ($Y)":" MAXVALUE");}}$ag.="\nPARTITION BY $I[partition_by]($I[partition])".($bg?" (".implode(",",$bg)."\n)":($I["partitions"]?" PARTITIONS ".(+$I["partitions"]):""));}elseif(support("partitioning")&&preg_match("~partitioned~",$R["Create_options"]))$ag.="\nREMOVE PARTITIONING";$Re='Table has been altered.';if($a==""){cookie("adminer_engine",$I["Engine"]);$Re='Table has been created.';}$B=trim($I["name"]);queries_redirect(ME.(support("table")?"table=":"select=").urlencode($B),$Re,alter_table($a,$B,($x=="sqlite"&&($Vi||$id)?$Da:$p),$id,($I["Comment"]!=$R["Comment"]?$I["Comment"]:null),($I["Engine"]&&$I["Engine"]!=$R["Engine"]?$I["Engine"]:""),($I["Collation"]&&$I["Collation"]!=$R["Collation"]?$I["Collation"]:""),($I["Auto_increment"]!=""?number($I["Auto_increment"]):""),$ag));}}page_header(($a!=""?'Alter table':'Create table'),$n,array("table"=>$a),h($a));if(!$_POST){$I=array("Engine"=>$_COOKIE["adminer_engine"],"fields"=>array(array("field"=>"","type"=>(isset($U["int"])?"int":(isset($U["integer"])?"integer":"")),"on_update"=>"")),"partition_names"=>array(""),);if($a!=""){$I=$R;$I["name"]=$a;$I["fields"]=array();if(!$_GET["auto_increment"])$I["Auto_increment"]="";foreach($Lf
as$o){$o["has_default"]=isset($o["default"]);$I["fields"][]=$o;}if(support("partitioning")){$pd="FROM information_schema.PARTITIONS WHERE TABLE_SCHEMA = ".q(DB)." AND TABLE_NAME = ".q($a);$G=$g->query("SELECT PARTITION_METHOD, PARTITION_ORDINAL_POSITION, PARTITION_EXPRESSION $pd ORDER BY PARTITION_ORDINAL_POSITION DESC LIMIT 1");list($I["partition_by"],$I["partitions"],$I["partition"])=$G->fetch_row();$bg=get_key_vals("SELECT PARTITION_NAME, PARTITION_DESCRIPTION $pd AND PARTITION_NAME != '' ORDER BY PARTITION_ORDINAL_POSITION");$bg[""]="";$I["partition_names"]=array_keys($bg);$I["partition_values"]=array_values($bg);}}}$pb=collations();$_c=engines();foreach($_c
as$zc){if(!strcasecmp($zc,$I["Engine"])){$I["Engine"]=$zc;break;}}echo'
<form action="" method="post" id="form">
<p>
';if(support("columns")||$a==""){echo'Table name: <input name="name" data-maxlength="64" value="',h($I["name"]),'" autocapitalize="off">
';if($a==""&&!$_POST)echo
script("focus(qs('#form')['name']);");echo($_c?"<select name='Engine'>".optionlist(array(""=>"(".'engine'.")")+$_c,$I["Engine"])."</select>".on_help("getTarget(event).value",1).script("qsl('select').onchange = helpClose;"):""),' ',($pb&&!preg_match("~sqlite|mssql~",$x)?html_select("Collation",array(""=>"(".'collation'.")")+$pb,$I["Collation"]):""),' <input type="submit" value="Save">
';}echo'
';if(support("columns")){echo'<div class="scrollable">
<table cellspacing="0" id="edit-fields" class="nowrap">
';edit_fields($I["fields"],$pb,"TABLE",$kd);echo'</table>
',script("editFields();"),'</div>
<p>
Auto Increment: <input type="number" name="Auto_increment" size="6" value="',h($I["Auto_increment"]),'">
',checkbox("defaults",1,($_POST?$_POST["defaults"]:adminer_setting("defaults")),'Default values',"columnShow(this.checked, 5)","jsonly"),(support("comment")?checkbox("comments",1,($_POST?$_POST["comments"]:adminer_setting("comments")),'Comment',"editingCommentsClick(this, true);","jsonly").' <input name="Comment" value="'.h($I["Comment"]).'" data-maxlength="'.(min_version(5.5)?2048:60).'">':''),'<p>
<input type="submit" value="Save">
';}echo'
';if($a!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$a));}if(support("partitioning")){$Zf=preg_match('~RANGE|LIST~',$I["partition_by"]);print_fieldset("partition",'Partition by',$I["partition_by"]);echo'<p>
',"<select name='partition_by'>".optionlist(array(""=>"")+$Yf,$I["partition_by"])."</select>".on_help("getTarget(event).value.replace(/./, 'PARTITION BY \$&')",1).script("qsl('select').onchange = partitionByChange;"),'(<input name="partition" value="',h($I["partition"]),'">)
Partitions: <input type="number" name="partitions" class="size',($Zf||!$I["partition_by"]?" hidden":""),'" value="',h($I["partitions"]),'">
<table cellspacing="0" id="partition-table"',($Zf?"":" class='hidden'"),'>
<thead><tr><th>Partition name<th>Values</thead>
';foreach($I["partition_names"]as$y=>$X){echo'<tr>','<td><input name="partition_names[]" value="'.h($X).'" autocapitalize="off">',($y==count($I["partition_names"])-1?script("qsl('input').oninput = partitionNameChange;"):''),'<td><input name="partition_values[]" value="'.h($I["partition_values"][$y]).'">';}echo'</table>
</div></fieldset>
';}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["indexes"])){$a=$_GET["indexes"];$Pd=array("PRIMARY","UNIQUE","INDEX");$R=table_status($a,true);if(preg_match('~MyISAM|M?aria'.(min_version(5.6,'10.0.5')?'|InnoDB':'').'~i',$R["Engine"]))$Pd[]="FULLTEXT";if(preg_match('~MyISAM|M?aria'.(min_version(5.7,'10.2.2')?'|InnoDB':'').'~i',$R["Engine"]))$Pd[]="SPATIAL";$w=indexes($a);$rg=array();if($x=="mongo"){$rg=$w["_id_"];unset($Pd[0]);unset($w["_id_"]);}$I=$_POST;if($_POST&&!$n&&!$_POST["add"]&&!$_POST["drop_col"]){$c=array();foreach($I["indexes"]as$v){$B=$v["name"];if(in_array($v["type"],$Pd)){$f=array();$_e=array();$dc=array();$N=array();ksort($v["columns"]);foreach($v["columns"]as$y=>$e){if($e!=""){$ze=$v["lengths"][$y];$cc=$v["descs"][$y];$N[]=idf_escape($e).($ze?"(".(+$ze).")":"").($cc?" DESC":"");$f[]=$e;$_e[]=($ze?$ze:null);$dc[]=$cc;}}if($f){$Jc=$w[$B];if($Jc){ksort($Jc["columns"]);ksort($Jc["lengths"]);ksort($Jc["descs"]);if($v["type"]==$Jc["type"]&&array_values($Jc["columns"])===$f&&(!$Jc["lengths"]||array_values($Jc["lengths"])===$_e)&&array_values($Jc["descs"])===$dc){unset($w[$B]);continue;}}$c[]=array($v["type"],$B,$N);}}}foreach($w
as$B=>$Jc)$c[]=array($Jc["type"],$B,"DROP");if(!$c)redirect(ME."table=".urlencode($a));queries_redirect(ME."table=".urlencode($a),'Indexes have been altered.',alter_indexes($a,$c));}page_header('Indexes',$n,array("table"=>$a),h($a));$p=array_keys(fields($a));if($_POST["add"]){foreach($I["indexes"]as$y=>$v){if($v["columns"][count($v["columns"])]!="")$I["indexes"][$y]["columns"][]="";}$v=end($I["indexes"]);if($v["type"]||array_filter($v["columns"],'strlen'))$I["indexes"][]=array("columns"=>array(1=>""));}if(!$I){foreach($w
as$y=>$v){$w[$y]["name"]=$y;$w[$y]["columns"][]="";}$w[]=array("columns"=>array(1=>""));$I["indexes"]=$w;}echo'
<form action="" method="post">
<div class="scrollable">
<table cellspacing="0" class="nowrap">
<thead><tr>
<th id="label-type">Index Type
<th><input type="submit" class="wayoff">Column (length)
<th id="label-name">Name
<th><noscript>',"<input type='image' class='icon' name='add[0]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.7.9")."' alt='+' title='".'Add next'."'>",'</noscript>
</thead>
';if($rg){echo"<tr><td>PRIMARY<td>";foreach($rg["columns"]as$y=>$e){echo
select_input(" disabled",$p,$e),"<label><input disabled type='checkbox'>".'descending'."</label> ";}echo"<td><td>\n";}$ie=1;foreach($I["indexes"]as$v){if(!$_POST["drop_col"]||$ie!=key($_POST["drop_col"])){echo"<tr><td>".html_select("indexes[$ie][type]",array(-1=>"")+$Pd,$v["type"],($ie==count($I["indexes"])?"indexesAddRow.call(this);":1),"label-type"),"<td>";ksort($v["columns"]);$s=1;foreach($v["columns"]as$y=>$e){echo"<span>".select_input(" name='indexes[$ie][columns][$s]' title='".'Column'."'",($p?array_combine($p,$p):$p),$e,"partial(".($s==count($v["columns"])?"indexesAddColumn":"indexesChangeColumn").", '".js_escape($x=="sql"?"":$_GET["indexes"]."_")."')"),($x=="sql"||$x=="mssql"?"<input type='number' name='indexes[$ie][lengths][$s]' class='size' value='".h($v["lengths"][$y])."' title='".'Length'."'>":""),(support("descidx")?checkbox("indexes[$ie][descs][$s]",1,$v["descs"][$y],'descending'):"")," </span>";$s++;}echo"<td><input name='indexes[$ie][name]' value='".h($v["name"])."' autocapitalize='off' aria-labelledby='label-name'>\n","<td><input type='image' class='icon' name='drop_col[$ie]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.7.9")."' alt='x' title='".'Remove'."'>".script("qsl('input').onclick = partial(editingRemoveRow, 'indexes\$1[type]');");}$ie++;}echo'</table>
</div>
<p>
<input type="submit" value="Save">
<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["database"])){$I=$_POST;if($_POST&&!$n&&!isset($_POST["add_x"])){$B=trim($I["name"]);if($_POST["drop"]){$_GET["db"]="";queries_redirect(remove_from_uri("db|database"),'Database has been dropped.',drop_databases(array(DB)));}elseif(DB!==$B){if(DB!=""){$_GET["db"]=$B;queries_redirect(preg_replace('~\bdb=[^&]*&~','',ME)."db=".urlencode($B),'Database has been renamed.',rename_database($B,$I["collation"]));}else{$k=explode("\n",str_replace("\r","",$B));$Qh=true;$te="";foreach($k
as$l){if(count($k)==1||$l!=""){if(!create_database($l,$I["collation"]))$Qh=false;$te=$l;}}restart_session();set_session("dbs",null);queries_redirect(ME."db=".urlencode($te),'Database has been created.',$Qh);}}else{if(!$I["collation"])redirect(substr(ME,0,-1));query_redirect("ALTER DATABASE ".idf_escape($B).(preg_match('~^[a-z0-9_]+$~i',$I["collation"])?" COLLATE $I[collation]":""),substr(ME,0,-1),'Database has been altered.');}}page_header(DB!=""?'Alter database':'Create database',$n,array(),h(DB));$pb=collations();$B=DB;if($_POST)$B=$I["name"];elseif(DB!="")$I["collation"]=db_collation(DB,$pb);elseif($x=="sql"){foreach(get_vals("SHOW GRANTS")as$rd){if(preg_match('~ ON (`(([^\\\\`]|``|\\\\.)*)%`\.\*)?~',$rd,$A)&&$A[1]){$B=stripcslashes(idf_unescape("`$A[2]`"));break;}}}echo'
<form action="" method="post">
<p>
',($_POST["add_x"]||strpos($B,"\n")?'<textarea id="name" name="name" rows="10" cols="40">'.h($B).'</textarea><br>':'<input name="name" id="name" value="'.h($B).'" data-maxlength="64" autocapitalize="off">')."\n".($pb?html_select("collation",array(""=>"(".'collation'.")")+$pb,$I["collation"]).doc_link(array('sql'=>"charset-charsets.html",'mariadb'=>"supported-character-sets-and-collations/",'mssql'=>"ms187963.aspx",)):""),script("focus(qs('#name'));"),'<input type="submit" value="Save">
';if(DB!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',DB))."\n";elseif(!$_POST["add_x"]&&$_GET["db"]=="")echo"<input type='image' class='icon' name='add' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.7.9")."' alt='+' title='".'Add next'."'>\n";echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["scheme"])){$I=$_POST;if($_POST&&!$n){$_=preg_replace('~ns=[^&]*&~','',ME)."ns=";if($_POST["drop"])query_redirect("DROP SCHEMA ".idf_escape($_GET["ns"]),$_,'Schema has been dropped.');else{$B=trim($I["name"]);$_.=urlencode($B);if($_GET["ns"]=="")query_redirect("CREATE SCHEMA ".idf_escape($B),$_,'Schema has been created.');elseif($_GET["ns"]!=$B)query_redirect("ALTER SCHEMA ".idf_escape($_GET["ns"])." RENAME TO ".idf_escape($B),$_,'Schema has been altered.');else
redirect($_);}}page_header($_GET["ns"]!=""?'Alter schema':'Create schema',$n);if(!$I)$I["name"]=$_GET["ns"];echo'
<form action="" method="post">
<p><input name="name" id="name" value="',h($I["name"]),'" autocapitalize="off">
',script("focus(qs('#name'));"),'<input type="submit" value="Save">
';if($_GET["ns"]!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$_GET["ns"]))."\n";echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["call"])){$da=($_GET["name"]?$_GET["name"]:$_GET["call"]);page_header('Call'.": ".h($da),$n);$bh=routine($_GET["call"],(isset($_GET["callf"])?"FUNCTION":"PROCEDURE"));$Nd=array();$Pf=array();foreach($bh["fields"]as$s=>$o){if(substr($o["inout"],-3)=="OUT")$Pf[$s]="@".idf_escape($o["field"])." AS ".idf_escape($o["field"]);if(!$o["inout"]||substr($o["inout"],0,2)=="IN")$Nd[]=$s;}if(!$n&&$_POST){$ab=array();foreach($bh["fields"]as$y=>$o){if(in_array($y,$Nd)){$X=process_input($o);if($X===false)$X="''";if(isset($Pf[$y]))$g->query("SET @".idf_escape($o["field"])." = $X");}$ab[]=(isset($Pf[$y])?"@".idf_escape($o["field"]):$X);}$F=(isset($_GET["callf"])?"SELECT":"CALL")." ".table($da)."(".implode(", ",$ab).")";$Kh=microtime(true);$G=$g->multi_query($F);$za=$g->affected_rows;echo$b->selectQuery($F,$Kh,!$G);if(!$G)echo"<p class='error'>".error()."\n";else{$h=connect();if(is_object($h))$h->select_db(DB);do{$G=$g->store_result();if(is_object($G))select($G,$h);else
echo"<p class='message'>".lang(array('Routine has been called, %d row affected.','Routine has been called, %d rows affected.'),$za)." <span class='time'>".@date("H:i:s")."</span>\n";}while($g->next_result());if($Pf)select($g->query("SELECT ".implode(", ",$Pf)));}}echo'
<form action="" method="post">
';if($Nd){echo"<table cellspacing='0' class='layout'>\n";foreach($Nd
as$y){$o=$bh["fields"][$y];$B=$o["field"];echo"<tr><th>".$b->fieldName($o);$Y=$_POST["fields"][$B];if($Y!=""){if($o["type"]=="enum")$Y=+$Y;if($o["type"]=="set")$Y=array_sum($Y);}input($o,$Y,(string)$_POST["function"][$B]);echo"\n";}echo"</table>\n";}echo'<p>
<input type="submit" value="Call">
<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["foreign"])){$a=$_GET["foreign"];$B=$_GET["name"];$I=$_POST;if($_POST&&!$n&&!$_POST["add"]&&!$_POST["change"]&&!$_POST["change-js"]){$Re=($_POST["drop"]?'Foreign key has been dropped.':($B!=""?'Foreign key has been altered.':'Foreign key has been created.'));$Ce=ME."table=".urlencode($a);if(!$_POST["drop"]){$I["source"]=array_filter($I["source"],'strlen');ksort($I["source"]);$ei=array();foreach($I["source"]as$y=>$X)$ei[$y]=$I["target"][$y];$I["target"]=$ei;}if($x=="sqlite")queries_redirect($Ce,$Re,recreate_table($a,$a,array(),array(),array(" $B"=>($_POST["drop"]?"":" ".format_foreign_key($I)))));else{$c="ALTER TABLE ".table($a);$kc="\nDROP ".($x=="sql"?"FOREIGN KEY ":"CONSTRAINT ").idf_escape($B);if($_POST["drop"])query_redirect($c.$kc,$Ce,$Re);else{query_redirect($c.($B!=""?"$kc,":"")."\nADD".format_foreign_key($I),$Ce,$Re);$n='Source and target columns must have the same data type, there must be an index on the target columns and referenced data must exist.'."<br>$n";}}}page_header('Foreign key',$n,array("table"=>$a),h($a));if($_POST){ksort($I["source"]);if($_POST["add"])$I["source"][]="";elseif($_POST["change"]||$_POST["change-js"])$I["target"]=array();}elseif($B!=""){$kd=foreign_keys($a);$I=$kd[$B];$I["source"][]="";}else{$I["table"]=$a;$I["source"]=array("");}echo'
<form action="" method="post">
';$Ch=array_keys(fields($a));if($I["db"]!="")$g->select_db($I["db"]);if($I["ns"]!="")set_schema($I["ns"]);$Kg=array_keys(array_filter(table_status('',true),'fk_support'));$ei=array_keys(fields(in_array($I["table"],$Kg)?$I["table"]:reset($Kg)));$xf="this.form['change-js'].value = '1'; this.form.submit();";echo"<p>".'Target table'.": ".html_select("table",$Kg,$I["table"],$xf)."\n";if($x=="pgsql")echo'Schema'.": ".html_select("ns",$b->schemas(),$I["ns"]!=""?$I["ns"]:$_GET["ns"],$xf);elseif($x!="sqlite"){$Vb=array();foreach($b->databases()as$l){if(!information_schema($l))$Vb[]=$l;}echo'DB'.": ".html_select("db",$Vb,$I["db"]!=""?$I["db"]:$_GET["db"],$xf);}echo'<input type="hidden" name="change-js" value="">
<noscript><p><input type="submit" name="change" value="Change"></noscript>
<table cellspacing="0">
<thead><tr><th id="label-source">Source<th id="label-target">Target</thead>
';$ie=0;foreach($I["source"]as$y=>$X){echo"<tr>","<td>".html_select("source[".(+$y)."]",array(-1=>"")+$Ch,$X,($ie==count($I["source"])-1?"foreignAddRow.call(this);":1),"label-source"),"<td>".html_select("target[".(+$y)."]",$ei,$I["target"][$y],1,"label-target");$ie++;}echo'</table>
<p>
ON DELETE: ',html_select("on_delete",array(-1=>"")+explode("|",$wf),$I["on_delete"]),' ON UPDATE: ',html_select("on_update",array(-1=>"")+explode("|",$wf),$I["on_update"]),doc_link(array('sql'=>"innodb-foreign-key-constraints.html",'mariadb'=>"foreign-keys/",'pgsql'=>"sql-createtable.html#SQL-CREATETABLE-REFERENCES",'mssql'=>"ms174979.aspx",'oracle'=>"https://docs.oracle.com/cd/B19306_01/server.102/b14200/clauses002.htm#sthref2903",)),'<p>
<input type="submit" value="Save">
<noscript><p><input type="submit" name="add" value="Add column"></noscript>
';if($B!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$B));}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["view"])){$a=$_GET["view"];$I=$_POST;$Mf="VIEW";if($x=="pgsql"&&$a!=""){$O=table_status($a);$Mf=strtoupper($O["Engine"]);}if($_POST&&!$n){$B=trim($I["name"]);$Ga=" AS\n$I[select]";$Ce=ME."table=".urlencode($B);$Re='View has been altered.';$T=($_POST["materialized"]?"MATERIALIZED VIEW":"VIEW");if(!$_POST["drop"]&&$a==$B&&$x!="sqlite"&&$T=="VIEW"&&$Mf=="VIEW")query_redirect(($x=="mssql"?"ALTER":"CREATE OR REPLACE")." VIEW ".table($B).$Ga,$Ce,$Re);else{$gi=$B."_adminer_".uniqid();drop_create("DROP $Mf ".table($a),"CREATE $T ".table($B).$Ga,"DROP $T ".table($B),"CREATE $T ".table($gi).$Ga,"DROP $T ".table($gi),($_POST["drop"]?substr(ME,0,-1):$Ce),'View has been dropped.',$Re,'View has been created.',$a,$B);}}if(!$_POST&&$a!=""){$I=view($a);$I["name"]=$a;$I["materialized"]=($Mf!="VIEW");if(!$n)$n=error();}page_header(($a!=""?'Alter view':'Create view'),$n,array("table"=>$a),h($a));echo'
<form action="" method="post">
<p>Name: <input name="name" value="',h($I["name"]),'" data-maxlength="64" autocapitalize="off">
',(support("materializedview")?" ".checkbox("materialized",1,$I["materialized"],'Materialized view'):""),'<p>';textarea("select",$I["select"]);echo'<p>
<input type="submit" value="Save">
';if($a!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$a));}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["event"])){$aa=$_GET["event"];$ae=array("YEAR","QUARTER","MONTH","DAY","HOUR","MINUTE","WEEK","SECOND","YEAR_MONTH","DAY_HOUR","DAY_MINUTE","DAY_SECOND","HOUR_MINUTE","HOUR_SECOND","MINUTE_SECOND");$Mh=array("ENABLED"=>"ENABLE","DISABLED"=>"DISABLE","SLAVESIDE_DISABLED"=>"DISABLE ON SLAVE");$I=$_POST;if($_POST&&!$n){if($_POST["drop"])query_redirect("DROP EVENT ".idf_escape($aa),substr(ME,0,-1),'Event has been dropped.');elseif(in_array($I["INTERVAL_FIELD"],$ae)&&isset($Mh[$I["STATUS"]])){$gh="\nON SCHEDULE ".($I["INTERVAL_VALUE"]?"EVERY ".q($I["INTERVAL_VALUE"])." $I[INTERVAL_FIELD]".($I["STARTS"]?" STARTS ".q($I["STARTS"]):"").($I["ENDS"]?" ENDS ".q($I["ENDS"]):""):"AT ".q($I["STARTS"]))." ON COMPLETION".($I["ON_COMPLETION"]?"":" NOT")." PRESERVE";queries_redirect(substr(ME,0,-1),($aa!=""?'Event has been altered.':'Event has been created.'),queries(($aa!=""?"ALTER EVENT ".idf_escape($aa).$gh.($aa!=$I["EVENT_NAME"]?"\nRENAME TO ".idf_escape($I["EVENT_NAME"]):""):"CREATE EVENT ".idf_escape($I["EVENT_NAME"]).$gh)."\n".$Mh[$I["STATUS"]]." COMMENT ".q($I["EVENT_COMMENT"]).rtrim(" DO\n$I[EVENT_DEFINITION]",";").";"));}}page_header(($aa!=""?'Alter event'.": ".h($aa):'Create event'),$n);if(!$I&&$aa!=""){$J=get_rows("SELECT * FROM information_schema.EVENTS WHERE EVENT_SCHEMA = ".q(DB)." AND EVENT_NAME = ".q($aa));$I=reset($J);}echo'
<form action="" method="post">
<table cellspacing="0" class="layout">
<tr><th>Name<td><input name="EVENT_NAME" value="',h($I["EVENT_NAME"]),'" data-maxlength="64" autocapitalize="off">
<tr><th title="datetime">Start<td><input name="STARTS" value="',h("$I[EXECUTE_AT]$I[STARTS]"),'">
<tr><th title="datetime">End<td><input name="ENDS" value="',h($I["ENDS"]),'">
<tr><th>Every<td><input type="number" name="INTERVAL_VALUE" value="',h($I["INTERVAL_VALUE"]),'" class="size"> ',html_select("INTERVAL_FIELD",$ae,$I["INTERVAL_FIELD"]),'<tr><th>Status<td>',html_select("STATUS",$Mh,$I["STATUS"]),'<tr><th>Comment<td><input name="EVENT_COMMENT" value="',h($I["EVENT_COMMENT"]),'" data-maxlength="64">
<tr><th><td>',checkbox("ON_COMPLETION","PRESERVE",$I["ON_COMPLETION"]=="PRESERVE",'On completion preserve'),'</table>
<p>';textarea("EVENT_DEFINITION",$I["EVENT_DEFINITION"]);echo'<p>
<input type="submit" value="Save">
';if($aa!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$aa));}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["procedure"])){$da=($_GET["name"]?$_GET["name"]:$_GET["procedure"]);$bh=(isset($_GET["function"])?"FUNCTION":"PROCEDURE");$I=$_POST;$I["fields"]=(array)$I["fields"];if($_POST&&!process_fields($I["fields"])&&!$n){$Jf=routine($_GET["procedure"],$bh);$gi="$I[name]_adminer_".uniqid();drop_create("DROP $bh ".routine_id($da,$Jf),create_routine($bh,$I),"DROP $bh ".routine_id($I["name"],$I),create_routine($bh,array("name"=>$gi)+$I),"DROP $bh ".routine_id($gi,$I),substr(ME,0,-1),'Routine has been dropped.','Routine has been altered.','Routine has been created.',$da,$I["name"]);}page_header(($da!=""?(isset($_GET["function"])?'Alter function':'Alter procedure').": ".h($da):(isset($_GET["function"])?'Create function':'Create procedure')),$n);if(!$_POST&&$da!=""){$I=routine($_GET["procedure"],$bh);$I["name"]=$da;}$pb=get_vals("SHOW CHARACTER SET");sort($pb);$ch=routine_languages();echo'
<form action="" method="post" id="form">
<p>Name: <input name="name" value="',h($I["name"]),'" data-maxlength="64" autocapitalize="off">
',($ch?'Language'.": ".html_select("language",$ch,$I["language"])."\n":""),'<input type="submit" value="Save">
<div class="scrollable">
<table cellspacing="0" class="nowrap">
';edit_fields($I["fields"],$pb,$bh);if(isset($_GET["function"])){echo"<tr><td>".'Return type';edit_type("returns",$I["returns"],$pb,array(),($x=="pgsql"?array("void","trigger"):array()));}echo'</table>
',script("editFields();"),'</div>
<p>';textarea("definition",$I["definition"]);echo'<p>
<input type="submit" value="Save">
';if($da!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$da));}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["sequence"])){$fa=$_GET["sequence"];$I=$_POST;if($_POST&&!$n){$_=substr(ME,0,-1);$B=trim($I["name"]);if($_POST["drop"])query_redirect("DROP SEQUENCE ".idf_escape($fa),$_,'Sequence has been dropped.');elseif($fa=="")query_redirect("CREATE SEQUENCE ".idf_escape($B),$_,'Sequence has been created.');elseif($fa!=$B)query_redirect("ALTER SEQUENCE ".idf_escape($fa)." RENAME TO ".idf_escape($B),$_,'Sequence has been altered.');else
redirect($_);}page_header($fa!=""?'Alter sequence'.": ".h($fa):'Create sequence',$n);if(!$I)$I["name"]=$fa;echo'
<form action="" method="post">
<p><input name="name" value="',h($I["name"]),'" autocapitalize="off">
<input type="submit" value="Save">
';if($fa!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$fa))."\n";echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["type"])){$ga=$_GET["type"];$I=$_POST;if($_POST&&!$n){$_=substr(ME,0,-1);if($_POST["drop"])query_redirect("DROP TYPE ".idf_escape($ga),$_,'Type has been dropped.');else
query_redirect("CREATE TYPE ".idf_escape(trim($I["name"]))." $I[as]",$_,'Type has been created.');}page_header($ga!=""?'Alter type'.": ".h($ga):'Create type',$n);if(!$I)$I["as"]="AS ";echo'
<form action="" method="post">
<p>
';if($ga!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$ga))."\n";else{echo"<input name='name' value='".h($I['name'])."' autocapitalize='off'>\n";textarea("as",$I["as"]);echo"<p><input type='submit' value='".'Save'."'>\n";}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["trigger"])){$a=$_GET["trigger"];$B=$_GET["name"];$Fi=trigger_options();$I=(array)trigger($B)+array("Trigger"=>$a."_bi");if($_POST){if(!$n&&in_array($_POST["Timing"],$Fi["Timing"])&&in_array($_POST["Event"],$Fi["Event"])&&in_array($_POST["Type"],$Fi["Type"])){$vf=" ON ".table($a);$kc="DROP TRIGGER ".idf_escape($B).($x=="pgsql"?$vf:"");$Ce=ME."table=".urlencode($a);if($_POST["drop"])query_redirect($kc,$Ce,'Trigger has been dropped.');else{if($B!="")queries($kc);queries_redirect($Ce,($B!=""?'Trigger has been altered.':'Trigger has been created.'),queries(create_trigger($vf,$_POST)));if($B!="")queries(create_trigger($vf,$I+array("Type"=>reset($Fi["Type"]))));}}$I=$_POST;}page_header(($B!=""?'Alter trigger'.": ".h($B):'Create trigger'),$n,array("table"=>$a));echo'
<form action="" method="post" id="form">
<table cellspacing="0" class="layout">
<tr><th>Time<td>',html_select("Timing",$Fi["Timing"],$I["Timing"],"triggerChange(/^".preg_quote($a,"/")."_[ba][iud]$/, '".js_escape($a)."', this.form);"),'<tr><th>Event<td>',html_select("Event",$Fi["Event"],$I["Event"],"this.form['Timing'].onchange();"),(in_array("UPDATE OF",$Fi["Event"])?" <input name='Of' value='".h($I["Of"])."' class='hidden'>":""),'<tr><th>Type<td>',html_select("Type",$Fi["Type"],$I["Type"]),'</table>
<p>Name: <input name="Trigger" value="',h($I["Trigger"]),'" data-maxlength="64" autocapitalize="off">
',script("qs('#form')['Timing'].onchange();"),'<p>';textarea("Statement",$I["Statement"]);echo'<p>
<input type="submit" value="Save">
';if($B!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$B));}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["user"])){$ha=$_GET["user"];$wg=array(""=>array("All privileges"=>""));foreach(get_rows("SHOW PRIVILEGES")as$I){foreach(explode(",",($I["Privilege"]=="Grant option"?"":$I["Context"]))as$Fb)$wg[$Fb][$I["Privilege"]]=$I["Comment"];}$wg["Server Admin"]+=$wg["File access on server"];$wg["Databases"]["Create routine"]=$wg["Procedures"]["Create routine"];unset($wg["Procedures"]["Create routine"]);$wg["Columns"]=array();foreach(array("Select","Insert","Update","References")as$X)$wg["Columns"][$X]=$wg["Tables"][$X];unset($wg["Server Admin"]["Usage"]);foreach($wg["Tables"]as$y=>$X)unset($wg["Databases"][$y]);$ef=array();if($_POST){foreach($_POST["objects"]as$y=>$X)$ef[$X]=(array)$ef[$X]+(array)$_POST["grants"][$y];}$sd=array();$tf="";if(isset($_GET["host"])&&($G=$g->query("SHOW GRANTS FOR ".q($ha)."@".q($_GET["host"])))){while($I=$G->fetch_row()){if(preg_match('~GRANT (.*) ON (.*) TO ~',$I[0],$A)&&preg_match_all('~ *([^(,]*[^ ,(])( *\([^)]+\))?~',$A[1],$Je,PREG_SET_ORDER)){foreach($Je
as$X){if($X[1]!="USAGE")$sd["$A[2]$X[2]"][$X[1]]=true;if(preg_match('~ WITH GRANT OPTION~',$I[0]))$sd["$A[2]$X[2]"]["GRANT OPTION"]=true;}}if(preg_match("~ IDENTIFIED BY PASSWORD '([^']+)~",$I[0],$A))$tf=$A[1];}}if($_POST&&!$n){$uf=(isset($_GET["host"])?q($ha)."@".q($_GET["host"]):"''");if($_POST["drop"])query_redirect("DROP USER $uf",ME."privileges=",'User has been dropped.');else{$gf=q($_POST["user"])."@".q($_POST["host"]);$dg=$_POST["pass"];if($dg!=''&&!$_POST["hashed"]&&!min_version(8)){$dg=$g->result("SELECT PASSWORD(".q($dg).")");$n=!$dg;}$Kb=false;if(!$n){if($uf!=$gf){$Kb=queries((min_version(5)?"CREATE USER":"GRANT USAGE ON *.* TO")." $gf IDENTIFIED BY ".(min_version(8)?"":"PASSWORD ").q($dg));$n=!$Kb;}elseif($dg!=$tf)queries("SET PASSWORD FOR $gf = ".q($dg));}if(!$n){$Yg=array();foreach($ef
as$of=>$rd){if(isset($_GET["grant"]))$rd=array_filter($rd);$rd=array_keys($rd);if(isset($_GET["grant"]))$Yg=array_diff(array_keys(array_filter($ef[$of],'strlen')),$rd);elseif($uf==$gf){$rf=array_keys((array)$sd[$of]);$Yg=array_diff($rf,$rd);$rd=array_diff($rd,$rf);unset($sd[$of]);}if(preg_match('~^(.+)\s*(\(.*\))?$~U',$of,$A)&&(!grant("REVOKE",$Yg,$A[2]," ON $A[1] FROM $gf")||!grant("GRANT",$rd,$A[2]," ON $A[1] TO $gf"))){$n=true;break;}}}if(!$n&&isset($_GET["host"])){if($uf!=$gf)queries("DROP USER $uf");elseif(!isset($_GET["grant"])){foreach($sd
as$of=>$Yg){if(preg_match('~^(.+)(\(.*\))?$~U',$of,$A))grant("REVOKE",array_keys($Yg),$A[2]," ON $A[1] FROM $gf");}}}queries_redirect(ME."privileges=",(isset($_GET["host"])?'User has been altered.':'User has been created.'),!$n);if($Kb)$g->query("DROP USER $gf");}}page_header((isset($_GET["host"])?'Username'.": ".h("$ha@$_GET[host]"):'Create user'),$n,array("privileges"=>array('','Privileges')));if($_POST){$I=$_POST;$sd=$ef;}else{$I=$_GET+array("host"=>$g->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', -1)"));$I["pass"]=$tf;if($tf!="")$I["hashed"]=true;$sd[(DB==""||$sd?"":idf_escape(addcslashes(DB,"%_\\"))).".*"]=array();}echo'<form action="" method="post">
<table cellspacing="0" class="layout">
<tr><th>Server<td><input name="host" data-maxlength="60" value="',h($I["host"]),'" autocapitalize="off">
<tr><th>Username<td><input name="user" data-maxlength="80" value="',h($I["user"]),'" autocapitalize="off">
<tr><th>Password<td><input name="pass" id="pass" value="',h($I["pass"]),'" autocomplete="new-password">
';if(!$I["hashed"])echo
script("typePassword(qs('#pass'));");echo(min_version(8)?"":checkbox("hashed",1,$I["hashed"],'Hashed',"typePassword(this.form['pass'], this.checked);")),'</table>

';echo"<table cellspacing='0'>\n","<thead><tr><th colspan='2'>".'Privileges'.doc_link(array('sql'=>"grant.html#priv_level"));$s=0;foreach($sd
as$of=>$rd){echo'<th>'.($of!="*.*"?"<input name='objects[$s]' value='".h($of)."' size='10' autocapitalize='off'>":"<input type='hidden' name='objects[$s]' value='*.*' size='10'>*.*");$s++;}echo"</thead>\n";foreach(array(""=>"","Server Admin"=>'Server',"Databases"=>'Database',"Tables"=>'Table',"Columns"=>'Column',"Procedures"=>'Routine',)as$Fb=>$cc){foreach((array)$wg[$Fb]as$vg=>$ub){echo"<tr".odd()."><td".($cc?">$cc<td":" colspan='2'").' lang="en" title="'.h($ub).'">'.h($vg);$s=0;foreach($sd
as$of=>$rd){$B="'grants[$s][".h(strtoupper($vg))."]'";$Y=$rd[strtoupper($vg)];if($Fb=="Server Admin"&&$of!=(isset($sd["*.*"])?"*.*":".*"))echo"<td>";elseif(isset($_GET["grant"]))echo"<td><select name=$B><option><option value='1'".($Y?" selected":"").">".'Grant'."<option value='0'".($Y=="0"?" selected":"").">".'Revoke'."</select>";else{echo"<td align='center'><label class='block'>","<input type='checkbox' name=$B value='1'".($Y?" checked":"").($vg=="All privileges"?" id='grants-$s-all'>":">".($vg=="Grant option"?"":script("qsl('input').onclick = function () { if (this.checked) formUncheck('grants-$s-all'); };"))),"</label>";}$s++;}}}echo"</table>\n",'<p>
<input type="submit" value="Save">
';if(isset($_GET["host"])){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',"$ha@$_GET[host]"));}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["processlist"])){if(support("kill")&&$_POST&&!$n){$pe=0;foreach((array)$_POST["kill"]as$X){if(kill_process($X))$pe++;}queries_redirect(ME."processlist=",lang(array('%d process has been killed.','%d processes have been killed.'),$pe),$pe||!$_POST["kill"]);}page_header('Process list',$n);echo'
<form action="" method="post">
<div class="scrollable">
<table cellspacing="0" class="nowrap checkable">
',script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});");$s=-1;foreach(process_list()as$s=>$I){if(!$s){echo"<thead><tr lang='en'>".(support("kill")?"<th>":"");foreach($I
as$y=>$X)echo"<th>$y".doc_link(array('sql'=>"show-processlist.html#processlist_".strtolower($y),'pgsql'=>"monitoring-stats.html#PG-STAT-ACTIVITY-VIEW",'oracle'=>"REFRN30223",));echo"</thead>\n";}echo"<tr".odd().">".(support("kill")?"<td>".checkbox("kill[]",$I[$x=="sql"?"Id":"pid"],0):"");foreach($I
as$y=>$X)echo"<td>".(($x=="sql"&&$y=="Info"&&preg_match("~Query|Killed~",$I["Command"])&&$X!="")||($x=="pgsql"&&$y=="current_query"&&$X!="<IDLE>")||($x=="oracle"&&$y=="sql_text"&&$X!="")?"<code class='jush-$x'>".shorten_utf8($X,100,"</code>").' <a href="'.h(ME.($I["db"]!=""?"db=".urlencode($I["db"])."&":"")."sql=".urlencode($X)).'">'.'Clone'.'</a>':h($X));echo"\n";}echo'</table>
</div>
<p>
';if(support("kill")){echo($s+1)."/".sprintf('%d in total',max_connections()),"<p><input type='submit' value='".'Kill'."'>\n";}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
',script("tableCheck();");}elseif(isset($_GET["select"])){$a=$_GET["select"];$R=table_status1($a);$w=indexes($a);$p=fields($a);$kd=column_foreign_keys($a);$qf=$R["Oid"];parse_str($_COOKIE["adminer_import"],$ya);$Zg=array();$f=array();$ki=null;foreach($p
as$y=>$o){$B=$b->fieldName($o);if(isset($o["privileges"]["select"])&&$B!=""){$f[$y]=html_entity_decode(strip_tags($B),ENT_QUOTES);if(is_shortable($o))$ki=$b->selectLengthProcess();}$Zg+=$o["privileges"];}list($K,$td)=$b->selectColumnsProcess($f,$w);$ee=count($td)<count($K);$Z=$b->selectSearchProcess($p,$w);$Ff=$b->selectOrderProcess($p,$w);$z=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$Mi=>$I){$Ga=convert_field($p[key($I)]);$K=array($Ga?$Ga:idf_escape(key($I)));$Z[]=where_check($Mi,$p);$H=$m->select($a,$K,$Z,$K);if($H)echo
reset($H->fetch_row());}exit;}$rg=$Oi=null;foreach($w
as$v){if($v["type"]=="PRIMARY"){$rg=array_flip($v["columns"]);$Oi=($K?$rg:array());foreach($Oi
as$y=>$X){if(in_array(idf_escape($y),$K))unset($Oi[$y]);}break;}}if($qf&&!$rg){$rg=$Oi=array($qf=>0);$w[]=array("type"=>"PRIMARY","columns"=>array($qf));}if($_POST&&!$n){$qj=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$gb=array();foreach($_POST["check"]as$db)$gb[]=where_check($db,$p);$qj[]="((".implode(") OR (",$gb)."))";}$qj=($qj?"\nWHERE ".implode(" AND ",$qj):"");if($_POST["export"]){cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$pd=($K?implode(", ",$K):"*").convert_fields($f,$p,$K)."\nFROM ".table($a);$vd=($td&&$ee?"\nGROUP BY ".implode(", ",$td):"").($Ff?"\nORDER BY ".implode(", ",$Ff):"");if(!is_array($_POST["check"])||$rg)$F="SELECT $pd$qj$vd";else{$Ki=array();foreach($_POST["check"]as$X)$Ki[]="(SELECT".limit($pd,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p).$vd,1).")";$F=implode(" UNION ALL ",$Ki);}$b->dumpData($a,"table",$F);exit;}if(!$b->selectEmailProcess($Z,$kd)){if($_POST["save"]||$_POST["delete"]){$G=true;$za=0;$N=array();if(!$_POST["delete"]){foreach($f
as$B=>$X){$X=process_input($p[$B]);if($X!==null&&($_POST["clone"]||$X!==false))$N[idf_escape($B)]=($X!==false?$X:idf_escape($B));}}if($_POST["delete"]||$N){if($_POST["clone"])$F="INTO ".table($a)." (".implode(", ",array_keys($N)).")\nSELECT ".implode(", ",$N)."\nFROM ".table($a);if($_POST["all"]||($rg&&is_array($_POST["check"]))||$ee){$G=($_POST["delete"]?$m->delete($a,$qj):($_POST["clone"]?queries("INSERT $F$qj"):$m->update($a,$N,$qj)));$za=$g->affected_rows;}else{foreach((array)$_POST["check"]as$X){$mj="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p);$G=($_POST["delete"]?$m->delete($a,$mj,1):($_POST["clone"]?queries("INSERT".limit1($a,$F,$mj)):$m->update($a,$N,$mj,1)));if(!$G)break;$za+=$g->affected_rows;}}}$Re=lang(array('%d item has been affected.','%d items have been affected.'),$za);if($_POST["clone"]&&$G&&$za==1){$ue=last_id();if($ue)$Re=sprintf('Item%s has been inserted.'," $ue");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Re,$G);if(!$_POST["delete"]){edit_form($a,$p,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$n='Ctrl+click on a value to modify it.';else{$G=true;$za=0;foreach($_POST["val"]as$Mi=>$I){$N=array();foreach($I
as$y=>$X){$y=bracket_escape($y,1);$N[idf_escape($y)]=(preg_match('~char|text~',$p[$y]["type"])||$X!=""?$b->processInput($p[$y],$X):"NULL");}$G=$m->update($a,$N," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($Mi,$p),!$ee&&!$rg," ");if(!$G)break;$za+=$g->affected_rows;}queries_redirect(remove_from_uri(),lang(array('%d item has been affected.','%d items have been affected.'),$za),$G);}}elseif(!is_string($Zc=get_file("csv_file",true)))$n=upload_error($Zc);elseif(!preg_match('~~u',$Zc))$n='File must be in UTF-8 encoding.';else{cookie("adminer_import","output=".urlencode($ya["output"])."&format=".urlencode($_POST["separator"]));$G=true;$rb=array_keys($p);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$Zc,$Je);$za=count($Je[0]);$m->begin();$L=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$J=array();foreach($Je[0]as$y=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$L]*)$L~",$X.$L,$Ke);if(!$y&&!array_diff($Ke[1],$rb)){$rb=$Ke[1];$za--;}else{$N=array();foreach($Ke[1]as$s=>$nb)$N[idf_escape($rb[$s])]=($nb==""&&$p[$rb[$s]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$nb))));$J[]=$N;}}$G=(!$J||$m->insertUpdate($a,$J,$rg));if($G)$G=$m->commit();queries_redirect(remove_from_uri("page"),lang(array('%d row has been imported.','%d rows have been imported.'),$za),$G);$m->rollback();}}}$Wh=$b->tableName($R);if(is_ajax()){page_headers();ob_start();}else
page_header('Select'.": $Wh",$n);$N=null;if(isset($Zg["insert"])||!support("table")){$N="";foreach((array)$_GET["where"]as$X){if($kd[$X["col"]]&&count($kd[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&!preg_match('~[_%]~',$X["val"]))))$N.="&set".urlencode("[".bracket_escape($X["col"])."]")."=".urlencode($X["val"]);}}$b->selectLinks($R,$N);if(!$f&&support("table"))echo"<p class='error'>".'Unable to select the table'.($p?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">',"</div>\n";$b->selectColumnsPrint($K,$f);$b->selectSearchPrint($Z,$f,$w);$b->selectOrderPrint($Ff,$f,$w);$b->selectLimitPrint($z);$b->selectLengthPrint($ki);$b->selectActionPrint($w);echo"</form>\n";$D=$_GET["page"];if($D=="last"){$nd=$g->result(count_rows($a,$Z,$ee,$td));$D=floor(max(0,$nd-1)/$z);}$lh=$K;$ud=$td;if(!$lh){$lh[]="*";$Gb=convert_fields($f,$p,$K);if($Gb)$lh[]=substr($Gb,2);}foreach($K
as$y=>$X){$o=$p[idf_unescape($X)];if($o&&($Ga=convert_field($o)))$lh[$y]="$Ga AS $X";}if(!$ee&&$Oi){foreach($Oi
as$y=>$X){$lh[]=idf_escape($y);if($ud)$ud[]=idf_escape($y);}}$G=$m->select($a,$lh,$Z,$ud,$Ff,$z,$D,true);if(!$G)echo"<p class='error'>".error()."\n";else{if($x=="mssql"&&$D)$G->seek($z*$D);$xc=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$J=array();while($I=$G->fetch_assoc()){if($D&&$x=="oracle")unset($I["RNUM"]);$J[]=$I;}if($_GET["page"]!="last"&&$z!=""&&$td&&$ee&&$x=="sql")$nd=$g->result(" SELECT FOUND_ROWS()");if(!$J)echo"<p class='message'>".'No rows.'."\n";else{$Qa=$b->backwardKeys($a,$Wh);echo"<div class='scrollable'>","<table id='table' cellspacing='0' class='nowrap checkable'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$td&&$K?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".'Modify'."</a>");$df=array();$qd=array();reset($K);$Fg=1;foreach($J[0]as$y=>$X){if(!isset($Oi[$y])){$X=$_GET["columns"][key($K)];$o=$p[$K?($X?$X["col"]:current($K)):$y];$B=($o?$b->fieldName($o,$Fg):($X["fun"]?"*":$y));if($B!=""){$Fg++;$df[$y]=$B;$e=idf_escape($y);$Hd=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($y);$cc="&desc%5B0%5D=1";echo"<th>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Hd.($Ff[0]==$e||$Ff[0]==$y||(!$Ff&&$ee&&$td[0]==$e)?$cc:'')).'">';echo
apply_sql_function($X["fun"],$B)."</a>";echo"<span class='column hidden'>","<a href='".h($Hd.$cc)."' title='".'descending'."' class='text'> ↓</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.'Search'.'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($y)."');");}echo"</span>";}$qd[$y]=$X["fun"];next($K);}}$_e=array();if($_GET["modify"]){foreach($J
as$I){foreach($I
as$y=>$X)$_e[$y]=max($_e[$y],min(40,strlen(utf8_decode($X))));}}echo($Qa?"<th>".'Relations':"")."</thead>\n";if(is_ajax()){if($z%2==1&&$D%2==1)odd();ob_end_clean();}foreach($b->rowDescriptions($J,$kd)as$cf=>$I){$Li=unique_array($J[$cf],$w);if(!$Li){$Li=array();foreach($J[$cf]as$y=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$y))$Li[$y]=$X;}}$Mi="";foreach($Li
as$y=>$X){if(($x=="sql"||$x=="pgsql")&&preg_match('~char|text|enum|set~',$p[$y]["type"])&&strlen($X)>64){$y=(strpos($y,'(')?$y:idf_escape($y));$y="MD5(".($x!='sql'||preg_match("~^utf8~",$p[$y]["collation"])?$y:"CONVERT($y USING ".charset($g).")").")";$X=md5($X);}$Mi.="&".($X!==null?urlencode("where[".bracket_escape($y)."]")."=".urlencode($X):"null%5B%5D=".urlencode($y));}echo"<tr".odd().">".(!$td&&$K?"":"<td>".checkbox("check[]",substr($Mi,1),in_array(substr($Mi,1),(array)$_POST["check"])).($ee||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Mi)."' class='edit'>".'edit'."</a>"));foreach($I
as$y=>$X){if(isset($df[$y])){$o=$p[$y];$X=$m->value($X,$o);if($X!=""&&(!isset($xc[$y])||$xc[$y]!=""))$xc[$y]=(is_mail($X)?$df[$y]:"");$_="";if(preg_match('~blob|bytea|raw|file~',$o["type"])&&$X!="")$_=ME.'download='.urlencode($a).'&field='.urlencode($y).$Mi;if(!$_&&$X!==null){foreach((array)$kd[$y]as$q){if(count($kd[$y])==1||end($q["source"])==$y){$_="";foreach($q["source"]as$s=>$Ch)$_.=where_link($s,$q["target"][$s],$J[$cf][$Ch]);$_=($q["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($q["db"]),ME):ME).'select='.urlencode($q["table"]).$_;if($q["ns"])$_=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($q["ns"]),$_);if(count($q["source"])==1)break;}}}if($y=="COUNT(*)"){$_=ME."select=".urlencode($a);$s=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Li))$_.=where_link($s++,$W["col"],$W["val"],$W["op"]);}foreach($Li
as$je=>$W)$_.=where_link($s++,$je,$W);}$X=select_value($X,$_,$o,$ki);$t=h("val[$Mi][".bracket_escape($y)."]");$Y=$_POST["val"][$Mi][bracket_escape($y)];$sc=!is_array($I[$y])&&is_utf8($X)&&$J[$cf][$y]==$I[$y]&&!$qd[$y];$ji=preg_match('~text|lob~',$o["type"]);echo"<td id='$t'";if(($_GET["modify"]&&$sc)||$Y!==null){$yd=h($Y!==null?$Y:$I[$y]);echo">".($ji?"<textarea name='$t' cols='30' rows='".(substr_count($I[$y],"\n")+1)."'>$yd</textarea>":"<input name='$t' value='$yd' size='$_e[$y]'>");}else{$Ee=strpos($X,"<i>…</i>");echo" data-text='".($Ee?2:($ji?1:0))."'".($sc?"":" data-warning='".h('Use edit link to modify this value.')."'").">$X</td>";}}}if($Qa)echo"<td>";$b->backwardKeysPrint($Qa,$J[$cf]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n","</div>\n";}if(!is_ajax()){if($J||$D){$Hc=true;if($_GET["page"]!="last"){if($z==""||(count($J)<$z&&($J||!$D)))$nd=($D?$D*$z:0)+count($J);elseif($x!="sql"||!$ee){$nd=($ee?false:found_rows($R,$Z));if($nd<max(1e4,2*($D+1)*$z))$nd=reset(slow_query(count_rows($a,$Z,$ee,$td)));else$Hc=false;}}$Sf=($z!=""&&($nd===false||$nd>$z||$D));if($Sf){echo(($nd===false?count($J)+1:$nd-$D*$z)>$z?'<p><a href="'.h(remove_from_uri("page")."&page=".($D+1)).'" class="loadmore">'.'Load more data'.'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$z).", '".'Loading'."…');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($J||$D){if($Sf){$Me=($nd===false?$D+(count($J)>=$z?2:1):floor(($nd-1)/$z));echo"<fieldset>";if($x!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".'Page'."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".'Page'."', '".($D+1)."')); return false; };"),pagination(0,$D).($D>5?" …":"");for($s=max(1,$D-4);$s<min($Me,$D+5);$s++)echo
pagination($s,$D);if($Me>0){echo($D+5<$Me?" …":""),($Hc&&$nd!==false?pagination($Me,$D):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Me'>".'last'."</a>");}}else{echo"<legend>".'Page'."</legend>",pagination(0,$D).($D>1?" …":""),($D?pagination($D,$D):""),($Me>$D?pagination($D+1,$D).($Me>$D+1?" …":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".'Whole result'."</legend>";$hc=($Hc?"":"~ ").$nd;echo
checkbox("all",1,0,($nd!==false?($Hc?"":"~ ").lang(array('%d row','%d rows'),$nd):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$hc' : checked); selectCount('selected2', this.checked || !checked ? '$hc' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>Modify</legend><div>
<input type="submit" value="Save"',($_GET["modify"]?'':' title="'.'Ctrl+click on a value to modify it.'.'"'),'>
</div></fieldset>
<fieldset><legend>Selected <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="Edit">
<input type="submit" name="clone" value="Clone">
<input type="submit" name="delete" value="Delete">',confirm(),'</div></fieldset>
';}$ld=$b->dumpFormat();foreach((array)$_GET["columns"]as$e){if($e["fun"]){unset($ld['sql']);break;}}if($ld){print_fieldset("export",'Export'." <span id='selected2'></span>");$Qf=$b->dumpOutput();echo($Qf?html_select("output",$Qf,$ya["output"])." ":""),html_select("format",$ld,$ya["format"])," <input type='submit' name='export' value='".'Export'."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($xc,'strlen'),$f);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".'Import'."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$ya["format"],1);echo" <input type='submit' name='import' value='".'Import'."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$vi'>\n","</form>\n",(!$td&&$K?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["variables"])){$O=isset($_GET["status"]);page_header($O?'Status':'Variables');$dj=($O?show_status():show_variables());if(!$dj)echo"<p class='message'>".'No rows.'."\n";else{echo"<table cellspacing='0'>\n";foreach($dj
as$y=>$X){echo"<tr>","<th><code class='jush-".$x.($O?"status":"set")."'>".h($y)."</code>","<td>".h($X);}echo"</table>\n";}}elseif(isset($_GET["script"])){header("Content-Type: text/javascript; charset=utf-8");if($_GET["script"]=="db"){$Th=array("Data_length"=>0,"Index_length"=>0,"Data_free"=>0);foreach(table_status()as$B=>$R){json_row("Comment-$B",h($R["Comment"]));if(!is_view($R)){foreach(array("Engine","Collation")as$y)json_row("$y-$B",h($R[$y]));foreach($Th+array("Auto_increment"=>0,"Rows"=>0)as$y=>$X){if($R[$y]!=""){$X=format_number($R[$y]);json_row("$y-$B",($y=="Rows"&&$X&&$R["Engine"]==($Fh=="pgsql"?"table":"InnoDB")?"~ $X":$X));if(isset($Th[$y]))$Th[$y]+=($R["Engine"]!="InnoDB"||$y!="Data_free"?$R[$y]:0);}elseif(array_key_exists($y,$R))json_row("$y-$B");}}}foreach($Th
as$y=>$X)json_row("sum-$y",format_number($X));json_row("");}elseif($_GET["script"]=="kill")$g->query("KILL ".number($_POST["kill"]));else{foreach(count_tables($b->databases())as$l=>$X){json_row("tables-$l",$X);json_row("size-$l",db_size($l));}json_row("");}exit;}else{$ci=array_merge((array)$_POST["tables"],(array)$_POST["views"]);if($ci&&!$n&&!$_POST["search"]){$G=true;$Re="";if($x=="sql"&&$_POST["tables"]&&count($_POST["tables"])>1&&($_POST["drop"]||$_POST["truncate"]||$_POST["copy"]))queries("SET foreign_key_checks = 0");if($_POST["truncate"]){if($_POST["tables"])$G=truncate_tables($_POST["tables"]);$Re='Tables have been truncated.';}elseif($_POST["move"]){$G=move_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Re='Tables have been moved.';}elseif($_POST["copy"]){$G=copy_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Re='Tables have been copied.';}elseif($_POST["drop"]){if($_POST["views"])$G=drop_views($_POST["views"]);if($G&&$_POST["tables"])$G=drop_tables($_POST["tables"]);$Re='Tables have been dropped.';}elseif($x!="sql"){$G=($x=="sqlite"?queries("VACUUM"):apply_queries("VACUUM".($_POST["optimize"]?"":" ANALYZE"),$_POST["tables"]));$Re='Tables have been optimized.';}elseif(!$_POST["tables"])$Re='No tables.';elseif($G=queries(($_POST["optimize"]?"OPTIMIZE":($_POST["check"]?"CHECK":($_POST["repair"]?"REPAIR":"ANALYZE")))." TABLE ".implode(", ",array_map('idf_escape',$_POST["tables"])))){while($I=$G->fetch_assoc())$Re.="<b>".h($I["Table"])."</b>: ".h($I["Msg_text"])."<br>";}queries_redirect(substr(ME,0,-1),$Re,$G);}page_header(($_GET["ns"]==""?'Database'.": ".h(DB):'Schema'.": ".h($_GET["ns"])),$n,true);if($b->homepage()){if($_GET["ns"]!==""){echo"<h3 id='tables-views'>".'Tables and views'."</h3>\n";$bi=tables_list();if(!$bi)echo"<p class='message'>".'No tables.'."\n";else{echo"<form action='' method='post'>\n";if(support("table")){echo"<fieldset><legend>".'Search data in tables'." <span id='selected2'></span></legend><div>","<input type='search' name='query' value='".h($_POST["query"])."'>",script("qsl('input').onkeydown = partialArg(bodyKeydown, 'search');","")," <input type='submit' name='search' value='".'Search'."'>\n","</div></fieldset>\n";if($_POST["search"]&&$_POST["query"]!=""){$_GET["where"][0]["op"]="LIKE %%";search_tables();}}echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^(tables|views)\[/);",""),'<th>'.'Table','<td>'.'Engine'.doc_link(array('sql'=>'storage-engines.html')),'<td>'.'Collation'.doc_link(array('sql'=>'charset-charsets.html','mariadb'=>'supported-character-sets-and-collations/')),'<td>'.'Data Length'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-admin.html#FUNCTIONS-ADMIN-DBOBJECT','oracle'=>'REFRN20286')),'<td>'.'Index Length'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-admin.html#FUNCTIONS-ADMIN-DBOBJECT')),'<td>'.'Data Free'.doc_link(array('sql'=>'show-table-status.html')),'<td>'.'Auto Increment'.doc_link(array('sql'=>'example-auto-increment.html','mariadb'=>'auto_increment/')),'<td>'.'Rows'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'catalog-pg-class.html#CATALOG-PG-CLASS','oracle'=>'REFRN20286')),(support("comment")?'<td>'.'Comment'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-info.html#FUNCTIONS-INFO-COMMENT-TABLE')):''),"</thead>\n";$S=0;foreach($bi
as$B=>$T){$gj=($T!==null&&!preg_match('~table~i',$T));$t=h("Table-".$B);echo'<tr'.odd().'><td>'.checkbox(($gj?"views[]":"tables[]"),$B,in_array($B,$ci,true),"","","",$t),'<th>'.(support("table")||support("indexes")?"<a href='".h(ME)."table=".urlencode($B)."' title='".'Show structure'."' id='$t'>".h($B).'</a>':h($B));if($gj){echo'<td colspan="6"><a href="'.h(ME)."view=".urlencode($B).'" title="'.'Alter view'.'">'.(preg_match('~materialized~i',$T)?'Materialized view':'View').'</a>','<td align="right"><a href="'.h(ME)."select=".urlencode($B).'" title="'.'Select data'.'">?</a>';}else{foreach(array("Engine"=>array(),"Collation"=>array(),"Data_length"=>array("create",'Alter table'),"Index_length"=>array("indexes",'Alter indexes'),"Data_free"=>array("edit",'New item'),"Auto_increment"=>array("auto_increment=1&create",'Alter table'),"Rows"=>array("select",'Select data'),)as$y=>$_){$t=" id='$y-".h($B)."'";echo($_?"<td align='right'>".(support("table")||$y=="Rows"||(support("indexes")&&$y!="Data_length")?"<a href='".h(ME."$_[0]=").urlencode($B)."'$t title='$_[1]'>?</a>":"<span$t>?</span>"):"<td id='$y-".h($B)."'>");}$S++;}echo(support("comment")?"<td id='Comment-".h($B)."'>":"");}echo"<tr><td><th>".sprintf('%d in total',count($bi)),"<td>".h($x=="sql"?$g->result("SELECT @@default_storage_engine"):""),"<td>".h(db_collation(DB,collations()));foreach(array("Data_length","Index_length","Data_free")as$y)echo"<td align='right' id='sum-$y'>";echo"</table>\n","</div>\n";if(!information_schema(DB)){echo"<div class='footer'><div>\n";$aj="<input type='submit' value='".'Vacuum'."'> ".on_help("'VACUUM'");$Bf="<input type='submit' name='optimize' value='".'Optimize'."'> ".on_help($x=="sql"?"'OPTIMIZE TABLE'":"'VACUUM OPTIMIZE'");echo"<fieldset><legend>".'Selected'." <span id='selected'></span></legend><div>".($x=="sqlite"?$aj:($x=="pgsql"?$aj.$Bf:($x=="sql"?"<input type='submit' value='".'Analyze'."'> ".on_help("'ANALYZE TABLE'").$Bf."<input type='submit' name='check' value='".'Check'."'> ".on_help("'CHECK TABLE'")."<input type='submit' name='repair' value='".'Repair'."'> ".on_help("'REPAIR TABLE'"):"")))."<input type='submit' name='truncate' value='".'Truncate'."'> ".on_help($x=="sqlite"?"'DELETE'":"'TRUNCATE".($x=="pgsql"?"'":" TABLE'")).confirm()."<input type='submit' name='drop' value='".'Drop'."'>".on_help("'DROP TABLE'").confirm()."\n";$k=(support("scheme")?$b->schemas():$b->databases());if(count($k)!=1&&$x!="sqlite"){$l=(isset($_POST["target"])?$_POST["target"]:(support("scheme")?$_GET["ns"]:DB));echo"<p>".'Move to other database'.": ",($k?html_select("target",$k,$l):'<input name="target" value="'.h($l).'" autocapitalize="off">')," <input type='submit' name='move' value='".'Move'."'>",(support("copy")?" <input type='submit' name='copy' value='".'Copy'."'> ".checkbox("overwrite",1,$_POST["overwrite"],'overwrite'):""),"\n";}echo"<input type='hidden' name='all' value=''>";echo
script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^(tables|views)\[/));".(support("table")?" selectCount('selected2', formChecked(this, /^tables\[/) || $S);":"")." }"),"<input type='hidden' name='token' value='$vi'>\n","</div></fieldset>\n","</div></div>\n";}echo"</form>\n",script("tableCheck();");}echo'<p class="links"><a href="'.h(ME).'create=">'.'Create table'."</a>\n",(support("view")?'<a href="'.h(ME).'view=">'.'Create view'."</a>\n":"");if(support("routine")){echo"<h3 id='routines'>".'Routines'."</h3>\n";$dh=routines();if($dh){echo"<table cellspacing='0'>\n",'<thead><tr><th>'.'Name'.'<td>'.'Type'.'<td>'.'Return type'."<td></thead>\n";odd('');foreach($dh
as$I){$B=($I["SPECIFIC_NAME"]==$I["ROUTINE_NAME"]?"":"&name=".urlencode($I["ROUTINE_NAME"]));echo'<tr'.odd().'>','<th><a href="'.h(ME.($I["ROUTINE_TYPE"]!="PROCEDURE"?'callf=':'call=').urlencode($I["SPECIFIC_NAME"]).$B).'">'.h($I["ROUTINE_NAME"]).'</a>','<td>'.h($I["ROUTINE_TYPE"]),'<td>'.h($I["DTD_IDENTIFIER"]),'<td><a href="'.h(ME.($I["ROUTINE_TYPE"]!="PROCEDURE"?'function=':'procedure=').urlencode($I["SPECIFIC_NAME"]).$B).'">'.'Alter'."</a>";}echo"</table>\n";}echo'<p class="links">'.(support("procedure")?'<a href="'.h(ME).'procedure=">'.'Create procedure'.'</a>':'').'<a href="'.h(ME).'function=">'.'Create function'."</a>\n";}if(support("sequence")){echo"<h3 id='sequences'>".'Sequences'."</h3>\n";$rh=get_vals("SELECT sequence_name FROM information_schema.sequences WHERE sequence_schema = current_schema() ORDER BY sequence_name");if($rh){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."</thead>\n";odd('');foreach($rh
as$X)echo"<tr".odd()."><th><a href='".h(ME)."sequence=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."sequence='>".'Create sequence'."</a>\n";}if(support("type")){echo"<h3 id='user-types'>".'User types'."</h3>\n";$Yi=types();if($Yi){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."</thead>\n";odd('');foreach($Yi
as$X)echo"<tr".odd()."><th><a href='".h(ME)."type=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."type='>".'Create type'."</a>\n";}if(support("event")){echo"<h3 id='events'>".'Events'."</h3>\n";$J=get_rows("SHOW EVENTS");if($J){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."<td>".'Schedule'."<td>".'Start'."<td>".'End'."<td></thead>\n";foreach($J
as$I){echo"<tr>","<th>".h($I["Name"]),"<td>".($I["Execute at"]?'At given time'."<td>".$I["Execute at"]:'Every'." ".$I["Interval value"]." ".$I["Interval field"]."<td>$I[Starts]"),"<td>$I[Ends]",'<td><a href="'.h(ME).'event='.urlencode($I["Name"]).'">'.'Alter'.'</a>';}echo"</table>\n";$Fc=$g->result("SELECT @@event_scheduler");if($Fc&&$Fc!="ON")echo"<p class='error'><code class='jush-sqlset'>event_scheduler</code>: ".h($Fc)."\n";}echo'<p class="links"><a href="'.h(ME).'event=">'.'Create event'."</a>\n";}if($bi)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}}}page_footer();