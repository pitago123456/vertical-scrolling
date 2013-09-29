
function find_bm() //ham lay thong tin ten cua can bo bang ma so
    {
        
    khoa = document.getElementById('cbokhoa').value;
    if(khoa==" ") { 
        document.getElementById('cbobomon').innerHTML='<select name="cbobomon" id="cbobm"><option value="">Tất cả</option></select>';
        return false;
        }
    var xmlhttp;
    if (window.XMLHttpRequest)
      { //code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      { //code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
         if(xmlhttp.responseText==''){
            alert('Lỗi');
         }
         else{             
                document.getElementById('cbobomon').innerHTML =xmlhttp.responseText;
    	   }
           xmlhttp = null;          
           
        }
      }
     xmlhttp.open("GET","ajax.php?khoa="+khoa+"&q="+Math.random(),true);
     xmlhttp.send();
    
    return false;
    } 
 
function getsach(khoa,bm,ncb) //ham lay thong tin
    {
    document.getElementById("result").innerHTML = "<div class='load'></div>";
    send = '';
    if(khoa!='')send+='&khoa='+khoa; 
    if(bm!='')  send+='&bm='+bm;
    if(ncb!='')  send+='&ncb='+ncb;
     
     
     var xmlhttp;
    if (window.XMLHttpRequest)
      { //code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      { //code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
         document.getElementById("result").innerHTML =xmlhttp.responseText;
         xmlhttp = null;                        
        }
      }
      
     xmlhttp.open("GET","Controls/AjaxBCsach.php?"+send+"&gr=QL&q="+Math.random(),true);
     xmlhttp.send();
    
    return false;
       
    }
    
function opnwd(url, height, width, isScrollbar ) {
		popupWin = window.open(url,'new_page','toolbar=no,location=no,menubar=no,scrollbars='+isScrollbar+',width='+width+',height='+height+',top=2,left=2,resizeable=yes,status=no');
	}
	
	function opnwdFull(url ) {
		//meHeight = screen.height - 180;
		meHeight = screen.height - 85;
		meWidth = screen.width - 12;
		window.open(url, 'new_window', 'toolbar=no, location=no, menubar=no, scrollbars=yes, width='+meWidth+', height='+meHeight+', top=0, left=0, resizable=yes, status=yes ' ,'' );
	}
	
	function opnwd_print(url, height, width, isScrollbar ) {
		popupWin = window.open(url,'new_page','toolbar=no,location=no,menubar=yes,scrollbars='+isScrollbar+',width='+width+',height='+height+',top=2,left=2,resizeable=yes,status=no');
	}
function test()
{
    alert('adsadasda');
    return false;
}