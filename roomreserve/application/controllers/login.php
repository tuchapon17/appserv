<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	function auth()
	{
		if($this->session->userdata("rs_username")) redirect(base_url());
		$config=array(
				array(
						"field"=>"input_username",
						"label"=>"ชื่อผู้เข้าใช้ (Username)",
						"rules"=>"required"
				),
				array(
						"field"=>"input_password",
						"label"=>"รหัสผ่าน",
						"rules"=>"required"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$in_username_name="input_username";
			$in_username=array(
					"LB_text"=>"ชื่อผู้เข้าใช้ (Username)",
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$in_username_name,
					"IN_id"=>$in_username_name,
					"IN_PH"=>'',
					"IN_value"=>set_value($in_username_name),
					"IN_attr"=>'maxlength="15"',
					"help_text"=>''
			);
			$in_password_name="input_password";
			$in_password=array(
					"LB_text"=>"รหัสผ่าน",
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'password',
					"IN_class"=>'',
					"IN_name"=>$in_password_name,
					"IN_id"=>$in_password_name,
					"IN_PH"=>'',
					"IN_value"=>set_value($in_password_name),
					"IN_attr"=>'maxlength="15"',
					"help_text"=>''
			);
			
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("ลงชื่อเข้าใช้"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					
					"in_username"=>$this->eml->form_input($in_username),
					"in_password"=>$this->eml->form_input($in_password)
			);
			$this->load->view("login",$data);
		}
		else 
		{
			$this->load->model("login_model");
			$lm=$this->login_model;
			$login_result=$lm->check_auth();
			if($login_result==false)
			{
				$this->session->set_flashdata("login_message","ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
				redirect(base_url()."?c=login&m=auth");
			}
			else if($login_result==true)
			{
				redirect(base_url());
			}
		}
	}
	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url()."?c=login&m=auth");
	}
	function forgot_password()
	{
		$data=array(
				"htmlopen"=>$this->pel->htmlopen(),
				"head"=>$this->pel->head("ลืมรหัสผ่าน"),
				"bodyopen"=>$this->pel->bodyopen(),
				"navbar"=>$this->pel->navbar(),
				"js"=>$this->pel->js(),
				"footer"=>$this->pel->footer(),
				"bodyclose"=>$this->pel->bodyclose(),
				"htmlclose"=>$this->pel->htmlclose()
		);
		$this->load->view("forgot_password",$data);
	}
	function mail_reset_password()
	{
		$username=$this->security->xss_clean(strtolower($this->input->post("username")));
		$email=strtolower($this->input->post("email"));
		$this->db->select()->from("tb_user")
		->where("username",$username)
		->where("email",$email)
		->limit(1);
		$query = $this->db->get();
		$num_rows=$query->num_rows();
		if($num_rows > 0)
		{
			$r = $query->result_array();
			if($r[0]["reset_password"] == "0")
			{
				$h=md5($r[0]['username'].$r[0]['email'].$r[0]['regis_on'].$r[0]['password']);
					
				$new_pass=$this->generateRandomString(7);
					
				$email_sender="roomreserve17@gmail.com";
				$this->load->library("MY_phpmailer");
				$mail             = new PHPMailer();
				//$body             = file_get_contents('contents.html');
				//$body             = eregi_replace("[\]",'',$body);
					
				$body='<p><strong>เรียนคุณ '.$r[0]['firstname'].' '.$r[0]['lastname'].'</strong></p>';
				//$body.='<p>ขณะนี้ระบบได้ทำการรีเซตรหัสผ่านของท่านเรียบร้อยแล้ว</p>';
				//$body.='<p>โดยรหัสผ่านใหม่ คือ <h3>'.$new_pass.'</h3></p>';
				$body.='<p></p>';
				//$body.='<p>ท่านสามารถเข้าสู่ระบบด้วยรหัสผ่านใหม่นี้ ได้ที่ <a href="'.base_url().'?c=login&m=auth" target="_blank">คลิก</a></p>';
				$body.='<p>ท่านสามารถกำหนดรหัสผ่านใหม่ได้<a href="'.base_url().'?c=login&m=reset_password&u='.$username.'&h='.$h.'">ที่นี่</a></p>';
				$mail->IsSMTP(); // telling the class to use SMTP
				//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
				// 1 = errors and messages
				// 2 = messages only
				$mail->CharSet="utf-8";
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
				$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
				$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
				$mail->Username   = $email_sender;  // GMAIL username
				$mail->Password   = "tuchapon17";            // GMAIL password
				$mail->SetFrom($email_sender, 'no-reply - '.$email_sender);//ชื่อผู้ส่ง
				$mail->AddReplyTo($email_sender,"no-reply - ".$email_sender);//เมลสำหรับตอบกลับ , ชื่อ แสดงเมื่อตอบกลับ
				$mail->Subject    = "กำหนดรหัสผ่านใหม่- ระบบจัดการการจองห้อง";
				$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
				$mail->MsgHTML($body);
				$address = $r[0]['email'];
				$mail->AddAddress($address, $r[0]['firstname'].' '.$r[0]['lastname']);//เมล , ชื่อผู้รับ
				//$mail->AddAttachment("images/phpmailer.gif");      // attachment
				//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
				if(!$mail->Send()) {
					echo json_encode(array("error","ส่งลิงค์สำหรับกำหนดรหัสผ่านใหม่ทางอีเมลไม่สำเร็จ<br>".$mail->ErrorInfo));
					//echo "Mailer Error: " . $mail->ErrorInfo;
				}
				else
				{
					//change password in database
					$set=array("reset_password"=>1);
					$where=array("username"=>$username,"email"=>$email);
					//table, set, where, limit
					$this->db->update("tb_user",$set,$where,1);
				
					echo json_encode(array("sent","ส่งลิงค์สำหรับกำหนดรหัสผ่านใหม่ทางอีเมลสำเร็จ"));
					//echo "Message sent!";
				}
			}
			else
			{
				echo json_encode(array("error","ผู้ใช้นี้อยู่ระหว่างการกำหนดรหัสผ่านใหม่"));
			}
		}
		else echo json_encode(array("error","ไม่พบชื่อผู้เข้าใช้ หรืออีเมลที่ระบุ"));
	}
	
	function reset_password()
	{
		if(isset($_GET['u']) && isset($_GET['h']))
		{
			$h=$_GET['h'];
			$username=$this->security->xss_clean(strtolower($_GET['u']));
			$this->db->select()->from("tb_user")
			->where("username",$username)
			->where("reset_password",1)
			->limit(1);
			$query = $this->db->get();
			$num_rows=$query->num_rows();
			if($num_rows>0)
			{
				$r=$query->result_array();
				//$h_db from database
				$h_db=md5($r[0]['username'].$r[0]['email'].$r[0]['regis_on'].$r[0]['password']);
				if($h==$h_db)
				{
					$config=array(
							array(
									"field"=>"input_password",
									"label"=>"รหัสผ่าน",
									"rules"=>"required|max_length[15]|min_length[5]|callback_find_space"
							),
							array(
									"field"=>"input_password2",
									"label"=>"ยืนยันรหัสผ่าน",
									"rules"=>"required|max_length[15]|min_length[5]|matches[input_password]"
							)
					);
					$this->frm->set_rules($config);
					$this->frm->set_message("rule","message");
					if($this->frm->run() == false)
					{
						$data=array(
								"htmlopen"=>$this->pel->htmlopen(),
								"head"=>$this->pel->head("กำหนดรหัสผ่านใหม่"),
								"bodyopen"=>$this->pel->bodyopen(),
								"navbar"=>$this->pel->navbar(),
								"js"=>$this->pel->js(),
								"footer"=>$this->pel->footer(),
								"bodyclose"=>$this->pel->bodyclose(),
								"htmlclose"=>$this->pel->htmlclose()
						);
						$this->load->view("reset_password",$data);
					}
					else
					{
						$new_pass=md5($this->input->post("input_password"));
						$set=array(
								"reset_password"=>0,
								"password"=>$new_pass
						);
						$where=array(
								"username"=>$username
						);
						$this->db->trans_begin();
						//table, set, where, limit
						$this->db->update("tb_user",$set,$where,1);
						if($this->db->trans_status()===FALSE)
						{
							$this->db->trans_rollback();
							$this->session->set_flashdata("login_message_from_reset","<span class='text-danger'>รีเซตรหัสผ่านไม่สำเร็จ กรุณาลองใหม่อีกครั้ง</span>");
							redirect(base_url()."?c=login&m=auth");
						}
						else
						{
							$this->db->trans_commit();
							$this->session->set_flashdata("login_message_from_reset","<span class='text-success'>รีเซตรหัสผ่านสำเร็จ กรุณาทดสอบเข้าสู่ระบบ</span>");
							redirect(base_url()."?c=login&m=auth");
						}
					}
				}
				else show_404();
			}
			else show_404();
		}
		else show_404();
	}
	
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	function find_space($data)
	{
		/*#################################################
			Find space in string
		###################################################*/
		$this->form_validation->set_message("find_space","%s - มีช่องว่าง");
		if(strpos($data," ")==true) return false;
		else return true;
	}
}