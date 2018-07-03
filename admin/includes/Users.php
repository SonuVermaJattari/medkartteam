<?php 
class Users {
private $options = array();
	function __construct() {
		include 'conn.php';
		print_r($_POST);
			if(!empty($_POST['submit'])){
				foreach ($_POST as $key => $value)
				$this->options[$key] = $value;
				$this->validate();
				
				if($this->options['submit']=='log_in' && empty($this->error)){
					$this->log_in();
				}
				if($this->options['submit']=='create_login' && empty($this->error))
					$this->add(); 
			}
	}

	private function add() {
		$name=$_POST['name'];
		$username=$_POST['username'];
		$email=$_POST['email'];
		$password=$_POST['password']; //crypt(), md5()
		$Authencity=$_POST['duty'];
		$Status=$_POST['r3'];		
		//$sql = 'UPDATE `admin_login` SET `name` = "ayush" WHERE `password` = "a" ';		
		$query="INSERT INTO admin_login (name,username,email,password,Authencity,Status) VALUES('$name','$username','$email','$password','$Authencity','$Status')";
		mysql_query($query);
		$this->result = '<div class="alert alert-success">Successfully record Inserted.</div>';
	}
	private function validate() {
		if($this->options['submit']=='create_login'){
			if(empty($this->options['name'])) {
				 $this->error = '<div class="alert alert-danger">Name field(s) missing.</div>'; 
			}else if(empty($this->options['username'])) {
				 $this->error = '<div class="alert alert-danger">User name field(s) missing.</div>';
			}else if(empty($this->options['email'])) {
				 $this->error = '<div class="alert alert-danger">Email field(s) missing.</div>';
			}else if(empty($this->options['password'])) {
				 $this->error = '<div class="alert alert-danger">Password field(s) missing.</div>';
			}else if(empty($this->options['repassword'])) {
				 $this->error = '<div class="alert alert-danger">Re-Enter Password field(s) missing.</div>';
			}else if(($this->options['repassword'])!=($this->options['password'])) {
				 $this->error = '<div class="alert alert-danger">ReEnter Password not match.</div>';
			}
		}
		if($this->options['submit']=='log_in'){
			if($this->options['userid']=='' && $this->options['password']=='' ) {
				$this->error = '<div class="alert alert-danger">User id & password field(s) missing.</div>'; return 0;
			}else if(empty($this->options['userid'])) {
				$this->error = '<div class="alert alert-danger">User id field missing.</div>'; return 0;
			}else if(empty($this->options['password'])) {
				$this->error = '<div class="alert alert-danger">Password field missing.</div>';
			}
		}
				
	}
	private function log_in() { 
			if(empty($this->error)){
				$password=$this->options['password'];
				//$pass=md5($password); 
				$username=$this->options['userid'];
				$pub='published';
				$query="select username, password, status from admin_login where username='$username' and password='$password' and status='published'";
				$result=mysql_query($query);
				if(mysql_num_rows($result)<1)
					{
						$this->error= '<div class="alert alert-danger"> Invalid User Name or Password<div>';
						//exit;
						
					}else 
		}	
			
	}
	 public function error(){
		  if(!empty($this->error)){
		  	return $this->error;
		  } else if(isset($this->result)){
		  	return $this->result;
		  }
	  }
}
$users = new Users();
?>