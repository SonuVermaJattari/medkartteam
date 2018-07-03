<?php

date_default_timezone_set("Asia/Kolkata");

//error_reporting(0);
 define("BASEURL","http://" . $_SERVER['SERVER_NAME'].'/');
class database

{

	/*

	var $servername='localhost';

	var $dbusername='root';

	var $dbpassword='';

	var $dbname='dawa'; */



	var $servername='localhost';

	var $dbusername='root';

	var $dbpassword='';

	var $dbname='website1_dawa';




	public $new_IMG='';
	public $productsID=array();
	function url(){

		$mali_URL = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/medkart/";

		return $mali_URL;

	}

	function connection()
	{    
		$connect = @mysql_connect($this->servername,$this->dbusername,$this->dbpassword) or mysql_error();

		$selectDB = @mysql_select_db($this->dbname,$connect) or mysql_error();

		// $connect = mysql_connect('localhost','root','') or mysql_error();
  //   	$selectDB = mysql_select_db("website1_dawa") or mysql_error();

		if($selectDB)
		{
			return true;
		}
		else
		{
			return die(mysql_error());
		}

	}

	function fectch_prices($table)

	{

		$SQL=$this->executupdate($table);

		$num=mysql_num_rows($SQL);

			$Fetch=[];

			while($row=mysql_fetch_assoc($SQL)){

				$Fetch[$row['id']]=$row;

			}

			return $Fetch;

	}

	function date_diff($start,$end){

		$now = strtotime($start); // or your date as well

		$your_date = strtotime($end);

		$datediff = $your_date-$now;

		return floor($datediff / (60 * 60 * 24));

	}

	function date_format1($res){

	 	$date=date_create($res);

		return date_format($date,"d M Y");

	 }

	 function fetch_menu($table,$val,$f)

	{

		$array=array();

		$resultu_menu = mysql_query("select $val from $table");

		while($menu_res = mysql_fetch_array($resultu_menu)){

			$key=$menu_res['id'];

			$array[$key]=$menu_res[$f];

		}

		return $array;

	}

	function projectname()

	{

		$admin_name =mysql_query("select id,name from admin_name where id='1'");

		$menu_res = mysql_fetch_assoc($admin_name);

		$admin_name1 = $menu_res['name'];

		return $admin_name1;

	}

	function lockscreen()

	{

		return 5;		//		1 min

	}

	function logo()

	{

		$admin_name =mysql_query("select img from admin_name where id='1'");

		$menu_res = mysql_fetch_assoc($admin_name);

		$admin_name1 = $menu_res['img'];

		return $admin_name1;

	}

	function executupdate($Query)

	{

		$Run=@mysql_query($Query) or mysql_error();

		return $Run;

	}

	function get_ID($name,$level){

		if($level==1) $menu='menu';

		if($level==2) $menu='sub_menu';

		if($level==3) $menu='sub_sub_menu';

		$admin_name =mysql_query("select id from $menu where $menu='$name'");

		$menu_res = mysql_fetch_assoc($admin_name);

		$admin_name1 = $menu_res['id'];

		return $admin_name1;
	}

	function filter_Fil_singal($tb,$where,$val){

		//return "select products.$val,COUNT(products.id),products.id,filter_$val.name from products left JOIN filter_$val ON products.$val=filter_$val.id where $where AND products.$val!='' GROUP BY products.$val";

		$Run=$this->fectch_prices("select products.$val,COUNT(products.id),products.id,filter_$val.name from products left JOIN filter_$val ON products.$val=filter_$val.id where $where AND products.$val!='' GROUP BY products.$val");

		return $Run;

	}

	function filter_Fil_mult($tb,$where,$val){

		//return "select $val from $tb where $where AND $tb.$val!='' GROUP BY $tb.$val";

		$Run=mysql_query("select $val from $tb where $where AND $tb.$val!='' GROUP BY $tb.$val");

		$array_return=array();

		if((mysql_num_rows($Run))>0){

			while($menu_res = mysql_fetch_assoc($Run)){

				$abc=explode(',',$menu_res[$val]);

				foreach($abc as $abc_val){

					$array[]=$abc_val;

				}

			}

			$array=array_unique($array);

			$array_return=array();

			$i=0;

			foreach($array as $arrayVal){

				$Run=mysql_query("select COUNT(products.id),products.id,(SELECT name FROM filter_$val WHERE id='$arrayVal') as name from products where $where AND $val like '%$arrayVal%'");

				$menu_res_fli = mysql_fetch_assoc($Run);

				$array_return[$i]=$menu_res_fli;

				$array_return[$i][$val]=$arrayVal;

			$i++;

			}

		}

		return $array_return;

	}

	function fetch_array($t_name,$val)

	{

		$array=array();

		$resultu_menu = mysql_query("select $val from $t_name");

		while($menu_res = mysql_fetch_array($resultu_menu)){

			$key=$menu_res['id'];

			$array[$key]=$menu_res['name'];

		}

		return $array;

	}

	function fectchRecord($table)

	{

		$SQL=$this->executupdate($table);

		$Fetch=@mysql_fetch_assoc($SQL) or mysql_error();
		if(is_array($Fetch)){
			return $Fetch;
		}else{
			$Fetch=array();
			return $Fetch;
		}

	}

	function home_text($table,$id,$text)

	{

		$sql = "update $table set $text  where id = '$id' ";

		$SQL=$this->executupdate($sql);



		return $SQL;

	}

	function img($img,$wid,$hei,$folder = 'info')

	{

	$successflag=1;

	$_FILES['img']=$img;



			$imgs=getimagesize($_FILES['img']['tmp_name']);

			list($width,$height)=$imgs;

			//Image uploading code goes here.....

			$allow=array('image/jpeg','image/jpg','image/png');

			$type=$_FILES['img']['type'];

			$ext=explode('/',$type);



			$new_image_name = 'img_' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.'.$ext[1];

			//print_r($new_image_name);

			$srcpath=$_FILES['img']['tmp_name'];



			$url=$_POST['url'];

			if($new_image_name!=''){

				if(in_array($type,$allow)){

					 if($width<=$wid && $height<=$hei){

					 //return $srcpath;

							  if(is_uploaded_file($srcpath))

										{

											@mkdir("../images/".$folder."/",0777);

											$path="../images/".$folder."/".$new_image_name;

											$success=move_uploaded_file("$srcpath","$path");

												if($success)

												{



													//echo "file upload successfully";

												 $successflag=1;

												}

												else

												{

													$this->erromsg=" Error in uploading file";

														$successflag=0;

												}

										}

								else

									{

										$this->erromsg.=" Input file is not uploadable";

											$successflag=0;

									}

					}



					  else

						{

							$this->erromsg.=" Input image dimensions should be equal to $wid * $hei";

							$successflag=0;

						}

				}

				else

				{

					$this->erromsg.=" Input image file should be .jpg, .jpeg Format";

					$successflag=0;

				}

			}

			else

				{

					$this->erromsg .=" Input Image file does not exist";

					$successflag=0;

				}





		if($successflag=='1')

		return "images/".$folder.'/'.$new_image_name;



	}

	function img_hotelfacilties($img,$wid,$hei,$folder = 'info'){

			$successflag=1;

			$_FILES['imgicon']=$img;

			$imgs=getimagesize($_FILES['imgicon']['tmp_name']);

			list($width,$height)=$imgs;

			//Image uploading code goes here.....

			$allow=array('image/jpeg','image/jpg','image/png');

			$type=$_FILES['imgicon']['type'];

			$ext=explode('/',$type);



			$new_image_name = 'img_' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.'.$ext[1];

			//print_r($new_image_name);

			$srcpath=$_FILES['imgicon']['tmp_name'];



			$url=$_POST['url'];

			if($new_image_name!=''){

				if(in_array($type,$allow)){

					 if($width<=$wid && $height<=$hei){

					 //return $srcpath;

							  if(is_uploaded_file($srcpath))

										{

											@mkdir("../images/".$folder."/",0777);

											$path="../images/".$folder."/".$new_image_name;

											$success=move_uploaded_file("$srcpath","$path");

												if($success)

												{



													//echo "file upload successfully";

												 $successflag=1;

												}

												else

												{

													$this->erromsg=" Error in uploading file";

														$successflag=0;

												}

										}

								else

									{

										$this->erromsg.=" Input file is not uploadable";

											$successflag=0;

									}

					}



					  else

						{

							$this->erromsg.=" Input image dimensions should be equal to $wid * $hei";

							$successflag=0;

						}

				}

				else

				{

					$this->erromsg.=" Input image file should be .jpg, .jpeg Format";

					$successflag=0;

				}

			}

			else

				{

					$this->erromsg .=" Input Image file does not exist";

					$successflag=0;

				}





		if($successflag=='1')

		return "images/".$folder.'/'.$new_image_name;



	}

	function img_mul($img,$UploadFolder = 'info',$t_name,$room_id)

	{

		if($UploadFolder=='gallery'){

			$room_id_tb='gallery_id';

		}else{

			$room_id_tb='room_id';

		}

		$UploadFolder='../images/'.$UploadFolder;

		$_FILES=$img;

		$errors = array();

		$uploadedFiles = array();

		$extension = array("jpeg","jpg","png","gif");

		$bytes = 1024;

		$KB = 1024;

		$totalBytes = $bytes * $KB;

		//$UploadFolder = "UploadFolder";

		$counter = 0;

		foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){

			$temp = $_FILES["files"]["tmp_name"][$key];

			$name = $_FILES["files"]["name"][$key];

			if(empty($temp))

			{

				break;

			}



			$counter++;

			$UploadOk = true;



			if($_FILES["files"]["size"][$key] > $totalBytes)

			{

				$UploadOk = false;

				array_push($errors, $name." file size is larger than the 1 MB.");

			}



			$ext = pathinfo($name, PATHINFO_EXTENSION);

			if(in_array($ext, $extension) == false){

				$UploadOk = false;

				array_push($errors, $name." is invalid file type.");

			}



			if(file_exists($UploadFolder."/".$name) == true){

				$UploadOk = false;

				array_push($errors, $name." file is already exist.");

			}



			if($UploadOk == true){



				@mkdir($UploadFolder,0777);

				$success=move_uploaded_file($temp,$UploadFolder."/".$name);

				if($success)

				{

					$name_path=str_replace("../","",$UploadFolder."/".$name);

					$insert=$this->executupdate("INSERT INTO `$t_name`(`$room_id_tb`, `img`) VALUES ('$room_id','$name_path')");

					if($insert){ array_push($uploadedFiles, $name); }

					else{ array_push($errors, $name." Error in uploading file."); }

				}

				else

				{

					array_push($errors, $name." Error in uploading file.");

				}



			}

		}



		if($counter>0){

			if(count($errors)>0)

			{



				$er='';

				foreach($errors as $error)

				{

					 $er.="<li>".$error."</li>";

				}

				$this->erromsg="<ul>".$er."</ul>";

			}



			if(count($uploadedFiles)>0){

				$ms= "<b>Uploaded Files:</b>";

				$ms.= "<br/><ul>";

				foreach($uploadedFiles as $fileName)

				{

					$ms.= "<li><img src='".$UploadFolder.'/'.$fileName."' style='width:20%' /></li>";

				}

				$ms.= "</ul><br/>";

				$ms.= count($uploadedFiles)." file(s) are successfully uploaded.";

				return $ms;

				//count($uploadedFiles)." file(s) are successfully uploaded.";

			}

		}

		else{

			$this->erromsg= "Please, Select file(s) to upload.";

		}



	}

 	function error(){

		 return $this->erromsg;



	 }

	 function escape($res){

	 	return mysql_real_escape_string($res);

	 }





	function social_links($table){

		$SQL=$this->executupdate($table);

		$num=mysql_num_rows($SQL);

		if(($num)>0){

			if(($num)>1){

				$Fetch=array();

				while($row=mysql_fetch_assoc($SQL)){

					$Fetch[$row['social']]=$row['social_link'];

				}

			}else{

				$Fetch=@mysql_fetch_assoc($SQL) or mysql_error();

			}

			return $Fetch;

			//return $this->json($Fetch);

		}else{

			return 0;

		}



	}

	function registerOtp_send($email,$phone,$type){

		// generate OTP

		$otp = rand(100000,999999);

		// Send OTP

		$mail_status = $this->sendOTP($email,$otp,$type);
		echo $mail_status = $this->sendOTP_phone($phone,$otp,'OTP: ');
		if($mail_status){

			setcookie("postedOtp", true, time() + (60 * 15)); // 60 seconds ( 1 minute) * 15 = 15 minutes

			$_SESSION['postedOtp']=$otp;

			return 1;

		}else{

			$this->erromsg.=" Email Not Send..";

			return 0;

		}

	}
function sendOTP_phone($phone,$msg,$type){
		  $authKey = "206344A7nnlZ1W5abb3571";

		//Multiple mobiles numbers separated by comma
		$mobileNumber = $phone;

		//Sender ID,While using route4 sender id should be 6 characters long.
		$senderId = "TESTTD";

		//Your message to send, Add URL encoding here.

		$msg=$type.$msg;
		$message = urlencode($msg);

		//Define route
		$route = "4";
		//Prepare you post parameters
		$postData = array(
			'authkey' => $authKey,
			'mobiles' => $mobileNumber,
			'message' => $message,
			'sender' => $senderId,
			'route' => $route
		);

		//API URL
		$url="https://control.msg91.com/api/sendhttp.php";

		// init the resource
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData
			//,CURLOPT_FOLLOWLOCATION => true
		));


		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


		//get response
		$output = curl_exec($ch);

		//Print error if any
		if(curl_errno($ch))
		{
			return 0;
			//echo 'error:' . curl_error($ch);
		}

		curl_close($ch);
		return 1;
		//echo $output;

	}
	function sendOTP($to,$otp,$type='Registration'){

		$subject = "You OTP For ".$type.", The medkart";

		$body = "<div bgcolor='#f5f5f5' style='margin:0;padding:0'><div class='adM'>

		</div><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>

		<tbody><tr>

		<td style='padding:27px 20px 40px 20px;background-color:#f5f5f5;max-width:700px'>

		<table style='margin:0 auto' align='center' border='0' cellpadding='0' cellspacing='0' width='700'>

		<tbody><tr>

		<td width='600'>

		<table style='margin:0 auto;border:1px solid #d2d2d2;border-radius:5px' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>

		<tbody><tr>

		<td style='border-top-left-radius:5px;border-top-right-radius:5px' bgcolor='#ffffff' height='21' width='600'></td>

		</tr>

		<tr>

		<td style='padding:0 19px 0 21px' align='right' bgcolor='#ffffff'>

		<table border='0' cellpadding='0' cellspacing='0' width='100%'>

			<tbody><tr>

				<td style='display:block' align='right' bgcolor='#ffffff'>

					<img src='The-medkart-logo1.png' alt='' border='0'>

				</td>

			</tr>

		</tbody></table>

		</td>

		</tr>

		<tr>

		<td bgcolor='#ffffff' height='12' width='600'></td>

		</tr>

		<tr>

		<td style='padding:0 50px 62px;border-bottom-right-radius:5px;border-bottom-left-radius:5px' bgcolor='#ffffff'>



		<table>

			<tbody><tr>

				<td bgcolor='#ffffff'>

					<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>

						<tbody><tr>

							<td style='padding-bottom:49px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#292929;font-size:26px;line-height:1.2em;font-weight:bold' align='center' valign='top' width='600'>



		OTP

		</td>

					</tr>

					</tbody></table>

				</td>

			</tr>

			<tr>

				<td style='border-bottom-right-radius:5px;border-bottom-left-radius:5px' bgcolor='#ffffff'>

					<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>

						<tbody><tr>

							<td valign='top' width='100%'>



								<table border='0' cellpadding='0' cellspacing='0' width='100%'>

									<tbody><tr>

										<td style='padding:4px 0 15px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#797979;font-size:14px;line-height:1.6em'>





								</td></tr><tr>

										<td style='padding:7px 0 0px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#797979;font-size:14px;line-height:1.6em'>

		<a style='color:#0088cc;text-decoration:none'></a>

		<strong>$otp</strong>



		<hr />

		Thank you.



		</td>

		</tr>

								<tr>

										<td style='padding:17px 0 19px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#797979;font-size:14px;line-height:1.6em'>

		<a href='javascript:void(0)'>The-medkart</a><br>



		</td>

		</tr>

								</tbody></table>

							</td>

						</tr>

					</tbody></table>

				</td>

			</tr>



		</tbody></table>

		</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>";

		return $this->send($to,$subject,$body);

	}

	function send($to,$subject,$body){

		$headers = 'From: '."ayush@thewebtycoons.com". "\r\n" ;

		//'Reply-To: '."$femail". "\r\n" ;

		$headers .='MIME-Version: 1.0' . "\r\n";

		$headers .='Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$sent=mail($to,$subject,$body,$headers);

		if($sent){

			return 1;

		}else {

			return 0;

		}

	}

	function register_otp($post_val){

		if(isset($_COOKIE['postedOtp']) && $_COOKIE['postedOtp'] == true){

			if($_SESSION['postedOtp']==((int)$post_val)){

				return 1;

			}else{

				$this->erromsg.="Invalid OTP!";

				return 0;

			}

			// IS SET and has a true value

		}else{

			unset($_SESSION['postedOtp']);

			$this->erromsg.="OTP Expired, ..";

			return 0;

			// time out

		}

	}

	function register($post_val){



		foreach($post_val as $key=>$val){

				$$key=$this->escape($val);

		}

		// Email And phone exist or not.....





			$prefix=date("dmY");

			$count_web_id=$this->fectchRecord("SELECT max(post) as uid FROM `user` where prefix='$prefix' AND fix='$fix'");

			//$count_web_id=mysql_fetch_assoc($count_web);

			$invID=$count_web_id['uid']+1;

			//$invID = str_pad($inv, 4, '0', STR_PAD_LEFT);

			//$update_val= strtoupper($prefix.'-'.$invID);

			while($new_inv==''){

				$count_new=$this->executupdate("SELECT fix,prefix,post FROM `user` where prefix='$prefix' AND fix='$fix' AND post='$invID'");

				if(mysql_num_rows($count_new)==0){

					$new_inv=$invID;

				}else{

					$invID++;

				}

			}

			$invID=$new_inv;

			mysql_query("INSERT INTO `address`(  `title`, `fname`, `lname`,`address`, `street`, `city`, `state`, `pincode`,phone)  VALUES ('$title', '$fname', '$lname','$address', '$street', '$city', '$state', '$pincode','$phone')");

			$pincode123=mysql_insert_id();

			$xxy=mysql_query("INSERT INTO `user`(`fix`, `prefix`, `post`, `title`, `fname`, `lname`, `email`, `phone`,  `pass`, `gender`, `age`,  `address_id`, `status`, `date`, `approveDate`) VALUES ('$fix', '$prefix', '$invID', '$title', '$fname', '$lname', '$email', '$phone',  '$pass', '$gender', '$age','$pincode123', '1', NOW(), NOW())");

			$u_id=mysql_insert_id();

			if($xxy){

				$this->executupdate("UPDATE `address` SET `u_id`='$u_id' WHERE id='$pincode123'");

				$array['name']=$title.' '.$fname;

				$array['email']=$email;

				$array['uid']=$fix.$prefix.$invID;

				$array['pass']=$pass;
				$this->sendOTP_phone($phone,'','Registration SuccessFully');
				if(!$this->registerMail($array)){

					$this->erromsg.=" Mail Not Send But registration Successfully";

				}

				return 1;

			}



	}

	function registerCheck($email,$phone,$fix){

		if(mysql_num_rows($this->executupdate("SELECT email,phone FROM `user` where (email='$email' || phone='$phone') AND fix='$fix'"))==0){

			return 1;

		}else{


				if(mysql_num_rows($this->executupdate("SELECT email,phone FROM `user` where email='$email' AND fix='$fix'"))==0){

					$this->erromsg.="This Moblie number is already registered with us and is in use, if you think this is a mistake, please contact our customer support.";

					return 0;

				}else{

					$this->erromsg.="This email ID is already registered with us and is in use, if you think this is a mistake, please contact our customer support.";

					return 0;

				}
		}



	}

	function registerMail($array){



		$to =$array['email'];

		$name =$array['name'];

		$uid =$array['uid'];

		$pass =$array['pass'];

		$subject = "You Have Successful Registration For The medkart";

		$body = "<div bgcolor='#f5f5f5' style='margin:0;padding:0'><div class='adM'>

		</div><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>

		<tbody><tr>

		<td style='padding:27px 20px 40px 20px;background-color:#f5f5f5;max-width:700px'>

		<table style='margin:0 auto' align='center' border='0' cellpadding='0' cellspacing='0' width='700'>

		<tbody><tr>

		<td width='600'>

		<table style='margin:0 auto;border:1px solid #d2d2d2;border-radius:5px' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>

		<tbody><tr>

		<td style='border-top-left-radius:5px;border-top-right-radius:5px' bgcolor='#ffffff' height='21' width='600'></td>

		</tr>

		<tr>

		<td style='padding:0 19px 0 21px' align='right' bgcolor='#ffffff'>

		<table border='0' cellpadding='0' cellspacing='0' width='100%'>

			<tbody><tr>

				<td style='display:block' align='right' bgcolor='#ffffff'>

					<img src='The-medkart-logo1.png' alt='' border='0'>

				</td>

			</tr>

		</tbody></table>

		</td>

		</tr>

		<tr>

		<td bgcolor='#ffffff' height='12' width='600'></td>

		</tr>

		<tr>

		<td style='padding:0 50px 62px;border-bottom-right-radius:5px;border-bottom-left-radius:5px' bgcolor='#ffffff'>



		<table>

			<tbody><tr>

				<td bgcolor='#ffffff'>

					<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>

						<tbody><tr>

							<td style='padding-bottom:49px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#292929;font-size:26px;line-height:1.2em;font-weight:bold' align='center' valign='top' width='600'>



		Hello $name

		</td>

					</tr>

					</tbody></table>

				</td>

			</tr>

			<tr>

				<td style='border-bottom-right-radius:5px;border-bottom-left-radius:5px' bgcolor='#ffffff'>

					<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>

						<tbody><tr>

							<td valign='top' width='100%'>



								<table border='0' cellpadding='0' cellspacing='0' width='100%'>

									<tbody><tr>

										<td style='padding:4px 0 15px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#797979;font-size:14px;line-height:1.6em'>





								</td></tr><tr>

										<td style='padding:7px 0 0px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#797979;font-size:14px;line-height:1.6em'>

		<a style='color:#0088cc;text-decoration:none'></a>

		<strong>Your Registration Id : </strong> $uid <br />

		<strong>Your Login Id : </strong> $to <br />

		<strong>Your Passowrd : </strong> $pass <br />



		<a href='The-medkart'>Login</a>

		<hr />

		Thank you.



		</td>

		</tr>

								<tr>

										<td style='padding:17px 0 19px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#797979;font-size:14px;line-height:1.6em'>

		<a href='javascript:void(0)'>The-medkart</a><br>



		</td>

		</tr>

								</tbody></table>

							</td>

						</tr>

					</tbody></table>

				</td>

			</tr>



		</tbody></table>

		</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>";

		$headers = 'From: '."ayush@thewebtycoons.com". "\r\n" ;

		//'Reply-To: '."$femail". "\r\n" ;

		$headers .='MIME-Version: 1.0' . "\r\n";

		$headers .='Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$sent=mail($to,$subject,$body,$headers);

		if($sent){

			return 1;

		}else {

			return 0;

		}



	}

	function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds'){

		$sets = array();

		if(strpos($available_sets, 'l') !== false)

			$sets[] = 'abcdefghjkmnpqrstuvwxyz';

		if(strpos($available_sets, 'u') !== false)

			$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';

		if(strpos($available_sets, 'd') !== false)

			$sets[] = '23456789';

		if(strpos($available_sets, 's') !== false)

			$sets[] = '!@#$%&*?';

		$all = '';

		$password = '';

		foreach($sets as $set)

		{

			$password .= $set[array_rand(str_split($set))];

			$all .= $set;

		}

		$all = str_split($all);

		for($i = 0; $i < $length - count($sets); $i++)

			$password .= $all[array_rand($all)];

		$password = str_shuffle($password);

		if(!$add_dashes)

			return $password;

		$dash_len = floor(sqrt($length));

		$dash_str = '';

		while(strlen($password) > $dash_len)

		{

			$dash_str .= substr($password, 0, $dash_len) . '-';

			$password = substr($password, $dash_len);

		}

		$dash_str .= $password;

		return $dash_str;

	}

	function limitText($string,$limit){

		$string = strip_tags($string);

		if (strlen($string) > $limit) {

			// truncate string

			$stringCut = substr($string, 0, $limit);

			// make sure it ends in a word so assassinate doesn't become ass...

			$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';

		}

		return  $string;

	}

	function lastRemove($val,$val1){

		$xyz='';

		foreach($val as $brVal){

			$xyz.=" $val1 like '%$brVal%' || ";

		}

		$xyz=rtrim($xyz,"|| ");

		return '( '.$xyz.' )';

	}
	function lastRemove_sin($val,$val1){

		$xyz='';

		foreach($val as $brVal){

			$xyz.=" $val1 = '$brVal' || ";

		}

		$xyz=rtrim($xyz,"|| ");

		return '( '.$xyz.' )';

	}
	function runQuery($query) {

		$result = mysql_query($query);

		while($row=mysql_fetch_assoc($result)) {

			$resultset[] = $row;

		}

		if(!empty($resultset))

			return $resultset;

	}
	function numRows($query) {

		$result  = mysql_query($query);

		$rowcount = mysql_num_rows($result);

		return $rowcount;

	}
	function AddAddressInChechout($email,array $POST_array) {

		$rs=$this->fectchRecord("select id from user where email='$email'");

		$u_id=$rs['id'];

		if($u_id!=''){

			foreach($POST_array as $key=>$val){

				$$key=$this->escape($val);

			}



			if($this->executupdate("INSERT INTO `address`( `u_id`, `title`, `fname`, `lname`, `address`, `street`, `city`, `state`, `pincode`, `phone`) VALUES ('$u_id', '$title', '$fname', '$lname', '$address', '$street', '$city', '$state', '$pincode', '$phone')")){

				unset($POST_array);

				return 1;

			}else{

				return 0;

			}

		}else{

			return 0;

		}



	}
	function Validate_email_addresses_MYSQL() {

		/*Validate email addresses in Mysql*/

		//"SELECT * FROM `products_added` WHERE `username` NOT REGEXP '^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$' AND date<NOW()";

	}
	function OrderToPharmacist($product_id,$referralCode){
		$product_id_new='@'.$product_id.'@';
		$qur=mysql_query("SELECT id FROM `user` where CONCAT(fix,'',prefix,'',post)='$referralCode' AND fix='PID-' AND productsstatus='1' AND pharmacist_products LIKE '%$product_id_new%'");
		if((mysql_num_rows($qur))>0){
			return 1;
		}
		return 0;
	}
	function CodOrder(array $post_val,$referralCode=''){
		$email=$post_val['email'];
		$rs=$this->fectchRecord("select id from user where email='$email'");
		$u_id=$rs['id'];
		$shipping=$this->WhichPaymentMethodShipping($post_val['pincode']);


		if($shipping){
			$shipping=(int)$shipping['shippingcharges'];
		}else{
			$shipping='50';
		}

		/*Insert order confirm */
		mysql_query("INSERT INTO `order_confirm`( `user_id`,pay,order_status,order_date,shippingcharges) VALUES ('$u_id','0','1',NOW(),'$shipping')");
		$order_confirm_id=mysql_insert_id();

		/*Insert order address */
		unset($post_val['email']);
		foreach($post_val as $key=>$val){
			$$key=$this->escape($val);
		}


		$this->executupdate("INSERT INTO `order_address`( `order_confirm_id`, `title`, `fname`, `lname`, `address`, `street`, `city`, `state`, `pincode`, `phone`, `email`) VALUES ('$order_confirm_id', '$title', '$fname', '$lname', '$address', '$street', '$city', '$state', '$pincode',  '$phone','$email')");



		/*Insert order details */
		$products_array=[];
		$products_added=$this->executupdate("SELECT p_add.product_id,p_add.product_qty,price.p_b1,price.price,p_add.prescription_id,p_add.prescription_must,p_add.price_id FROM `products_added` p_add left join price on price.id=p_add.price_id WHERE p_add.username='$email'");
        $grandtotal=0;
		while($row=mysql_fetch_assoc($products_added)){
			$product_id=$row['product_id'];



			$product_id_new='@'.$product_id.'@';
			$qur=mysql_query( "SELECT CONCAT(fix,'',prefix,'',post) as pre FROM `user` where  fix='MID-' AND productsstatus='1' AND pharmacist_products  LIKE '%$product_id_new%'");
			if((mysql_num_rows($qur))>0){
				$x=mysql_fetch_assoc($qur);
				$referralCode1=$x['pre'];
			}else{
				if(($this->OrderToPharmacist($product_id,$referralCode))&&(!empty($referralCode))){
					$referralCode1=$referralCode;
				}else{
					$referralCode1='';
				}

			}
			$product_qty=$row['product_qty'];
			$price=$row['price'];
			$p_b1=$row['p_b1'];
			$price_id=$row['price_id'];

			$prescription_id=$row['prescription_id'];
			$prescription_must=$row['prescription_must'];

			$products_array[]=array('product_id'=>$row['product_id'],'product_qty'=>$row['product_qty'],'price'=>$row['price'],'p_b1'=>$row['p_b1'],'prescription_id'=>$row['prescription_id'],'prescription_must'=>$row['prescription_must'],'shipping'=>$shipping,'referralCode'=>$referralCode1);

			$this->executupdate("INSERT INTO `order_details`( `order_confirm_id`, `product_id`, `product_qty`, price_id, `price`, `p_b1`, `prescription_id`, `prescription_must`,referralCode) VALUES ('$order_confirm_id', '$product_id', '$product_qty','$price_id','$price','$p_b1','$prescription_id','$prescription_must','$referralCode1')");
            
            $grandtotal+=$price;
		}
        $producttotal=$grandtotal;
        $grandtotal_andShipping=$grandtotal+$shipping;
 
 // Loyality Function Call

        $grandtotal_andShipping_Loyality = calculate_loyality_point($grandtotal_andShipping); 


        mysql_query("UPDATE `order_confirm` SET `grand_total` = '$grandtotal_andShipping',grand_total_products='$producttotal' WHERE `order_confirm`.`id` = $order_confirm_id");

// Loyality Query

        mysql_query("INSERT INTO `loyality_points`(`order_id`, `user_id`, `loyality_points`, `status`) VALUES ('$order_confirm_id', '$u_id', '$grandtotal_andShipping_Loyality', '1')");
        
		$products_added=$this->executupdate("DELETE FROM `products_added` where username='$email'");
		$orderNumber='TD-'.str_pad($order_confirm_id, 5, "0", STR_PAD_LEFT);
		$table=$this->CodOrderMailTable($products_array,$post_val,'',$orderNumber);
		$mailSend=$this->CodOrderMail($email,'Order is under review process',$table);
		return $mailSend;
		//return 1;
	}
	function CodOrderMail($to,$subject,$body){

		$headers = 'From: '."ayush@thewebtycoons.com". "\r\n" ;

		//'Reply-To: '."$femail". "\r\n" ;

		$headers .='MIME-Version: 1.0' . "\r\n";

		$headers .='Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$headers .= 'Bcc: ayush@thewebtycoons.com' . "\r\n";

		$sent=mail($to,$subject,$body,$headers);

		if($sent){

			return 1;

		}else {

			return 0;

		}

	}

	function CodOrderMailTable(array $products_array,$post_val,$type='COD',$orderNumber){



		foreach($post_val as $key=>$val){

			$$key=$this->escape($val);

		}



		$mali_URL =$this->url();

		//$table.="<img src='".$mali_URL.'images/medkart-logo.jpg'."'>";



		$table.="<table class='table_type_1 order_review' style='padding: 0;border: none;border-collapse: collapse;'>

								<thead>

									<tr>

										<th class='product_title_col' style='background: #032c58;color:  white;' >Product Name</th>

										<th class='product_price_col' style='background: #032c58;color:  white;' >Price</th>

										<th class='product_qty_col' style='background: #032c58;color:  white;' >Quantity</th>

										<th class='product_total_col' style='background: #032c58;color:  white;' >Total</th>

									</tr>

								</thead>

								<tbody>";



									/*$products_array= array (

									'0' => array ( 'product_id' => 10, 'product_qty' => 1, 'price' => 2100 ,'p_b1' => 1 ) ,

									'1' => array ( 'product_id' => 16, 'product_qty' => 2 ,'price' => 122 ,'p_b1' => 10 )

									);*/



										$count=sizeof($products_array);

										if($count>0){

											$sumRs=0;

										foreach($products_array as $rs){

											$product_id=$rs['product_id'];

											$product_qty=$rs['product_qty'];

											$price=$rs['price'];

											$prescription_id=$rs['prescription_id'];

											$prescription_must=$rs['prescription_must'];

											$prescription_table='';

											$shipping=$rs['shipping'];




										if($prescription_must=='1'){

											 $prescription_table.= "<img src='".$mali_URL.'images/prescr-icon.png'."' style='width: 15px;' >Prescription Required<br>";

											$upload_prescriptionmqry="SELECT id,name,Img,DATE_FORMAT(upload_date, '%M %d %Y') as upload_date FROM `upload_prescription` where status='1' AND  id='".$rs['prescription_id']."'";

                                                $upload_prescriptionfetch=mysql_query($upload_prescriptionmqry);

                                               $upload_prescriptionweb=mysql_fetch_assoc($upload_prescriptionfetch);

											   			 $prescription_table.=$upload_prescriptionweb['name'].' '.$upload_prescriptionweb['upload_date'];



                                                }

											$sqlproducts="SELECT p.id,p.menu,p.name,cn.name as c_name,pa.name as p_bname, pa1.name as p_b1name,so.name as solt FROM `products` p left JOIN packing pa on p.p_b=pa.id left JOIN packing pa1 on p.p_b1=pa1.id left JOIN company_name cn on p.company_name=cn.id left JOIN solt so on p.solt=so.id where p.id='".$product_id."'";

											$resProducts=$this->runQuery($sqlproducts);

											$resProducts=$resProducts[0];





									$table.="<tr>

										<td data-title='Product Name' style='border: 1px solid #eaeaea;padding: 14px 19px;'>";

										 $a_tag= $resProducts['menu']=='1'?$mali_URL.'product_details-medicine.php?q='.$resProducts['id']:$mali_URL.'product_details.php?q='.$resProducts['id'];

										 $resProducts_name=$resProducts['name'];

										 $resProducts_c_name=$resProducts['c_name'];

										 $resProducts_li=$resProducts['solt']!=''?'<li>'.$resProducts['solt'].'</li>':'';

										 $table.="<a href=' $a_tag ' class='product_title'> $resProducts_name </a>"."<ul class='sc_product_info' style='list-style: none;'>

												<li>$resProducts_c_name </li>

                                                $resProducts_li ";

												 $ta=$rs['p_b1'].' '.$resProducts['p_b1name'].'  in 1 '.$resProducts['p_bname'];

												$rs_price=$rs['price'];

												 	$table.=	"<li>$ta</li>

														<li>$prescription_table</li>

											</ul>

										</td>

										<td data-title='Price' style='border: 1px solid #eaeaea;padding: 14px 19px; font-size:16px;font-weight: 600;' class='subtotal'>Rs. $rs_price </td>

										<td data-title='Quantity' style='border: 1px solid #eaeaea;padding: 14px 19px;' > $product_qty </td>";

										 $sumRs=$sumRs+($product_qty*$rs['price']);

										 $sumRs1=$product_qty*$rs['price'];

										$table.="<td style='border: 1px solid #eaeaea;padding: 14px 19px;color: rgb(3, 44, 88);' data-title='Total' class='total'>Rs.  $sumRs1</td>

									</tr>";

									 } }
									 $TotalsumRs=$shipping+$sumRs;
									if($shipping=='0'){
										$shipping='Free Shipping';
									}
                               $table.=" </tbody>

								<tfoot>

									<tr style='border: 1px solid #eaeaea;padding: 14px 19px;'>

										<td colspan='3' class='bold' style='border: 1px solid #eaeaea;padding: 14px 19px;'>Subtotal</td>

										<td class='total' style='border: 1px solid #eaeaea;padding: 14px 19px;color: rgb(3, 44, 88);' >Rs. $sumRs </td>

									</tr>
									<tr>
										<td colspan='3' class='bold' style='border: 1px solid #eaeaea;padding: 14px 19px;'>Shipping Charges </td>
										<td class='total' style='border: 1px solid #eaeaea;padding: 14px 19px;color: rgb(3, 44, 88);' >Rs. $shipping </td>
									</tr>
									<tr style='border: 1px solid #eaeaea;padding: 14px 19px;'>

										<td colspan='3' style='border: 1px solid #eaeaea;padding: 14px 19px;' class='grandtotal'>Grand Total</td>

										<td class='grandtotal' style='border: 1px solid #eaeaea;padding: 14px 19px;color: rgb(3, 44, 88);' >Rs. $TotalsumRs </td>

									</tr>

									<tr style='border: 1px solid #eaeaea;padding: 14px 19px;'>

										<td colspan='4' style='border: 1px solid #eaeaea;padding: 14px 19px;text-align: center;' class='grandtotal'>$type</td>

									</tr>

									<tr style='border: 1px solid #eaeaea;padding: 14px 19px;'>

										<td colspan='4' style='border: 1px solid #eaeaea;padding: 14px 19px;text-align: center;' class='grandtotal'>Order Number: $orderNumber</td>

									</tr>

									<tr style='border: 1px solid #eaeaea;padding: 14px 19px;'>

										<td colspan='4' style='border: 1px solid #eaeaea;padding: 14px 19px;'>

											<p>$title $fname $lname </p>

											<p>$address</p>

											<p>$street</p>

											<p>$phone</p>

											<p>$city</p>

											<p>$state</p>

											<p>$pincode</p>

										</td>

									</tr>

								</tfoot>

							</table>";

							return $table;

	}
	function runQuery_OrderList($query) {

		$result = mysql_query($query);

		$resultset=array();

		while($row=mysql_fetch_assoc($result)) {

			$resultset[] = $row;

		}

		//if(!empty($resultset))

			return $resultset;

	}
	// Admin ( orders_list )  AND orders_list
	function OrdersListQuery($val) {

		if($val=='home'){

		$query="SELECT ocf.id,ocf.user_id,ocf.pay,ocf.order_status,DATE_FORMAT(ocf.order_date, '%M %d %Y') as order_date,CONCAT(oad.title,' ',oad.fname,' ',oad.lname,'<br>',oad.address,', ',oad.street,'<br>',oad.state,', ',oad.city,' - ',oad.pincode,'<br>',oad.phone) as Shipping, oad.phone,oad.email,(SELECT SUM(price*product_qty+ocf.shippingcharges) as price FROM `order_details` WHERE order_confirm_id=ocf.id  GROUP BY order_confirm_id ) as price,ocf.shippingcharges FROM `order_confirm` ocf LEFT JOIN order_address oad ON oad.order_confirm_id=ocf.id ";

		}

		if($val=='admin'){

		$query="SELECT ocf.id,ocf.user_id,ocf.pay,ocf.order_status,DATE_FORMAT(ocf.order_date, '%M %d %Y') as order_date,(SELECT CONCAT_WS('<br>',CONCAT_WS(' ',title,fname,lname) , CONCAT_WS('<br>',email,phone)) as Billing FROM `user` WHERE user.id=ocf.user_id) as Billing,CONCAT(oad.title,' ',oad.fname,' ',oad.lname,'<br>',oad.address,', ',oad.street,'<br>',oad.state,', ',oad.city,' , ',oad.pincode,'<br>',oad.phone,'<br>',oad.email) as Shipping, oad.phone,oad.email,(SELECT SUM(price*product_qty+ocf.shippingcharges) as price FROM `order_details` WHERE order_confirm_id=ocf.id GROUP BY order_confirm_id ) as price,ocf.shippingcharges FROM `order_confirm` ocf LEFT JOIN order_address oad ON oad.order_confirm_id=ocf.id ";

		}

		  return $query;

	}
	function OrderConfirmProducts($order_confirm_id){

		$products_array=array();

		$products_added=$this->executupdate("SELECT * FROM `order_details` WHERE order_confirm_id='$order_confirm_id'");

		while($row=mysql_fetch_assoc($products_added)){

			/*$product_id=$row['product_id'];

			$product_qty=$row['product_qty'];

			$price=$row['price'];

			$p_b1=$row['p_b1'];*/

			$products_array[]=array('product_id'=>$row['product_id'],'product_qty'=>$row['product_qty'],'price'=>$row['price'],'p_b1'=>$row['p_b1'],'prescription_id'=>$row['prescription_id'],'prescription_must'=>$row['prescription_must'],'referralCode'=>$row['referralCode']);

		}

		return $products_array;

	}
	function OrderDetails($order_confirm_id,$shippingcharges=''){
	$shipping=$shippingcharges;
		$products_array=$this->OrderConfirmProducts($order_confirm_id);

		$mali_URL =$this->url();

		$table="<h3 class=\"oderAdmin\">Items Ordered</h3><div class='table_wrap'><table class='table_type_1 order_review' style='padding: 0;border: none;border-collapse: collapse;'>

								<thead>

									<tr>

										<th class='product_title_col' style='background: #032c58;color:  white;' >Product Name</th>

										<th class='product_price_col' style='background: #032c58;color:  white;' >Price</th>

										<th class='product_qty_col' style='background: #032c58;color:  white;' >Quantity</th>

										<th class='product_total_col' style='background: #032c58;color:  white;' >Total</th>

									</tr>

								</thead>

								<tbody>";

										$count=sizeof($products_array);

										if($count>0){

											$sumRs=0;

										foreach($products_array as $rs){

											$product_id=$rs['product_id'];

											$product_qty=$rs['product_qty'];

											$referralCode=$rs['referralCode'];
											if(!empty($referralCode)){
												$referralCode='ReferralCode '.$referralCode;
											}

											$price=$rs['price'];

											$prescription_must=$rs['prescription_must'];




											$sqlproducts="SELECT p.id,p.menu,p.name,cn.name as c_name,pa.name as p_bname, pa1.name as p_b1name,so.name as solt FROM `products` p left JOIN packing pa on p.p_b=pa.id left JOIN packing pa1 on p.p_b1=pa1.id left JOIN company_name cn on p.company_name=cn.id left JOIN solt so on p.solt=so.id where p.id='".$product_id."'";

											$resProducts=$this->runQuery($sqlproducts);

											$resProducts=$resProducts[0];

											$prescription_table='';



										if($prescription_must=='1'){

											 $prescription_table.= "<img src='".$mali_URL.'images/prescr-icon.png'."' style='width: 15px;' >Prescription Required<br>";

											$upload_prescriptionmqry="SELECT id,name,Img,DATE_FORMAT(upload_date, '%M %d %Y') as upload_date FROM `upload_prescription` where status='1' AND  id='".$rs['prescription_id']."'";

                                                $upload_prescriptionfetch=mysql_query($upload_prescriptionmqry);

                                               $upload_prescriptionweb=mysql_fetch_assoc($upload_prescriptionfetch);

											   			 $prescription_table.=$upload_prescriptionweb['name'].' '.$upload_prescriptionweb['upload_date'].'<br />';

														 $prescription_table.= "<img src='".$mali_URL.$upload_prescriptionweb['Img']."' style='width: 15%;' >";



                                                }



									$table.="<tr>

										<td data-title='Product Name' style='border: 1px solid #eaeaea;padding: 14px 19px;'>";

										 $a_tag= $resProducts['menu']=='1'?$mali_URL.'product_details-medicine.php?q='.$resProducts['id']:$mali_URL.'product_details.php?q='.$resProducts['id'];

										 $resProducts_name=$resProducts['name'];

										 $resProducts_c_name=$resProducts['c_name'];

										 $resProducts_li=$resProducts['solt']!=''?'<li>'.$resProducts['solt'].'</li>':'';

										 $table.="<a href=' $a_tag ' class='product_title'> $resProducts_name </a>"."<ul class='sc_product_info' style='list-style: none;'>

												<li>$resProducts_c_name </li>

                                                $resProducts_li ";

												 $ta=$rs['p_b1'].' '.$resProducts['p_b1name'].'  in 1 '.$resProducts['p_bname'];

												$rs_price=$rs['price'];

												 	$table.=	"<li>$ta</li>

													<li>$prescription_table</li>
													<li>$referralCode</li>




											</ul>

										</td>

										<td data-title='Price' style='border: 1px solid #eaeaea;padding: 14px 19px; font-size:16px;font-weight: 600;' class='subtotal'>Rs. $rs_price </td>

										<td data-title='Quantity' style='border: 1px solid #eaeaea;padding: 14px 19px;' > $product_qty </td>";

										 $sumRs=$sumRs+($product_qty*$rs['price']);

										 $sumRs1=$product_qty*$rs['price'];

										$table.="<td style='border: 1px solid #eaeaea;padding: 14px 19px;color: rgb(3, 44, 88);' data-title='Total' class='total'>Rs.  $sumRs1</td>

									</tr>";

									 } }

 									$TotalsumRs=$shipping+$sumRs;
									if($shipping=='0'){
										$shipping='Free Shipping';
									}else{
										$shipping='Rs. '.$shipping;
									}
                               $table.=" </tbody>

								<tfoot>

									<tr style='border: 1px solid #eaeaea;padding: 14px 19px;'>

										<td colspan='3' class='bold' style='border: 1px solid #eaeaea;padding: 14px 19px;'>Subtotal</td>

										<td class='total' style='border: 1px solid #eaeaea;padding: 14px 19px;color: rgb(3, 44, 88);' >Rs. $sumRs </td>

									</tr>

									<tr>
										<td colspan='3' class='bold' style='border: 1px solid #eaeaea;padding: 14px 19px;'>Shipping Charges </td>
										<td class='total' style='border: 1px solid #eaeaea;padding: 14px 19px;color: rgb(3, 44, 88);' > $shipping </td>
									</tr>
									<tr style='border: 1px solid #eaeaea;padding: 14px 19px;'>

										<td colspan='3' style='border: 1px solid #eaeaea;padding: 14px 19px;' class='grandtotal'>Grand Total</td>

										<td class='grandtotal' style='border: 1px solid #eaeaea;padding: 14px 19px;color: rgb(3, 44, 88);' >Rs. $TotalsumRs </td>

									</tr>

								</tfoot>

							</table></div>";

							return $table;

	}
	function NewPassword($pass,$email,$phone){

		if($this->executupdate("UPDATE `user` SET `pass`='$pass' WHERE email='$email' AND phone='$phone' ")){



			$body = "<div bgcolor='#f5f5f5' style='margin:0;padding:0'><div class='adM'>

		</div><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>

		<tbody><tr>

		<td style='padding:27px 20px 40px 20px;background-color:#f5f5f5;max-width:700px'>

		<table style='margin:0 auto' align='center' border='0' cellpadding='0' cellspacing='0' width='700'>

		<tbody><tr>

		<td width='600'>

		<table style='margin:0 auto;border:1px solid #d2d2d2;border-radius:5px' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>

		<tbody><tr>

		<td style='border-top-left-radius:5px;border-top-right-radius:5px' bgcolor='#ffffff' height='21' width='600'></td>

		</tr>

		<tr>

		<td style='padding:0 19px 0 21px' align='right' bgcolor='#ffffff'>

		<table border='0' cellpadding='0' cellspacing='0' width='100%'>

			<tbody><tr>

				<td style='display:block' align='right' bgcolor='#ffffff'>

					<img src='The-medkart-logo1.png' alt='' border='0'>

				</td>

			</tr>

		</tbody></table>

		</td>

		</tr>

		<tr>

		<td bgcolor='#ffffff' height='12' width='600'></td>

		</tr>

		<tr>

		<td style='padding:0 50px 62px;border-bottom-right-radius:5px;border-bottom-left-radius:5px' bgcolor='#ffffff'>



		<table>

			<tbody><tr>

				<td bgcolor='#ffffff'>

					<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>

						<tbody><tr>

							<td style='padding-bottom:49px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#292929;font-size:26px;line-height:1.2em;font-weight:bold' align='center' valign='top' width='600'>



		$email

		</td>

					</tr>

					</tbody></table>

				</td>

			</tr>

			<tr>

				<td style='border-bottom-right-radius:5px;border-bottom-left-radius:5px' bgcolor='#ffffff'>

					<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>

						<tbody><tr>

							<td valign='top' width='100%'>



								<table border='0' cellpadding='0' cellspacing='0' width='100%'>

									<tbody><tr>

										<td style='padding:4px 0 15px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#797979;font-size:14px;line-height:1.6em'>





								</td></tr><tr>

										<td style='padding:7px 0 0px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#797979;font-size:14px;line-height:1.6em'>

		<a style='color:#0088cc;text-decoration:none'></a>

		<strong>New Password Set.</strong>



		<hr />

		Thank you.



		</td>

		</tr>

								<tr>

										<td style='padding:17px 0 19px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#797979;font-size:14px;line-height:1.6em'>

		<a href='javascript:void(0)'>The-medkart</a><br>



		</td>

		</tr>

								</tbody></table>

							</td>

						</tr>

					</tbody></table>

				</td>

			</tr>



		</tbody></table>

		</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>";

			//$this->send($to,$subject,$body);

			if($this->send($email,'Password has been Changed.',$body)){

				return 1;

			}else{

				$this->erromsg.='Mail not Send but New Password Is Updated.';

				return 1;

			}



		}else{

			$this->erromsg.='Error for Update';

			return 0;

		}



	}
	function UploadPrescription($img,$wid,$hei,$folder = 'UploadPrescription',$imgName='userImage',$uniqid,$u_id,$email,$name=''){

		$successflag=1;

			$_FILES=$img;

			$imgs=getimagesize($_FILES[$imgName]['tmp_name']);

			list($width,$height)=$imgs;

			//Image uploading code goes here.....

			$allow=array('image/jpeg','image/jpg');

			$type=$_FILES['userImage']['type'];

			$ext=explode('/',$type);

			$new_image_name = $uniqid . '_' . date('Y-m-d-H-i-s') . '.'.$ext[1];

			if($name==''){

				$name=$new_image_name;

			}

			$srcpath=$_FILES[$imgName]['tmp_name'];

			if($new_image_name!=''){

				if(in_array($type,$allow)){

					 if($width<=$wid && $height<=$hei){

						  if(is_uploaded_file($srcpath)){

							@mkdir("images/".$folder."/",0777);

							$path="images/".$folder."/".$new_image_name;

							$success=move_uploaded_file("$srcpath","$path");

							if($success)

							{

								if($this->executupdate("insert into upload_prescription ( `email`, `u_id`, `Img`, `name`,upload_date,status) VALUES ('$email','$u_id','$path','$name',NOW(),'1')"))

							 	{$successflag=1;}

								else

								{

									$this->erromsg=" Error in to DB";

									unlink($path);

									$successflag=0;

									}

							}

							else

							{

								$this->erromsg=" Error in uploading file";

								$successflag=0;

							}

						}else{

							$this->erromsg.=" Input file is not uploadable";

							$successflag=0;

						}

					}else {

						$this->erromsg.=" Input image dimensions should be equal to $wid * $hei";

						$successflag=0;

					}

				}

				else

				{

					$this->erromsg.=" Input image file should be .jpg, .jpeg Format";

					$successflag=0;

				}

			}

			else

			{

				$this->erromsg .=" Input Image file does not exist";

				$successflag=0;

			}

		if($successflag=='1'){

			$this->new_IMG=$name;

			return "images/".$folder.'/'.$new_image_name;

		}

		else

		return $successflag;



	}
	function check_prescription($sql,$email){
			$res=$this->executupdate($sql);
			$count=mysql_num_rows($res);
			if($count>0){
				$p_pre=0;
			while($rs=mysql_fetch_assoc($res)){
				$this->erromsg='';
				$product_id=$rs['product_id'];
				$products_added_id=$rs['id'];
				$prescription_id=$rs['prescription_id'];
				if(($this->numRows("SELECT id FROM `products` where id='$product_id' AND prescription='1'"))>0){
					$p_pre++;
					// update prescription 1
					if($prescription_id=='whatsapp'){
						$p_pre--;
					}else{
						$this->executupdate("UPDATE `products_added` SET `prescription_must`='1' WHERE id='$products_added_id' AND product_id='$product_id' AND prescription_must='0'");
						if(($prescription_id!='0')&&($prescription_id!='whatsapp')){
							$upload_prsc_fetch=$this->fectchRecord("SELECT * FROM `upload_prescription` where (id='$prescription_id' ) AND email='$email' AND status='1'");
							if((sizeof($upload_prsc_fetch))>0){
								if(file_exists($upload_prsc_fetch['Img'])){
									$p_pre--;
								}else{
									$this->erromsg='Upload prescription Missing....';
									return -1;
								}
							}else{
								$this->erromsg='Prescription Upload First....';
								return -1; // exit
							}
						}else{
							$this->erromsg='Prescription Upload First....';
							return -1; // exit
						}
					}
				}else{
					// update prescription 0
					$this->executupdate("UPDATE `products_added` SET `prescription_must`='0' WHERE id='$products_added_id' AND product_id='$product_id' AND prescription_must='1'");
				}
		 	}
			return $p_pre; // return 0 it means prescription uploaded..
		}else{
			$this->erromsg=' Cart Empty....';
			return -1; // exit to checkout page
		}

	}
	function TwoYearsPrescriptionDelete($email=''){
		if($email!=''){
			$q=" AND email='$email'";
		}else{
			$q='';
		}
		$qur=mysql_query("SELECT * FROM `upload_prescription` WHERE (upload_date) <= DATE_SUB(NOW(),INTERVAL 1 YEAR) $q");
		if((mysql_num_rows($qur))>0){
			while($fetch = mysql_fetch_assoc($qur)){
				if(file_exists($fetch['Img'])){
					$link=unlink($fetch['Img']);
				}
			}
			$this->executupdate("DELETE from `upload_prescription`  WHERE (upload_date) <= DATE_SUB(NOW(),INTERVAL 1 YEAR) $q ");
			return 1;
		}else{
			return 0;
		}
	}
	function OrderAgain($email,$orderId){
		$fetchOrderAgain=$this->fectch_prices("SELECT * FROM `order_details` where order_confirm_id='$orderId'");
		$quValue='INSERT INTO `products_added`(`username`, `product_id`, `product_qty`, `price_id`, `date`, `prescription_id`, `prescription_must`) VALUES ';
		foreach($fetchOrderAgain as $val){
			$val = (object) $val;
			$quValue.="('$email','{$val->product_id}','{$val->product_qty}','{$val->price_id}',NOW(),'{$val->prescription_id}','{$val->prescription_must}'),";
		}
		$quValue=rtrim($quValue,',');
		if($this->executupdate($quValue)){
			return 1;
		}else{
			return 0;
		}

	}
	function WhichPaymentMethodVisible($email){
		$fetcharray=$this->fectchRecord("SELECT IF(((SUM(price.price * products_added.product_qty))>2000),'0','1') as codTrue FROM `products_added` LEFT JOIN price ON price.id=products_added.price_id WHERE products_added.username='$email'");
		//return $fetcharray;
		if((sizeof($fetcharray))>0){
			return $fetcharray['codTrue'];
		}else{
			return 0;
		}
	}
	function WhichPaymentMethodShipping($pincode){
		$fetcharray=$this->fectchRecord("SELECT *  FROM `pincodes` WHERE number='$pincode' AND status='1'");
		if((sizeof($fetcharray))>0){
			return $fetcharray;
		}else{
			return 0;
		}
	}
}
 $order_statusOptions=array('1'=>"Process",
                        "2"=>"Pending",
                       "3"=>"Forwarded",
                       "4"=>"Packed",
                       "5"=>"Shipped",
                       "6"=>"Delivered",
                       "-1"=>"Cancel"
                                 ) ;               
                       


//calling methods

$DB=new database();

$DB->connection();

		function calculate_loyality_point($amount)
		{
		return	$result = number_format($amount/100, 2 , '.' , '');
		}

 ?>
