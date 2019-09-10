<?php
 if(empty($pageid)||$pageid<0||!$pageid){
 $page = 1; 
 }else{
 $page=$pageid;
}
 if(!isset($defUrl)){$defUrl="";}
 $thisPageCount = $thisPageCount; 
 $allCount = $allCount;
 $pages = ceil($allCount/$thisPageCount); 
 $max_p=$pages;
 $page_len=$page_len; 
 $page_len = ($page_len%2)?$page_len:$page_len+1;
 $pageoffset = ($page_len-1)/2;
 $listPageHtml='<!--page start-->';
 if($page!=1){
 $listPageHtml.='<li class="disabled"><a href="?'.$defUrl.'page=1">首页</a></li>';
 $listPageHtml.='<li class="disabled"><a href="?'.$defUrl.'page='.($page-1).'">上一页</a></li>';
}else {
 $listPageHtml.='<li class="disabled"><a href="?'.$defUrl.'page='.$page.'">首页</a></li>';
 $listPageHtml.=" "; 
}
 $init=1;
 if($pages>$page_len){
 if($page<=$pageoffset){
 $init=1;
 $max_p = $page_len;
 }else{
 if($page+$pageoffset>=$pages+1){
 $init = $pages-$page_len+1;
 }else{
 $init = $page-$pageoffset;
 $max_p = $page+$pageoffset;
 }
 }
 }
 for($i=$init;$i<=$max_p;$i++){
 if($i==$page){
 $listPageHtml.='<li class="active"><span>'.$i.'</span></li>';
 } else {
 $listPageHtml.='<li class="disabled"><a href="?'.$defUrl.'page='.$i.'">'.$i.'</a></li>';
 }
 }

 if($page!=$pages){
 $listPageHtml.='<li class="disabled"><a href="?'.$defUrl.'page='.($page+1).'">下一页</a></li>';
 $listPageHtml.='<li class="disabled"><a href="?'.$defUrl.'page='.$pages.'">末页</a></li>';
 }else {
 $listPageHtml.='<li class="disabled"><a href="?'.$defUrl.'page='.$pages.'">末页</a></li>';
 }
 $listPageHtml.='<!--page end-->';
?>