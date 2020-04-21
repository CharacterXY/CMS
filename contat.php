
<?php  include "includes/db.php";     ?>
<?php  include "includes/header.php"; ?>
<?php  include "admin/functions.php"; ?>

<?php

// the message 

$body = "First line of text Second line of text";

// use wordwrap() if lines are longer then 70 characters
$body = wordwrap($body,70);

//send email







if(isset($_POST['sendmail'])){

    $to = "marko.junakovic89@gmail.com";
    $header = "From " .$_POST['email'];
    $subject = wordwrap($_POST['subject'], 70);
    $body = $_POST['body'];
    $name = $_POST['name'];

/*     $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
    $headers .= "From: {$name} <{$from}>\r\n";
    $headers .= "Reply-To: <{$from}>\r\n";
    $headers .= "Subject: {$subject}\r\n";
    $headers .= "X-Mailer: PHP/".phpversion()."\r\n"; */

   if(mail($to, $subject , $body, $header)){
       echo "mail send";
   } else {
       echo "Faild";
   }




   

   
   
    

   
     
}  
    
   



?>
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contat</h1>

                    <form role="form" action="" method="post" id="login-form" autocomplete="off">

                    <div class="form-group">
                            <label for="email" class="sr-only">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter you're name">
                        </div>
                      
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="subjet" class="sr-only">Subject</label>
                            <input type="subject" name="subject" id="subject" class="form-control" placeholder="Enter your Subject">
                        </div>

                        <div class="form-group">
                             <p>Poruka :</p>
                            <label for="subjet" class="sr-only">Subject</label>
                            <textarea  name="body" id="body"  cols="10" rows="10" class="form-control" placeholder="Enter your message"></textarea>
                        </div>
                
                        <button type="submit" name="sendmail" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Send">Send</button>
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
   
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
