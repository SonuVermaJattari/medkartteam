<?php

error_reporting(0);
class database
{
				
	/*var $servername='localhost';
	var $dbusername='root';
	var $dbpassword='';	
	var $dbname='dawa';*/
	
	var $servername='localhost';
	var $dbusername='website1_dawa'; 
	var $dbpassword='QT}loj},IRNm';			
	var $dbname='website1_dawa'; 
	function connection()
	{
		$connect=@mysql_connect($this->servername,$this->dbusername,$this->dbpassword) or mysql_error();
		$selectDB=@mysql_select_db($this->dbname,$connect) or mysql_error();	
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
	function projectname()
	{
		$admin_name =mysql_query("select id,name from admin_name where id='1'");
		$menu_res = mysql_fetch_assoc($admin_name);
		$admin_name1 = $menu_res['name'];
		return $admin_name1;			
	}
	function numRows($query) {
		$result  = mysql_query($query);
		$rowcount = mysql_num_rows($result);
		return $rowcount;	
	}
	function lockscreen()
	{
		return 115;		//		1 min
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

	function fectchRecord($table)
	{
		$SQL=$this->executupdate($table);
		$Fetch=@mysql_fetch_assoc($SQL) or mysql_error();
		return $Fetch;				
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

		

}
//calling methods 
$DB=new database();
$DB->connection();
date_default_timezone_set("Asia/Kolkata");
 ?>