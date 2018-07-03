<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
</head>
<?php include 'get_imagelink.php'; ?>
<body>
<form method="post" name="form" enctype="multipart/form-data" >

<div class="form-group">
                               				 <label>Get Image Link</label>
                                       		 <input name="img" type="file" class="form-control" id="img"/>
                                              <p class="help-block">*Image dimension should be in jpg format.</p>
                                              <div id="image_link"><?php if(isset($msg)!=''){ ?><h4>Copy this link:</h4><?php } ?><p class="help-block" style="color:#B90210; font-weight:800; font-size:16px;"><?php if(isset($msg)!=''){ echo "<input type='text' value='".$msg."' class='form-control' />";} if(isset($erromsg)!=''){ echo $erromsg;} ?></p></div>
                                              <button type="submit" name="getlink" >Get Link</button>
                  		          		</div>

</form>



</body>



</html>