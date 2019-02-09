<?php 


$NameError = "";
$EmailError = "";
$WebsiteError = "";

	
	if(isset($_POST['Submit'])){

		if(empty($_POST['Name'])){
			$NameError = "Name is required";
		}
		else{
			$Name = Test_User_Input($_POST["Name"]);		
			if(!preg_match("/^[A-Za-z\. ]*$/", $Name)){
				$NameError = "Invalid input"; 
			}
		}
		if(empty($_POST['Mail'])){
			$EmailError ="Mail is required";
		}
		else{
			$Mail = Test_User_Input($_POST["Mail"]);
			if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/", $Mail)){
				$EmailError = "Inavaid Email"; 
			}		

		}
		if(empty($_POST['Web'])){
			$WebsiteError = "Website is required";
		}
		else{
			$Web = Test_User_Input($_POST["Web"]);
			if(!preg_match("/(https:|ftp:|http:|wap:)\/\/+[A-Za-z.\-_\/?\$=&\#\~`!]+\.[A-Za-z.\-_\/?\$=&\#\~`!]*/", $Web)){
				$WebsiteError = "Invalid input"; 
			}

		}

		if(!empty($_POST['Name']) && !empty($_POST['Mail']) && !empty($_POST['Web'])){	
			
			if((preg_match("/^[A-Za-z\. ]*$/", $Name)) && (preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/", $Mail)) && (preg_match("/(https:|ftp:|http:|wap:)\/\/+[A-Za-z.\-_\/?\$=&\#\~`!]+\.[A-Za-z.\-_\/?\$=&\#\~`!]*/", $Web)))  //no need to put ==true
				
			{
					$emailTo = "jazibakram@gmail.com";
					$subject = "Contact Form";
					$headers = "From: jazibakram@gmail.com";
					$body = 
								"Name  :" .$_POST["Name"]  .
								"Email :" .$_POST["Mail"] .
								"Phone :" .$_POST["Phone"] .
								"Website :" .$_POST["Web"] .
								"Comment :" .$_POST["Comment"] ;
							

					if(mail($emailTo, $subject, $body, $headers)){
						echo "Mail sent successfully !";							
					}
					else{
						echo "Mail has not been sent yet !";
					} 

			}
			else{
				echo "Please correct your form again ! ! !";	
			}	
		}
		
		else{
			echo "Please complete your form again ! ! !";	
		}

	}
	
	

	function Test_User_Input($Data){
		return $Data;
	}

?>



<link href="style.css" rel="stylesheet" type="text/css"> 



<div class="container">  
  <form id="contact" action="contact.php" method="post">
    <h3>Quick Contact</h3>
    <h4>Contact us today, and get reply with in 24 hours!</h4>
    


    *<br>

    <fieldset>
      <input placeholder="Your name" type="text" Name="Name" tabindex="1">
    </fieldset>
    
    <?php echo $NameError; ?> <br>

    *<br>

    <fieldset>
      <input placeholder="Your Email Address" type="text" Name="Mail" tabindex="2">
    </fieldset>
    
    <?php echo $EmailError; ?> <br>

    <br>

    <fieldset>
      <input placeholder="Your Phone Number" type="text" Name="Phone" tabindex="3">
    </fieldset>
    

    *<br>
    
    <fieldset>
      <input placeholder="Web Site starts with http://" type="text" Name="Web" tabindex="4">
    </fieldset>
    
    <?php echo $WebsiteError; ?> <br>

    <br>
    
    <fieldset>
      <textarea placeholder="Type your Message Here...." Name="Comment"tabindex="5"></textarea>
    </fieldset>
    


    <br>
    
    <fieldset>
      <button type="Submit" Name="Submit" id="contact-submit" data-submit="...Sending">Submit</button>
    </fieldset>
  </form>
 
  
</div>