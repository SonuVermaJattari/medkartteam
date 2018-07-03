<?php  $msg=""; $erromsg=''; $addr="http://".$_SERVER['HTTP_HOST'];

if(isset($_POST['getlink']))

{

if($_FILES['img']['tmp_name']!='' )

{



	 	$imgs=getimagesize($_FILES['img']['tmp_name']);

		list($width,$height)=$imgs;

		//	echo $width."<br />";

		//echo $height;

		//Image uploading code goes here.....

		//$allow=array('image/jpeg','image/jpg','image/png', 'image/pdf');

		$type=$_FILES['img']['type'];

		list($img,$typ)=explode('/',$type);
		$new_image_name1=$_FILES['img']['name'];
		//$new_image_name1 = 'img_' . date('Y-m-d-H-i-s') . '_' . uniqid().'.'.$typ;

		$srcpath=$_FILES['img']['tmp_name'];

		

		//$url=$_POST['url'];

		if($new_image_name1!='')

		{

		/*	if(in_array($type,$allow))

		 	 {

			 	 if($width<="960" && $height<="1500")

				  { */

						  if(is_uploaded_file($srcpath))

									{

										@mkdir("../upload_content_image",0777);

										$path="../upload_content_image/".$new_image_name1;

										$success=move_uploaded_file("$srcpath","$path");

											if($success)

											{

												$msg= "$addr/upload_content_image/".$new_image_name1;

											 $successflag=1;

											}

											else

											{

												$erromsg=" Error in uploading file";

													$successflag=0;

											}

									}

							else

								{

									$erromsg.=" Input file is not uploadable";

										$successflag=0;

								}

			/*	  }

				  else

					{

						$erromsg.=" Input image dimensions greater than 960*1500";

						$successflag=0;

					}

		 	}

			else

			{

				$erromsg.=" Input image file should be .jpg, .jpeg Format";

				$successflag=0;

			}*/

		}

		else

			{

				$erromsg.=" Input Image file does not exist";

				$successflag=0;

			}

	

}

else

	{ 

		//$erromsg = " Please upload image of yours"; 

		$successflag=0;

 	}





}



?>





