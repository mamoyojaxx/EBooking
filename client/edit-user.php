
    <?php
    
    

    //import database
    include("../connection.php");



    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $oldemail=$_POST["oldemail"];
       $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $id=$_POST['id00'];
        
        if ($password==$cpassword){
            $error='3';
            $aab="select client.clientid from client inner join webuser on client.clientemail=webuser.email where webuser.email='$email';";
            $result= $database->query($aab);
           
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["clientid"];
            }else{
                $id2=$id;
            }
            

            if($id2!=$id){
                $error='1';
                
            }else{

                
                $sql1="update client set clientemail='$email',clientname='$name',clientpassword='$password',clienttel='$tele' where clientid=$id ;";
                $database->query($sql1);
                echo $sql1;
                $sql1="update webuser set email='$email' where email='$oldemail' ;";
                $database->query($sql1);
                echo $sql1;
                
                $error= '4';
                
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        //header('location: signup.php');
        $error='3';
    }
    

    header("location: settings.php?action=edit&error=".$error."&id=".$id);
    ?>
    
 