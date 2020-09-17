<?php 
  
// Define needed credentials. 
define("HOST", "localhost");   
define("USER", 'root');   
define("PASS", ''); 
define("DB", 'mvc-crud');   
  
// Establish Connection. 
$conn = mysqli_connect(HOST, USER, PASS, DB)  
        or die ('Error connecting to Database.');   
  
  
?> 
<!DOCTYPE html> 
<html> 
  <head> 
    <title>ProGeeks Cup 2.0</title> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" 
     href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
  </head> 
  <body> 
  <?php 
         
    $limit = 5;     
    if (isset($_GET["page"])) {  
      $pn  = $_GET["page"];  
    }  
    else {  
      $pn=1;  
    };   
  
    $start_from = ($pn-1) * $limit;   
  
    $sql = "SELECT * FROM contacts LIMIT $start_from, $limit";   
    $rs_result = mysqli_query ($conn,$sql);  
  
  ?> 
  <div class="container"> 
    <br> 
    <div> 
      <h1>ProGeeks Cup 2.0</h1> 
      <p>This page is just for demonstration of  
                 Basic Pagination using PHP.</p> 
      <table class="table table-striped table-condensed table-bordered"> 
        <thead> 
        <tr> 
          <th width="10%">Id</th> 
          <th>Name</th> 
          <th>Phone</th> 
          <th>Email</th> 
          <th>Address</th>
        </tr> 
        </thead> 
        <tbody> 
        <?php   
          while ($row = mysqli_fetch_array($rs_result)) {  
                  // Display each field of the records.  
        ?>   
        <tr>   
          <td><?php echo $row["id"]; ?></td>   
          <td><?php echo $row["name"]; ?></td> 
          <td><?php echo $row["phone"]; ?></td> 
          <td><?php echo $row["email"]; ?></td>
          <td><?php echo $row["address"]; ?></td>                                        
        </tr>   
        <?php   
        };   
        ?>   
        </tbody> 
      </table> 
      <ul class="pagination"> 
      <?php   
        $sql = "SELECT COUNT(*) FROM contacts";   
        $rs_result = mysqli_query($conn,$sql);   
        $row = mysqli_fetch_row($rs_result);   
        $total_records = $row[0];   
          
        // Number of pages required. 
        $total_pages = ceil($total_records / $limit);   
        $pagLink = "";                         
        for ($i=1; $i<=$total_pages; $i++) { 
          if ($i==$pn) { 
              $pagLink .= "<li class='active'><a href='practise2.php?page="
                                                .$i."'>".$i."</a></li>"; 
          }             
          else  { 
              $pagLink .= "<li><a href='practise2.php?page=".$i."'> 
                                                ".$i."</a></li>";   
          } 
        };   
        echo $pagLink;   
        mysqli_close($conn);
      ?> 
      </ul> 
    </div> 
  </div> 
  </body> 
</html> 