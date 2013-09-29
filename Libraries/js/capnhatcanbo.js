function find_bm() //ham lay thong tin bo mon
    {
        
    khoa = document.getElementById('cbokhoa').value;
    if(khoa==" ") { 
        document.getElementById('cbobomon').innerHTML='<select name="cbobomon" id="cbobm"><option value=""></option></select>';
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
function find_hoten() //ham lay thong tin ten cua can bo bang ma so
    {        
    khoa = document.getElementById('cbokhoa').value;
    bomon = document.getElementById('cbobm').value;
    maso = document.getElementById('txtmaso').value;
    if(khoa=='' || bomon=='') return false;
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
         document.getElementById('txthoten').value =xmlhttp.responseText;
        // alert(xmlhttp.responseText);    	   
         xmlhttp = null;          
           
        }
      }
     xmlhttp.open("GET","ajax.php?khoa="+khoa+"&bomon="+bomon+"&maso="+maso+"&q="+Math.random(),true);
     xmlhttp.send();
    
    return false;
    }    