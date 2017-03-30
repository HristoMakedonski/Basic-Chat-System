<?php  include './db.php' ;?>

<html>
    <head>
        <title>Chat System in PHP</title>
        <link rel="stylesheet" href="style.css" media="all"/>
        <script>
        function ajax(){
            
           var req = new XMLHttpRequest();
            
           req.onreadystatechange = function(){
    if(req.readyState == 4 && req.status == 200)
    {
     document.getElementById('chat').innerHTML = req.responseText;    
    }           
                      
    }
    req.open('GET','chat.php',true);
    req.send();
            
    }
    setInterval(function(){ajax(),1000});
        
        
        
        </script>
    </head>
    
    <body onload="ajax();">
        <div id="container">
            <div id="chat_box">
                <div id='chat'></div>
                <?php 
                
                $query = "SELECT * FROM chat ORDER BY id DESC";
                $run = $db->query($query);
                while($row = $run->fetch_array()):
                
                ?>
                <div id="chat_data">
                    <span style="color: green"><?php echo $row['name'];?></span> :
                    <span style="color: brown"><?php echo $row['msg'];?></span>
                    <span style="color: blue; float: right;"><?php  echo formatDate($row['date']);?></span>
                </div>
                <?php endwhile; ?>
            </div>
            <form action="index.php" method="post">
                <input type="text" name="name" placeholder="enter name"/>
                <textarea name="msg" placeholder="enter message"></textarea>
                <input type="submit" name="submit" value="Send it"/>
            
            </form>
         <?php 
         if(isset($_POST['submit'])){
             
             $name = $_POST['name'];
             $msg = $_POST['msg'];
             
             $insert = "INSERT INTO chat (name,msg) values ('$name','$msg')";
             $run = $db->query($insert);
             
             if($run){
                 echo "<embed loop='false' src='chat.wav' hidden='true' autoplay='true'>";
             }
             
         }
         
         
         
         
         
         ?>   
            
        </div>
        
        
        
    </body>    
    
</html>