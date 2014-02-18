var select_orderby_center = function(order_field, b_url, set_order_link, c_main_link, sess_f, sess_t)
{
	//this.type = typeof type !== 'undefined' ? type : '0';
	this.orderby_field=order_field;
	this.base_url=b_url;
	//set_orderby_link such as. : ?d=manage&c=xxx&m=set_orderby
	this.set_orderby_link=set_order_link;
	//controller_main_link such as. : ?d=manage&c=xxx&m=edit
	this.controller_main_link=c_main_link;
	//sess_field get data from : <?php echo $sess_orderby_xxx["field"];?>
	this.sess_field=sess_f;
	//sess_type get data from : <?php echo $sess_orderby_xxx["type"];?>
	this.sess_type=sess_t;
	var select_field='<select id="orderby" class="form-control">';
	select_field+=orderby_field;
	select_field+='</select>';
	var select_type='<select id="ordertype" class="form-control">';
	select_type+='<option value="ASC">น้อยไปหามาก</option>';
	select_type+='<option value="DESC">มากไปหาน้อย</option>';
	select_type+='</select>';
	bootbox.dialog({
		message: select_field+select_type,
		title: "เรียงลำดับข้อมูล",
		buttons: {
			success: {
				label: "ตกลง",
				className: "btn-success",
				callback: function() {
					$.post(base_url+set_orderby_link,{'field':$("#orderby").val(),type:$("#ordertype").val()},function(data,status){
						window.location=base_url+controller_main_link;
					});
				}
			},
			danger: {
				label: "ยกเลิก",
				className: "btn-danger",
				callback: function() {
				
				}
			}
		}
	});
	$("#orderby").val(sess_field);
	$("#ordertype").val(sess_type);
};

//--------------------------------------------------------------------

var select_search_center = function(s_field, b_url, s_link, c_main_link, sess_s)
{
	this.search_field=s_field;
	this.base_url=b_url;
	//search_link such as. : ?d=manage&c=xxx&m=set_searchfield
	this.search_link=s_link;
	//controller_main_link such as. : ?d=manage&c=xxx&m=edit
	this.controller_main_link=c_main_link;
	//sess_search get data from $this->session->userdata("searchfield_xxx")
	this.sess_search=sess_s;
	
	var select_field='<select id="searchfield" class="form-control">';
	select_field+=search_field;
	select_field+='</select>';

	bootbox.dialog({
		message: select_field+"<br/>",
		title: "เลือกประเภทการค้นหา",
		buttons: {
			success: {
				label: "ตกลง",
				className: "btn-success",
				callback: function() {
					$.post(base_url+search_link,{searchfield:$("#searchfield").val()},function(data,status){
						window.location=base_url+controller_main_link;
					});
				}
			},
			danger: {
				label: "ยกเลิก",
				className: "btn-danger",
				callback: function() {
				
				}
			}
		}
	});
	$("#searchfield").val(sess_search);
};

//--------------------------------------------------------------------

var del_all_checkbox = function(name)
{
	/*#################################################
	Checked/Unchecked all checkbox
	###################################################*/
	$("#del_all_"+name).click(function(e){
		if(this.checked)
		{
			$(".del_"+name).prop("checked",true);
		}
		else $(".del_"+name).prop("checked",false);		
	});
};

//--------------------------------------------------------------------

var show_allow_list_center = function(c_name, b_url, p_url, m_link)
{
	//ctl_name such as. : auth_log, article, titlename, ...
	this.ctl_name=c_name;
	this.base_url=b_url;
	//post_url such as. : ?d=manage&c=<?=$controller?>&m=allow
	this.post_url=p_url;
	//main_link such as. : "?d=manage&c=<?=$controller?>&m=edit"
	this.main_link=m_link;
	//show delete list in bootbox confirm
	var allow_list=new Array();
	var disallow_list=new Array();
	var allow_num = $(".allow_"+ctl_name+"0:checked").length;
	var disallow_num = $(".allow_"+ctl_name+"1:not(:checked)").length;
	//unchecked -> checked
	var text = "อนุมัติทั้งหมด "+allow_num+" รายการ?<br/>";
	text+="<ul>";
	$(".allow_"+ctl_name+"0:checked").each(function(){

			text+="<li>"+$(this).val()+" "+$("#"+ctl_name+$(this).val()).text()+"</li>";
			allow_list.push($(this).val());
	});
	text+="</ul>";
	//checked -> unchecked
	var text2 = "ยกเลิกทั้งหมด "+disallow_num+" รายการ?<br/>";
	text2+="<ul>";
	$(".allow_"+ctl_name+"1:not(:checked)").each(function(){

			text2+="<li>"+$(this).val()+" "+$("#"+ctl_name+$(this).val()).text()+"</li>";
			disallow_list.push($(this).val());
	});
	text2+="</ul>";
	bootbox.confirm(text+text2,function(result){
		if(result==true && (allow_num>0 || disallow_num>0))
		{
			$.post(base_url+post_url,{allow_list:allow_list,disallow_list:disallow_list},function(data,status){
				window.location=base_url+main_link;
			});
		}
	});
};

//--------------------------------------------------------------------

var clearSearchCenter = function(c_name, b_url)
{
	this.controller_name = c_name;
	this.base_url = b_url;
	$.post(base_url+"?d=manage&c="+controller_name+"&m=search",{clear:"clear"},function(data,status){
		window.location=base_url+"?d=manage&c="+controller_name+"&m=edit";
	});
};
var clearSearchCenter2 = function(b_url, s_url, r_url)
{
	this.base_url = b_url;
	this.search_url=s_url;
	this.redirect_url=r_url;
	$.post(base_url+search_url,{clear:"clear"},function(data,status){
		window.location=base_url+redirect_url;
	});
};

//--------------------------------------------------------------------

var set_page_num_center = function(num, b_url, r_url)
{
	this.num = num;
	this.base_url = b_url;
	this.redirect_url = r_url;
	$.post(base_url+"?c=center&m=set_per_page",{num:num},function(data,status){
		window.location=base_url+redirect_url;
	});
};

//--------------------------------------------------------------------

var show_del_list_center = function(m_name)
{
	this.m_name = m_name;
	//show delete list in bootbox confirm
	var checked_num = $(".del_"+m_name+":checked").length;
	var text = "ลบทั้งหมด "+checked_num+" รายการ?<br/>";
	text+="<ul>";
	$(".del_"+m_name).each(function(){
		if(this.checked)
		text+="<li>"+$(this).val()+" "+$("#"+m_name+$(this).val()).text()+"</li>";
	});
	text+="</ul>";
	bootbox.confirm(text,function(result){
		if(result==true && checked_num>0)$("#form_del_"+m_name).submit();
	});
};

//--------------------------------------------------------------------

var allow_red_to_green = function(m_name)
{
	this.m_name = m_name;
	$("#allow-all").click(function(){
		$(".allow_"+m_name+"0:not(:checked)").each(function(){
			$(this).prop("checked",true);
		});
		$(".allow_"+m_name+"1:not(:checked)").each(function(){
			$(this).prop("checked",true);
		});
	});
};

//--------------------------------------------------------------------

var disallow_green_to_red = function(m_name)
{
	this.m_name = m_name;
	$("#disallow-all").click(function(){
		$(".allow_"+m_name+"1:checked").each(function(){
			$(this).prop("checked",false);
		});
		$(".allow_"+m_name+"0:checked").each(function(){
			$(this).prop("checked",false);
		});
	});
};
















