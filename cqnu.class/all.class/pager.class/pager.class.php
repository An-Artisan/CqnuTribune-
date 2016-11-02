<?php    
//=====单例模式结束=====
/* * *********************************************
 * @类名:     Pager
 * @参数:       
              private $pageSize = 10;  
              private $pageIndex;    
              private $totalNum;    
              private $totalPagesCount;    
              private $pageUrl;    
              private static $_instance;    
 * @方法      GetPagerContent()-进行分页
              
 * @功能:     记录分页
 * @作者:     不敢为天下
*/
class Pager {    
    private $pageSize = 10;    
    private $pageIndex;    
    private $totalNum;    

    private $totalPagesCount;    

    private $pageUrl;    
    private static $_instance;    

    public function __construct($p_totalNum, $p_pageIndex, $p_pageSize = 10,$p_initNum=3,$p_initMaxNum=5) {    
        if (! isset ( $p_totalNum ) || !isset($p_pageIndex)) {    
            die ( "pager initial error" );    
        }    

        $this->totalNum = $p_totalNum;    
        $this->pageIndex = $p_pageIndex;    
        $this->pageSize = $p_pageSize;    
        $this->initNum=$p_initNum;    
        $this->initMaxNum=$p_initMaxNum;    
        $this->totalPagesCount= ceil($p_totalNum / $p_pageSize);    
        $this->pageUrl=$this->_getPageUrl();    

         $this->_initPagerLegal();    
    }    

        
  /**   
    * 获取去除page部分的当前URL字符串   
    *   
    * @return String URL字符串   
    */   
  private function _getPageUrl() {    
        $CurrentUrl = $_SERVER["REQUEST_URI"];    
        $arrUrl     = parse_url($CurrentUrl);    
        @$urlQuery   = $arrUrl["query"];    

        if($urlQuery){    
            $urlQuery  = ereg_replace("(^|&)page=" . $this->pageIndex, "", $urlQuery);    
            @$CurrentUrl = str_replace($arrUrl["query"], $urlQuery, $CurrentUrl);    

            if($urlQuery){    
                 $CurrentUrl.="&page";    
            }    
            else $CurrentUrl.="page";    

        } else {    
            $CurrentUrl.="?page";    
        }    

    return $CurrentUrl;    

  }    
  /*   
   *设置页面参数合法性   
   *@return void   
  */   
  private function _initPagerLegal()    
  {    
      if((!is_numeric($this->pageIndex)) ||  $this->pageIndex<1)    
      {    
          $this->pageIndex=1;    
      }elseif($this->pageIndex > $this->totalPagesCount)    
      {    
          $this->pageIndex=$this->totalPagesCount;    
      }    

          

  }    
//$this->pageUrl}={$i}    
//{$this->CurrentUrl}={$this->TotalPages}    
    public function GetPagerContent() {    
        // $str = "<div class=\"Pagination\">";    
        $str=null; 
        //首页 上一页   
        if($this->pageIndex==1)    
        {    
            $str .="<li><a href='javascript:void(0)' class='tips' title='首页'>首页</a></li> "."\n";    
            $str .="<li><a href='javascript:void(0)' class='tips' title='上一页'>上一页</a></li> "."\n"."\n";    
        }else   
        {    
            $str .="<li><a href='{$this->pageUrl}=1' class='tips' title='首页'>首页</a></li> "."\n";  
                    $str .="<li><a href='{$this->pageUrl}=".($this->pageIndex-1)."' class='tips' title='上一页'>上一页</a><li> "."\n"."\n";    
        }    

            

        /*   

        除首末后 页面分页逻辑   

        */   
         //10页（含）以下    
         $currnt="";    
         if($this->totalPagesCount<=10)    
         {    

            for($i=1;$i<=$this->totalPagesCount;$i++)    

            {    
                       if($i==$this->pageIndex)    
                       {    $currnt=" class='current'";}    
                       else   
                       {    $currnt="";    }    
                        $str .="<li><a href='{$this->pageUrl}={$i} ' {$currnt}>$i</a></li>"."\n" ;    
            }    
         }else                                //10页以上    
         {   if($this->pageIndex<3)  //当前页小于3    
             {    
                     for($i=1;$i<=3;$i++)    
                     {    
                         if($i==$this->pageIndex)    
                           {    $currnt=" class='current'";}    
                         else   
                         {    $currnt="";    }    
                        $str .="<li><a href='{$this->pageUrl}={$i} ' {$currnt}>$i</a></li>"."\n" ;    
                     }    

                     $str.="<span class=\"dot\">……</span>"."\n";    

                 for($i=$this->totalPagesCount-3+1;$i<=$this->totalPagesCount;$i++)//功能1    
                 {    
                      $str .="<li><a href='{$this->pageUrl}={$i}' >$i</a></li>"."\n" ;    

                 }    
             }elseif($this->pageIndex<=5)   //   5 >= 当前页 >= 3    
             {    
                 for($i=1;$i<=($this->pageIndex+1);$i++)    
                 {    
                      if($i==$this->pageIndex)    
                       {    $currnt=" class='current'";}    
                       else   
                       {    $currnt="";    }    
                        $str .="<li><a href='{$this->pageUrl}={$i} ' {$currnt}>$i</a></li>"."\n" ;    

                 }    
                 $str.="<span class=\"dot\">……</span>"."\n";    

                 for($i=$this->totalPagesCount-3+1;$i<=$this->totalPagesCount;$i++)//功能1    
                 {    
                      $str .="<li><a href='{$this->pageUrl}={$i}' >$i</a></li>"."\n" ;    

                 }    

             }elseif(5<$this->pageIndex  &&  $this->pageIndex<=$this->totalPagesCount-5 )             //当前页大于5，同时小于总页数-5    

             {    

                 for($i=1;$i<=3;$i++)    
                 {    
                     $str .="<li><a href='{$this->pageUrl}={$i}' >$i</a></li>"."\n" ;    
                 }    
                  $str.="<span class=\"dot\">……</span>";                 
                 for($i=$this->pageIndex-1 ;$i<=$this->pageIndex+1 && $i<=$this->totalPagesCount-5+1;$i++)    
                 {    
                       if($i==$this->pageIndex)    
                       {    $currnt=" class='current'";}    
                       else   
                       {    $currnt="";    }    
                        $str .="<li><a href='{$this->pageUrl}={$i} ' {$currnt}>$i</a></li>"."\n" ;    
                 }    
                 $str.="<span class=\"dot\">……</span>";    

                 for($i=$this->totalPagesCount-3+1;$i<=$this->totalPagesCount;$i++)    
                 {    
                      $str .="<li><a href='{$this->pageUrl}={$i}' >$i</a><li>"."\n" ;    

                 }    
             }else   
             {    

                  for($i=1;$i<=3;$i++)    
                 {    
                     $str .="<li><a href='{$this->pageUrl}={$i}' >$i</a></li>"."\n" ;    
                 }    
                  $str.="<span class=\"dot\">……</span>"."\n";    

                  for($i=$this->totalPagesCount-5;$i<=$this->totalPagesCount;$i++)//功能1    
                 {    
                       if($i==$this->pageIndex)    
                       {    $currnt=" class='current'";}    
                       else   
                       {    $currnt="";    }    
                        $str .="<li><a href='{$this->pageUrl}={$i} ' {$currnt}>$i</a></li>"."\n" ;    

                 }    
            }           

         }    

             

             
        /*   

        除首末后 页面分页逻辑结束   

        */   

        //下一页 末页    
        if($this->pageIndex==$this->totalPagesCount)    
        {       
            $str .="\n"."<li><a href='javascript:void(0)' class='tips' title='下一页'>下一页</a></li>"."\n" ;    
            $str .="<li><a href='javascript:void(0)' class='tips' title='末页'>末页</a></li>"."\n";    
            $str .="<li><a href='' class='tips' title='末页'>当前第$this->pageIndex 页</a></li>"."\n"; 
                
        }else   
        {    
            $str .="\n"."<li><a href='{$this->pageUrl}=".($this->pageIndex+1)."' class='tips' title='下一页'>下一页</a></li> "."\n";    
            $str .="<li><a href='{$this->pageUrl}={$this->totalPagesCount}' class='tips' title='末页'>末页</a></li> "."\n" ;
            $str.= "<li><a  href='' class='tips' title='末页'>第$this->pageIndex 页</a></li> "."\n" ;  
        }           

        $str .= "</div>";    
        return $str;    
    }    

   

   
   
}    
?>  