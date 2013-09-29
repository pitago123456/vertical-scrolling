//danh cho menu-------------------------------------------------------------------------------------------------
function nav_llsl()
{
                if($('div#quatrinhdaotao').hasClass('editif-highline'))
                {
                    $('div#inschool').hide('fast');
                    $('div#quatrinhdaotao').removeClass('editif-highline');
                }
                if($('div#congtacchuyenmon').hasClass('editif-highline'))
                {
                    $('div#inwork').hide('fast');
                    $('div#congtacchuyenmon').removeClass('editif-highline');
                }
                if($('div#nghiencuukhoahoc').hasClass('editif-highline'))
                {
                    $('div#insci').hide('fast');
                    $('div#nghiencuukhoahoc').removeClass('editif-highline');
                } 
                if(!$('div#lylichsoluoc').hasClass('editif-highline'))
                {  
                $('div.bgedit#peinfo').slideToggle('slow');
                $('div#lylichsoluoc').toggleClass("editif-highline"); 
                } 
}
function nav_qtdt()
{
                if($('div#lylichsoluoc').hasClass('editif-highline'))
                {
                    $('div.bgedit#peinfo').hide('fast');
                    $('div#lylichsoluoc').removeClass('editif-highline');
                }
                if($('div#congtacchuyenmon').hasClass('editif-highline'))
                {
                    $('div#inwork').hide('fast');
                    $('div#congtacchuyenmon').removeClass('editif-highline');
                }
                if($('div#nghiencuukhoahoc').hasClass('editif-highline'))
                {
                    $('div#insci').hide('fast');
                    $('div#nghiencuukhoahoc').removeClass('editif-highline');
                } 
                if(!$('div#quatrinhdaotao').hasClass('editif-highline'))
                {  
                $('div.bgedit#inschool').slideToggle('slow');
                $('div#quatrinhdaotao').toggleClass("editif-highline"); 
                } 
}
function nav_ctcm()
{
                if($('div#lylichsoluoc').hasClass('editif-highline'))
                {
                    $('div.bgedit#peinfo').hide('fast');
                    $('div#lylichsoluoc').removeClass('editif-highline');
                }
                if($('div#quatrinhdaotao').hasClass('editif-highline'))
                {
                    $('div.bgedit#inschool').hide('fast');
                    $('div#quatrinhdaotao').removeClass('editif-highline');
                }
                if($('div#nghiencuukhoahoc').hasClass('editif-highline'))
                {
                    $('div#insci').hide('fast');
                    $('div#nghiencuukhoahoc').removeClass('editif-highline');
                } 
                if(!$('div#congtacchuyenmon').hasClass('editif-highline'))
                {  
                $('div.bgedit#inwork').slideToggle('slow');
                $('div#congtacchuyenmon').toggleClass("editif-highline"); 
                } 
}
function nav_nckh()
{
                if($('div#lylichsoluoc').hasClass('editif-highline'))
                {
                    $('div.bgedit#peinfo').hide('fast');
                    $('div#lylichsoluoc').removeClass('editif-highline');
                }
                if($('div#quatrinhdaotao').hasClass('editif-highline'))
                {
                    $('div.bgedit#inschool').hide('fast');
                    $('div#quatrinhdaotao').removeClass('editif-highline');
                }
                if($('div#congtacchuyenmon').hasClass('editif-highline'))
                {
                    $('div#inwork').hide('fast');
                    $('div#congtacchuyenmon').removeClass('editif-highline');
                }
                if(!$('div#nghiencuukhoahoc').hasClass('editif-highline'))
                {  
                $('div.bgedit#insci').slideToggle('slow');
                $('div#nghiencuukhoahoc').toggleClass("editif-highline"); 
                } 
}
//bang cap----------------------------
function add_bc()
    {
    cnt = document.getElementById('cnt_bc').value++;
    cnt++;
    var btn=document.createElement("div");
    btn.setAttribute('id','bc'+cnt);
    document.getElementById("if_add_bc").appendChild(btn);
    document.getElementById("bc"+cnt).innerHTML =  '<input type="hidden" name="an_bc'+cnt+'" id="an_bc'+cnt+'" value="ok" /><div class="row mini_line"></div><div class="row"><span class="bcl">Loại Bằng:</span><span class="bcr"><select id="BC_LB" name="BC_LB'+cnt+'" class="select"><option value="LBC01" >Đại Học </option><option value="LBC02">Thạc Sĩ</option><option value="LBC03">Tiến Sĩ</option></select></span></div><div class="row"><span class="bcl">Hệ Đào Tạo:</span><span class="bcr"><select id="BC_HDT'+cnt+'" name="BC_HDT'+cnt+'" class="select"><option value="Chính Quy" >Chính Quy </option><option value="Không Chính Quy" >Không Chính Quy</option><option value="Từ xa" >Từ xa</option></select></span></div></div><div class="row"><span class="bcl">Nơi Đào Tạo:</span><span class="bcr"><input type="text" name="BC_NDT'+cnt+'" id="BC_NDT'+cnt+'" value="" size="60" maxlength="60"   class="input"/></span></div><div class="row"><span class="bcl">Ngành Học:</span><span class="bcr"><input type="text" class="a_nganhhoc" name="BC_NH'+cnt+'" id="BC_NH'+cnt+'" value="" size="60" maxlength="60" /></span></div></div><div class="row"><span class="bcl">Chuyên Ngành:</span><span class="bcr"><input type="text" class="a_chuyennganh" name="BC_CN'+cnt+'" id="BC_CN'+cnt+'" value="" size="60" maxlength="60" /></span></div><div class="row"><span class="bcl">Nước Đào Tạo:</span><span class="bcr"><input type="text" class="a_nuocdaotao" name="BC_NcDT'+cnt+'" id="BC_NcDT'+cnt+'" value="" size="30" maxlength="40" /></span></div></div><div class="row"><span class="bcl">Tên Luận Án:</span><span class="bcr"><input type="text" name="BC_TDT'+cnt+'" id="BC_TDT'+cnt+'" value="" size="60"  /></span></div><div class="row"><span class="bcl">Năm Hoàn Thành:</span><span class="bcr"><input type="text" name="BC_NHT'+cnt+'" id="BC_NHT'+cnt+'" value="" size="4" maxlength="4"/></span></div><div class="btn_remove"><button onclick="return remove_bc2('+cnt+');">Xóa Bằng Này</button></div></div>';  
    $(function() {
     // Handler for .ready() called.
     $( ".a_nganhhoc" ).autocomplete({source: "auto/NganhHoc.php",minLength: 2});
     $( ".a_chuyennganh" ).autocomplete({source: "auto/ChuyenNganh.php",minLength: 2});
     $( ".a_nuocdaotao" ).autocomplete({source: "auto/NuocDaoTao.php",minLength: 2});
    });
    return false;   
    }
function remove_bc(id)
    {   get_hstt = document.getElementById("stt_bc"+id).value;
        if(get_hstt!=''){
        document.getElementById("bc"+id).innerHTML = '<input type="hidden" name="rem_bc'+id+'" value="'+get_hstt+'" />';
        }
         else 
         document.getElementById("bc"+id).innerHTML = '';   
         return false;   
    }
function remove_bc2(id)
    {   get_hstt = document.getElementById("an_bc"+id).value;
        if(get_hstt!=''){
        document.getElementById("bc"+id).innerHTML = '';   
        return false;   
        }
    }
//ngoai ngu----------------------------
function add_nn()
    {
    cnt = document.getElementById('cnt_nn').value++;
    cnt++;
    var btn=document.createElement("div");
    btn.setAttribute('id','nn'+cnt);
    document.getElementById("if_add_nn").appendChild(btn);
    document.getElementById("nn"+cnt).innerHTML =  '<input type="hidden" name="an_nn'+cnt+'" id="an_nn'+cnt+'" value="ok" /><div class="row mini_line"></div><div class="row"><span class="bcl">Loại Ngoại Ngữ:</span><span class="bcr"><select id="NN_kind'+cnt+'" name="NN_kind'+cnt+'" class="select"><option value="L01" >Anh Văn </option><option value="L02" >Pháp Văn</option><option value="L03" >Nga Văn</option><option value="L04" >Đức Văn</option><option value="L05" >Nhật Văn</option></select></span></div><div class="row"><span class="bcl">Mức Độ Sử Dụng:</span><span class="bcr"><select id="NN_MD'+cnt+'" name="NN_MD'+cnt+'" class="select"><option value="A" >A </option><option value="B" >B</option><option value="C" >C</option><option value="D" >D</option></select></span></div><div class="btn_remove"><button onclick="return remove_nn2('+cnt+');">Xóa Bằng Này</button></div></div>';  
    
     return false;   
    }
function remove_nn(id)
    {
        get_hstt = document.getElementById("stt_nn"+id).value;
        if(get_hstt!=''){
        document.getElementById("nn"+id).innerHTML = '<input type="hidden" name="rem_nn'+id+'" value="'+get_hstt+'" />';
        }
        else 
        document.getElementById("nn"+id).innerHTML = '';
        return false;  
    }
function remove_nn2(id)
    {
        get_hstt = document.getElementById("an_nn"+id).value;
        if(get_hstt!='') document.getElementById("nn"+id).innerHTML = '';
        return false;  
    }
//cong tac----------------------------
function add_ct()
    {
    cnt = document.getElementById('cnt_ct').value++;
    cnt++;
    var btn=document.createElement("div");
    btn.setAttribute('id','ct'+cnt);
    document.getElementById("if_add_ct").appendChild(btn);
    document.getElementById("ct"+cnt).innerHTML =  '<input type="hidden" name="an_ct'+cnt+'" id="an_ct'+cnt+'" value="ok" /><div class="row mini_line"></div><div class="row"><span class="bcl">Ngày Bắt Đầu:</span><span class="bcr"><input name="w_nbd'+cnt+'" id="w_nbd'+cnt+'" type="text" class="popupDatepicker" size="12" maxlength="12" readonly="true" value="" /></span></div><div class="row"><span class="bcl">Ngày Kết Thúc:</span><span class="bcr"><input name="w_nkt'+cnt+'" id="w_nkt'+cnt+'" type="text" class="popupDatepicker" size="12" maxlength="12" readonly="true" value="" /></span></div><div class="row"><span class="bcl">Nơi Công Tác:</span><span class="bcr"><textarea class="a_noicongtac" name="w_nct'+cnt+'" id="w_nct'+cnt+'" cols="85" rows="1" ></textarea></span></div><div class="row"><span class="bcl">Công Việc Đảm Nhận:</span><span class="bcr"><textarea class="a_congviecdn" name="w_cvdn'+cnt+'" id="w_cvdn'+cnt+'"  cols="85" rows="1" ></textarea></span><div class="btn_remove"><button onclick="return remove_ct2('+cnt+');">Xóa Quá Trình Này</button></div></div>';  
    
    $(function() {
     // Handler for .ready() called.
     $('.popupDatepicker').datepick({dateFormat: 'dd-mm-yyyy'});
     $( ".a_noicongtac" ).autocomplete({source: "auto/NoiCongTac.php",minLength: 2});
     $( ".a_congviecdn" ).autocomplete({source: "auto/CongViecDamNhan.php",minLength: 2}); 
      
    });
     return false;   
    }
function remove_ct(id)
    {
        get_hstt = document.getElementById("stt_ct"+id).value;
        if(get_hstt!='') document.getElementById("ct"+id).innerHTML = '<input type="hidden" name="rem_ct'+id+'" value="'+get_hstt+'" />';
        else  document.getElementById("ct"+id).innerHTML = '';
        return false;  
    }
function remove_ct2(id)
    {
        get_hstt = document.getElementById("an_ct"+id).value;
        if(get_hstt!='') document.getElementById("ct"+id).innerHTML = '';
        return false;
    }
//nghien cuu----------------------------
function add_nc()
    {
        cnt = document.getElementById('cnt_nc').value++;
        cnt++;
        var btn=document.createElement("div");
        btn.setAttribute('id','nc'+cnt);
        document.getElementById("if_add_nc").appendChild(btn);
        document.getElementById("nc"+cnt).innerHTML ='<input type="hidden" name="an_nc'+cnt+'" id="an_nc'+cnt+'" value="ok"/><div class="row mini_line"></div><div class="row"><span class="bcl">Cấp Đề Tài:</span><span class="bcr"><select id="CDT_Ma'+cnt+'" name="CDT_Ma'+cnt+'"><option value="CDT01">Nhà Nước </option><option value="CDT02">Bộ</option><option value="CDT03">Trường</option></select></span></div><div class="row"><span class="bcl">Tên Đề Tài:</span><span class="bcr"><textarea class="a_ncten" name="NC_Ten'+cnt+'" id="NC_Ten'+cnt+'" cols="80" rows="2"></textarea></span></div><div class="row"><span class="bcl">Năm Bắt Đầu:</span><span class="bcr"><input name="NC_NamBD'+cnt+'" id="NC_NamBD'+cnt+'" value="" type="text" size="4" maxlength="4"/></span></div><div class="row"><span class="bcl">Năm Hoàn Thành:</span><span class="bcr"><input name="NC_NamHT'+cnt+'" id="NC_NamHT'+cnt+'" value="" type="text" size="4" maxlength="4"/></span></div><div class="row"><span class="bcl">Đồng Tham Gia:</span><input type="hidden" name="1cnt_dtg'+cnt+'" id="1cnt_dtg'+cnt+'" value="0"/></div><div id="setname'+cnt+'"></div><div class="row2"><span class="bcr"><input type="text" class="a_getid" onmousemove="sci_DTG_on('+cnt+')" onmouseout="sci_DTG_out('+cnt+')" name="NC_GN" id="1get_name'+cnt+'" placeholder="Nhập mã số" value="" size="10" maxlength="10"/></span><span class="bcr"><button onclick="return getname(document.getElementById(\'1get_name'+cnt+'\').value,'+cnt+')">Thêm</button></span></div><div class="sci_hint" id="sci_hint_DTG'+cnt+'"></div><div class="btn_remove"><button onclick="return remove_nc2('+cnt+');">Xóa Đề Tài Này</button></div>';  
        $(function() {
        // Handler for .ready() called.
        $( ".a_ncten" ).autocomplete({source: "auto/TenNghienCuu.php",minLength: 2});
        $( ".a_getid" ).autocomplete({source: "auto/GetID.php",minLength: 2});
        });
        return false;   
    }
function remove_nc(id)
    {
        get_hstt = document.getElementById("stt_nc"+id).value;
        document.getElementById("nc"+id).innerHTML = '<input type="hidden" name="rem_nc'+id+'" value="'+get_hstt+'" />';
        return false;  
    }
function remove_nc2(id)
    {
        get_hstt = document.getElementById("an_nc"+id).value;
        document.getElementById("nc"+id).innerHTML = '';        
        return false;  
    }     
function rem1dtg(s,id)
    {        
    document.getElementById("1DTG"+s+id).innerHTML = '<input type="hidden" name="rem_1dtg'+s+'" value="'+id+'" />';        
    return false;  
    }
function rem1dtg2(tag)
    {     
    document.getElementById(tag).innerHTML = '';        
    return false;  
    }
//sach giao trinh----------------------------
function add_bk()
    {
        cnt = document.getElementById('cnt_book').value++;
        cnt++;
        var btn=document.createElement("div");
        btn.setAttribute('id','bk'+cnt);
        document.getElementById("if_add_bk").appendChild(btn);
        document.getElementById("bk"+cnt).innerHTML ='<input type="hidden" name="an_bk'+cnt+'" id="an_bk'+cnt+'" value="ok"/><div id="bk'+cnt+'"><div class="row mini_line"></div><div class="row"><span class="bcl">Tên Sách:</span><span class="bcr"><textarea class="a_sgtsach" name="SGT_Ten'+cnt+'" id="SGT_Ten'+cnt+'"  cols="82" rows="2" ></textarea></span></div><div class="row"><span class="bcl">Nhà Xuất Bản:</span><span class="bcr"><input type="text" class="a_sgtnxb" name="SGT_NXB'+cnt+'" id="SGT_NXB'+cnt+'" value="" size="80" maxlength="80"  /></span></div><div class="row"><span class="bcl">Năm Xuất Bản:</span><span class="bcr"><input type="text" name="SGT_NamXB'+cnt+'" id="SGT_NamXB'+cnt+'" value="" size="4" maxlength="4"/></span></div><div class="row"><span class="bcl">Đồng Tác Giả:</span><input type="hidden" name="2cnt_dtg'+cnt+'" id="2cnt_dtg'+cnt+'"  value="0" /><input type="hidden" name="22cnt_dtg'+cnt+'" id="22cnt_dtg'+cnt+'"  value="0" /></div><div id="2setname'+cnt+'"></div><div class="row2"><span class="bcr"><input type="text" class="a_getid" onmousemove="sci_DTG2_on('+cnt+')" onmouseout="sci_DTG2_out('+cnt+')" id="2get_name'+cnt+'" name="BK_DTG'+cnt+'" placeholder="Nhập mã số" value="" size="10" maxlength="10" /><input type="text" class="a_getname" onmousemove="sci_DTG2_on('+cnt+')" onmouseout="sci_DTG2_out('+cnt+')" id="22get_name'+cnt+'" name="BK2_DTG'+cnt+'" placeholder="Nhập họ tên" value="" size="30" maxlength="40"  /></span><span class="bcr"><button onclick="return getname2(document.getElementById(\'2get_name'+cnt+'\').value,document.getElementById(\'22get_name'+cnt+'\').value,'+cnt+')">Thêm</button></span></div><div class="sci_hint" id="sci_hint_DTG2'+cnt+'"></div><div class="btn_remove"><button onclick="return remove_bk2('+cnt+');">Xóa Cuốn sách Này</button></div></div>';  
        $(function() {
        // Handler for .ready() called.
       $( ".a_sgtsach" ).autocomplete({source: "auto/TenSach.php",minLength: 2}); 
       $( ".a_sgtnxb" ).autocomplete({source: "auto/NXBSach.php",minLength: 2});
       $( ".a_getid" ).autocomplete({source: "auto/GetID.php",minLength: 2});
         $( ".a_getname" ).autocomplete({source: "auto/GetName.php",minLength: 2});
        $( ".a_getname2" ).autocomplete({source: "auto/GetName2.php",minLength: 2});  
       });
        return false;   
    }
function remove_bk(id)
    {
        get_hstt = document.getElementById("stt_bk"+id).value;
        document.getElementById("bk"+id).innerHTML = '<input type="hidden" name="rem_bk'+id+'" value="'+get_hstt+'" />';
        return false;  
    }
function remove_bk2(id)
    {
        get_hstt = document.getElementById("an_bk"+id).value;
        document.getElementById("bk"+id).innerHTML = '';        
        return false;  
    }
function rem2dtg(s,id)
    {   
    document.getElementById("2DTG"+s+id).innerHTML = '<input type="hidden" name="rem_2dtg'+s+'" value="'+id+'" />';        
    return false;  
    }
function rem22dtg(s,id)
    {        
    document.getElementById("22DTG"+s+id).innerHTML = '<input type="hidden" name="rem_22dtg'+s+'" value="'+id+'" />';        
    return false;  
    }
function rem2dtg2(tag)
    {     
    document.getElementById(tag).innerHTML = '';        
    return false;  
    }
function rem22dtg2(tag)
    {     
    document.getElementById(tag).innerHTML = '';        
    return false;  
    }
//cong trinh khoa hoc----------------------------
function add_kh()
    {
        cnt = document.getElementById('cnt_kh').value++;
        cnt++;
        var btn=document.createElement("div");
        btn.setAttribute('id','kh'+cnt);
        document.getElementById("if_add_kh").appendChild(btn);
        document.getElementById("kh"+cnt).innerHTML ='<input type="hidden" name="an_kh'+cnt+'" id="an_kh'+cnt+'" value="ok"/><div id="kh'+cnt+'"><div class="row mini_line"></div><div class="row"><span class="bcl">Tên Công Trình:</span><span class="bcr"><textarea class="a_khten" name="KH_Ten'+cnt+'" id="KH_Ten'+cnt+'"  cols="82" rows="2" ></textarea></span></div><div class="row"><span class="bcl">Tên Tạp Chí:</span><span class="bcr"><textarea class="a_khttchi" name="KH_TenTapChi'+cnt+'" id="KH_TenTapChi'+cnt+'"  cols="82" rows="1" ></textarea></span></div><div class="row"><span class="bcl">Số Tạp Chí:</span><span class="bcr"><input type="text" name="KH_SoTapChi'+cnt+'" id="KH_SoTapChi'+cnt+'" value="" size="10" maxlength="10" /></span></div><div class="row"><span class="bcl">Trang Số:</span><span class="bcr"><input type="text" name="KH_Trang'+cnt+'" id="KH_Trang'+cnt+'" value=""  size="10" maxlength="10"/></span></div><div class="row"><span class="bcl">Nhà Xuất Bản:</span><span class="bcr"><input type="text" class="a_khnxb" name="KH_NXB'+cnt+'" id="KH_NXB'+cnt+'" value="" size="80" maxlength="80"  /></span></div><div class="row"><span class="bcl">Năm Công Bố:</span><span class="bcr"><input type="text"  name="KH_NamCongBo'+cnt+'" id="KH_NamCongBo'+cnt+'" value="" size="4" maxlength="4"/></span></div><div class="row"><span class="bcl">Đồng Tác Giả:</span><input type="hidden" name="3cnt_dtg'+cnt+'" id="3cnt_dtg'+cnt+'"  value="0" /><input type="hidden" name="33cnt_dtg'+cnt+'" id="33cnt_dtg'+cnt+'"  value="0" /></div><div id="3setname'+cnt+'"></div><div class="row2"><span class="bcr"><input type="text" class="a_getid" onmousemove="sci_DTG3_on('+cnt+')" onmouseout="sci_DTG3_out('+cnt+')" id="3get_name'+cnt+'" name="KH_DTG'+cnt+'" placeholder="Nhập mã số" value="" size="10" maxlength="10" /><input type="text" class="a_getname2" onmousemove="sci_DTG3_on('+cnt+')" onmouseout="sci_DTG3_out('+cnt+')" id="33get_name'+cnt+'" name="KH_2DTG'+cnt+'" placeholder="Nhập họ tên" value="" size="30" maxlength="40"  /></span><span class="bcr"><button onclick="return getname3(document.getElementById(\'3get_name'+cnt+'\').value,document.getElementById(\'33get_name'+cnt+'\').value,'+cnt+')">Thêm</button></span></div><div class="sci_hint" id="sci_hint_DTG3'+cnt+'"></div><div class="btn_remove"><button onclick="return remove_kh2('+cnt+');">Xóa Công Trình Này</button></div></div>';  
        $(function() {
        // Handler for .ready() called.
            $( ".a_khten" ).autocomplete({source: "auto/TenKhoaHoc.php",minLength: 2}); 
            $( ".a_khttchi" ).autocomplete({source: "auto/TenTapChi.php",minLength: 2}); 
            $( ".a_khnxb" ).autocomplete({source: "auto/NXBKhoaHoc.php",minLength: 2}); 
            $( ".a_getid" ).autocomplete({source: "auto/GetID.php",minLength: 2});
         $( ".a_getname" ).autocomplete({source: "auto/GetName.php",minLength: 2});
        $( ".a_getname2" ).autocomplete({source: "auto/GetName2.php",minLength: 2});  
      
        });
        return false;   
    }
function remove_kh(id)
    {
        get_hstt = document.getElementById("stt_kh"+id).value;
        document.getElementById("kh"+id).innerHTML = '<input type="hidden" name="rem_kh'+id+'" value="'+get_hstt+'" />';
        return false;  
    }
function remove_kh2(id)
    {
        get_hstt = document.getElementById("an_kh"+id).value;
        document.getElementById("kh"+id).innerHTML = '';        
        return false;  
    }
function rem3dtg(s,id)
    {   
    document.getElementById("3DTG"+s+id).innerHTML = '<input type="hidden" name="rem_3dtg'+s+'" value="'+id+'" />';        
    return false;  
    }
function rem33dtg(s,id)
    {        
    document.getElementById("33DTG"+s+id).innerHTML = '<input type="hidden" name="rem_33dtg'+s+'" value="'+id+'" />';        
    return false;  
    }
function rem3dtg2(tag)
    {     
    document.getElementById(tag).innerHTML = '';        
    return false;  
    }
function rem33dtg2(tag)
    {     
    document.getElementById(tag).innerHTML = '';        
    return false;  
    }

//code hint---------------------------------------------------------------------------
function sci_DTG_on(id)
    {
    	document.getElementById("sci_hint_DTG"+id).innerHTML= "Nhập mã số để thêm cán bộ trong trường";
    }
function sci_DTG_out(id)
    {
    	document.getElementById("sci_hint_DTG"+id).innerHTML= "";
    }
function sci_DTG2_on(id)
    {
    	document.getElementById("sci_hint_DTG2"+id).innerHTML= "Nhập mã số để thêm cán bộ trong trường,nhập tên nếu không phải cán bộ trong trường";
    }
function sci_DTG2_out(id)
    {
    	document.getElementById("sci_hint_DTG2"+id).innerHTML= "";
    }
function sci_DTG3_on(id)
    {
    	document.getElementById("sci_hint_DTG3"+id).innerHTML= "Nhập mã số để thêm cán bộ trong trường,nhập tên nếu không phải cán bộ trong trường";
    }
function sci_DTG3_out(id)
    {
    	document.getElementById("sci_hint_DTG3"+id).innerHTML= "";
    }

/**------------------------Ajax--------------------------------------------------------------------------------------*/

function getname(id,s) //ham lay thong tin ten cua can bo bang ma so
    {
        
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
         if(xmlhttp.responseText=='0'){
            alert('Không tồn tại cán bộ có mã số '+id);
         }
         else{ 
            
        cnt=document.getElementById("1cnt_dtg"+s).value++; cnt++;
        var btn=document.createElement("div");
        btn.setAttribute('id','1an'+s+cnt);
        document.getElementById("setname"+s).appendChild(btn);
        document.getElementById("1an"+s+cnt).innerHTML ='<input type="hidden" name="1andtg'+s+cnt+'"  value="'+id+'" /><div class="row2"><span class="ccr">Mã số :'+id+'</span><span class="ccr"> | Họ Tên: '+xmlhttp.responseText+'</span><span class="ccr"><button onclick="return rem1dtg2(\'1an'+s+cnt+'\')">Xóa</button></span></div>';
    	   }
           xmlhttp = null;
           document.getElementById('1get_name'+s).value ='';
           
        }
      }
     xmlhttp.open("GET","ajax.php?id="+id+"&q="+Math.random(),true);
     xmlhttp.send();
    
    return false;
    }
function getname2(id,name,s) //ham lay thong tin ten cua can bo bang ma so hoac lay ten
    {
    if(id!='' && name !='') //nhap ca 2 gia tri
    {   
        document.getElementById('2get_name'+s).value ='';
        document.getElementById('22get_name'+s).value ='';
       alert('Chỉ được nhập 1 trong 2 trường mã số hoặc họ tên để thêm đồng tác giả');
       return false; 
        
    }else if(id=='' && name =='') //khong nhap gia tri nao
    {
        alert('Hãy nhập 1 trong 2 trường mã số hoặc họ tên để thêm đồng tác giả');
        return false;
    }else if(id=='' && name !='') // nhap gia tri ten
    {
        cnt=document.getElementById("22cnt_dtg"+s).value++; cnt++;
        var btn=document.createElement("div");
        btn.setAttribute('id','22an'+s+cnt);
        document.getElementById("2setname"+s).appendChild(btn);
        document.getElementById("22an"+s+cnt).innerHTML ='<input type="hidden" name="22andtg'+s+cnt+'"  value="'+name+'" /><div class="row2"><span class="ccr">Họ Tên: '+name+'</span><span class="ccr"><button onclick="return rem22dtg2(\'22an'+s+cnt+'\')">Xóa</button></span></div>';
    	document.getElementById('22get_name'+s).value ='';
        return false;
    }
     else if(id!='' && name =='') //nhap gia tri ma so
    {
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
         if(xmlhttp.responseText=='0'){
            alert('Không tồn tại cán bộ có mã số '+id);
         }
         else{ 
            
        cnt=document.getElementById("2cnt_dtg"+s).value++; cnt++;
        var btn=document.createElement("div");
        btn.setAttribute('id','2an'+s+cnt);
        document.getElementById("2setname"+s).appendChild(btn);
        document.getElementById("2an"+s+cnt).innerHTML ='<input type="hidden" name="2andtg'+s+cnt+'"  value="'+id+'" /><div class="row2"><span class="ccr">Mã số :'+id+'</span><span class="ccr"> | Họ Tên: '+xmlhttp.responseText+'</span><span class="ccr"><button onclick="return rem2dtg2(\'2an'+s+cnt+'\')">Xóa</button></span></div>';
    	   }
           xmlhttp = null;
           document.getElementById('2get_name'+s).value ='';
           
        }
      }
     xmlhttp.open("GET","ajax.php?id="+id+"&q="+Math.random(),true);
     xmlhttp.send();
    
    return false;
     }   
    }
function getname3(id,name,s) //ham lay thong tin ten cua can bo bang ma so hoac lay ten
    {
    if(id!='' && name !='') //nhap ca 2 gia tri
    {   
        document.getElementById('3get_name'+s).value ='';
        document.getElementById('33get_name'+s).value ='';
       alert('Chỉ được nhập 1 trong 2 trường mã số hoặc họ tên để thêm đồng tác giả');
       return false; 
        
    }else if(id=='' && name =='') //khong nhap gia tri nao
    {
        alert('Hãy nhập 1 trong 2 trường mã số hoặc họ tên để thêm đồng tác giả');
        return false;
    }else if(id=='' && name !='') // nhap gia tri ten
    {
        cnt=document.getElementById("33cnt_dtg"+s).value++; cnt++;
        var btn=document.createElement("div");
        btn.setAttribute('id','33an'+s+cnt);
        document.getElementById("3setname"+s).appendChild(btn);
        document.getElementById("33an"+s+cnt).innerHTML ='<input type="hidden" name="33andtg'+s+cnt+'"  value="'+name+'" /><div class="row2"><span class="ccr">Họ Tên: '+name+'</span><span class="ccr"><button onclick="return rem33dtg2(\'33an'+s+cnt+'\')">Xóa</button></span></div>';
    	document.getElementById('33get_name'+s).value ='';
        return false;
    }
     else if(id!='' && name =='') //nhap gia tri ma so
    {
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
         if(xmlhttp.responseText=='0'){
            alert('Không tồn tại cán bộ có mã số '+id);
         }
         else{ 
            
        cnt=document.getElementById("3cnt_dtg"+s).value++; cnt++;
        var btn=document.createElement("div");
        btn.setAttribute('id','3an'+s+cnt);
        document.getElementById("3setname"+s).appendChild(btn);
        document.getElementById("3an"+s+cnt).innerHTML ='<input type="hidden" name="3andtg'+s+cnt+'"  value="'+id+'" /><div class="row2"><span class="ccr">Mã số :'+id+'</span><span class="ccr"> | Họ Tên: '+xmlhttp.responseText+'</span><span class="ccr"><button onclick="return rem3dtg2(\'3an'+s+cnt+'\')">Xóa</button></span></div>';
    	   }
           xmlhttp = null;
           document.getElementById('3get_name'+s).value ='';
           
        }
      }
     xmlhttp.open("GET","ajax.php?id="+id+"&q="+Math.random(),true);
     xmlhttp.send();
    
    return false;
     }   
    }
/**------------------------ End Ajax---------------------------------------------------------------------------------*/
/**------------------------ Check Form---------------------------------------------------------------------------------*/
function isEmail(email) {
			var isValid = false;
			var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(regex.test(email)) {
				isValid = true;
			}
			return isValid;
		}
function check_llsl()
    {
    frm = document.editinfoForm;
	if(frm.per_name.value=="")
	{
		alert("Hãy nhập họ tên");
		frm.per_name.focus();
		return false;
	}else if (frm.per_birth.value == "" )
	{
	 		alert("Hãy nhập ngày tháng năm sinh");
			frm.per_birth.focus();
			return false;
	}else if (frm.per_born.value == "" )
	{
        	alert("Hãy nhập quê quán");
        	frm.per_born.focus();
        	return false;
	}else if (frm.per_Add.value == "" )
	{
	       alert("Hãy nhập địa chỉ liên hệ");
	       frm.per_Add.focus();
	       return false;
	}else if (frm.per_Email.value == "" )
	{
    	alert("Hãy nhập địa chỉ email");
    	frm.per_Email.focus();
    	return false;
	}else if (!isEmail(frm.per_Email.value))
	{
    	alert("Địa chỉ email chưa đúng");
    	frm.per_Email.focus();
    	return false;
	}else if (frm.per_DTCQ.value == "" || isNaN(frm.per_DTCQ.value))
	{
    	alert("Hãy nhập số điện thoại( chỉ bao gồm những ký số)");
    	frm.per_DTCQ.focus();
    	return false;
	}else if (frm.per_DTNR.value != "" || frm.per_DTDD.value != "")
	{
	     if (isNaN(frm.per_DTNR.value)){
	       alert("Hãy nhập số điện thoại( chỉ bao gồm những ký số)");
    	   frm.per_DTNR.focus();
    	   return false;
	     }
         if (isNaN(frm.per_DTDD.value)){
	       alert("Hãy nhập số điện thoại( chỉ bao gồm những ký số)");
    	   frm.per_DTDD.focus();
    	   return false;
	     }           									
	} 
	return true; 
    }
function check_qtdt()
    {
    frm = document.editschoolForm;
    cnt = frm.cnt_bc.value;
    for(i=1;i<=cnt;i++)
    {
    	a='BC_NDT'+i;  ndt=document.getElementById(a).value;
        b='BC_NH'+i;  nh=document.getElementById(b).value;
        c='BC_CN'+i;  cn=document.getElementById(c).value;
        d='BC_NcDT'+i;  ncdt=document.getElementById(d).value;
        e='BC_TDT'+i;  tdt=document.getElementById(e).value;
        f='BC_NHT'+i;  nht=document.getElementById(f).value;
        //alert(ndt+nh);return false;
        if(ndt=="")
    	{
    		alert("Hãy nhập nơi đào tạo");
    		document.getElementById(a).focus();
    		return false;
    	}else if (nh == "" )
    	{
    	 		alert("Hãy nhập ngành học");
    			document.getElementById(b).focus();
    			return false;
    	}else if (cn == "" )
    	{
    	 		alert("Hãy nhập chuyên ngành");
    			document.getElementById(c).focus();
    			return false;
    	}else if (ncdt == "" )
    	{
    	 		alert("Hãy nhập nước đào tạo");
    			document.getElementById(d).focus();
    			return false;
    	}else if (tdt == "" )
    	{
    	 		alert("Hãy nhập tên luận án");
    			document.getElementById(e).focus();
    			return false;
    	}
        else if (nht == "" )
    	{
    	 		alert("Hãy nhập năm hoàn thành");
    			document.getElementById(f).focus();
    			return false;
    	}
    } 
	return true; 
    }
function CompareDates(smallDate,largeDate,separator) { 
    var smallDateArr = Array(); 
    var largeDateArr = Array();
    
    smallDateArr     = smallDate.split(separator);
    largeDateArr     = largeDate.split(separator);
    
    var smallDt      = smallDateArr[0];
    var smallMt      = smallDateArr[1];
    var smallYr      = smallDateArr[2];
    
    var largeDt      = largeDateArr[0];
    var largeMt      = largeDateArr[1];
    var largeYr      = largeDateArr[2];
    
    if(smallYr>largeYr)
        return 0;
    else if(smallYr==largeYr && smallMt>largeMt)
        return 0;
    else if(smallYr==largeYr && smallMt==largeMt && smallDt>largeDt)
        return 0;
    else 
        return 1;
    
    } 
function check_ctcm()
    {
    frm = document.editworkForm;
    cnt = frm.cnt_ct.value;
    for(i=1;i<=cnt;i++)
    {
    	a='w_nbd'+i;  nbd=document.getElementById(a).value;
        b='w_nkt'+i;  nkt=document.getElementById(b).value;
        c='w_nct'+i;  nct=document.getElementById(c).value;
        d='w_cvdn'+i;  cvdn=document.getElementById(d).value;
        
        if(nbd=="")
    	{
    		alert("Hãy nhập ngày bắt đầu");
    		document.getElementById(a).focus();
    		return false;
    	}else if (nkt == "" )
    	{
    	 		alert("Hãy nhập ngày kết thúc");
    			document.getElementById(b).focus();
    			return false;
    	}else if (CompareDates(nbd,nkt,'-') == 0)
    	{
    	 		alert('Ngày bắt đầu lớn hơn ngày kết thúc');
    			document.getElementById(b).focus();
    			return false;
    	}else if (nct == "" )
    	{
    	 		alert("Hãy nhập nơi công tác");
    			document.getElementById(c).focus();
    			return false;
    	}else if (cvdn == "" )
    	{
    	 		alert("Hãy nhập công việc đảm nhận");
    			document.getElementById(d).focus();
    			return false;
    	}
    } 
	return true; 
    }
function check_nckh()
    {
    frm = document.editsciForm;
    cnt = frm.cnt_nc.value;
    for(i=1;i<=cnt;i++)
    {
    	a='NC_Ten'+i;  ncten=document.getElementById(a).value;
        b='NC_NamBD'+i;  ncbd=document.getElementById(b).value;
        c='NC_NamHT'+i;  nckt=document.getElementById(c).value;
        if(ncten=="")
    	{
    		alert("Hãy nhập tên đề tài");
    		document.getElementById(a).focus();
    		return false;
    	}else if (ncbd == "" )
    	{
    	 		alert("Hãy nhập năm bắt đầu");
    			document.getElementById(b).focus();
    			return false;
    	}else if (nckt == "" )
    	{
    	 		alert("Hãy nhập năm kết thúc");
    			document.getElementById(c).focus();
    			return false;
    	}
    }
    cnt2 = frm.cnt_book.value;
    for(i=1;i<=cnt2;i++)
    {
    	a='SGT_Ten'+i;  sten=document.getElementById(a).value;
        b='SGT_NXB'+i;  snxb=document.getElementById(b).value;
        c='SGT_NamXB'+i; snam=document.getElementById(c).value;
        if(sten=="")
    	{
    		alert("Hãy nhập tên sách");
    		document.getElementById(a).focus();
    		return false;
    	}else if (snxb == "" )
    	{
    	 		alert("Hãy nhập tên nhà xuất bản");
    			document.getElementById(b).focus();
    			return false;
    	}else if (snam == "" )
    	{
    	 		alert("Hãy nhập năm xuất bản");
    			document.getElementById(c).focus();
    			return false;
    	}
    }
    cnt3 = frm.cnt_kh.value;
    for(i=1;i<=cnt3;i++)
    {
    	a='KH_Ten'+i;  khten=document.getElementById(a).value;
        b='KH_TenTapChi'+i;  ttchi=document.getElementById(b).value;
        c='KH_SoTapChi'+i;  stchi=document.getElementById(c).value;
        d='KH_Trang'+i;  khtrang=document.getElementById(d).value;
        e='KH_NXB'+i;  nxb=document.getElementById(e).value;
        f='KH_NamCongBo'+i;  namcb=document.getElementById(f).value;
        //alert(ndt+nh);return false;
        if(khten=="")
    	{
    		alert("Hãy nhập tên công trình");
    		document.getElementById(a).focus();
    		return false;
    	}else if (ttchi == "" )
    	{
    	 		alert("Hãy nhập tên tạp chí");
    			document.getElementById(b).focus();
    			return false;
    	}else if (stchi == "" )
    	{
    	 		alert("Hãy nhập số tạp chí");
    			document.getElementById(c).focus();
    			return false;
    	}else if (khtrang == "" )
    	{
    	 		alert("Hãy nhập số trang");
    			document.getElementById(d).focus();
    			return false;
    	}else if (nxb == "" )
    	{
    	 		alert("Hãy nhập tên nhà xuất bản");
    			document.getElementById(e).focus();
    			return false;
    	}
        else if (namcb == "" )
    	{
    	 		alert("Hãy nhập năm công bố");
    			document.getElementById(f).focus();
    			return false;
    	}
    }   
	return true; 
    }    


/**------------------------ End Check Form---------------------------------------------------------------------------------*/
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
    alert('dad');return false;
}