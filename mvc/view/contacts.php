<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Contacts</title>
        <style type="text/css">
            table.contacts {
                width: 100%;
            }
            
            table.contacts thead {
                background-color: #eee;
                text-align: left;
            }
            
            table.contacts thead th {
                border: solid 1px #fff;
                padding: 3px;
            }
            
            table.contacts tbody td {
                border: solid 1px #eee;
                padding: 3px;
            }
            
            a, a:hover, a:active, a:visited {
                color: blue;
                text-decoration: underline;
            }
            .pagination{
                margin-top: 5%;
                margin-left:40%;
                background-color: white;
                display: inline-block;
                
            }
            .pagination p{
                color: black;
                float: left;
                padding: 0px 16px;
                font-size: 20px;
                text-decoration: none;
            }
            .pagination a{
                color: black;
                float: left;
                padding: 8px 16px ;
                text-decoration: none;
                font-size: 20px;
            }
            .active{
                background-color: #4CAF50;
                color: white;

            }
            
        </style>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script>
    </head>
    <body>
        <div><a href="index.php?op=new">Add new contact</a></div>
        <table class="contacts" border="0" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><a href="?orderby=name">Name</a></th>
                    <th><a href="?orderby=phone">Phone</a></th>
                    <th><a href="?orderby=email">Email</a></th>
                    <th><a href="?orderby=address">Address</a></th>
                    <th>&nbsp;</th>
                    <th>type1</th>
                    <th>type2</th>
                    <th>SelectAll<input type=checkbox id=select_all ></th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach ($contacts as $contact): 
            ?>
                <tr>
                    <td><a href="index.php?op=show&id=<?php print $contact->id; ?>"><?php print htmlentities($contact->name); ?></a></td>
                    <td><?php print htmlentities($contact->phone); ?></td>
                    <td><?php print htmlentities($contact->email); ?></td>
                    <td><?php print htmlentities($contact->address); ?></td>
                    <td><a href="index.php?op=delete&id=<?php print $contact->id; ?>">delete</a></td>
                    <td><a href="index.php?op=modify&id=<?php print $contact->id; ?>">edit</a></td>
                    <td><a href="index.php?op=modify2&id=<?php print $contact->id; ?>&page=<?php if(isset($_GET["page"])){print $_GET["page"];} ?>">edit</a></td>
                    <td><input type=checkbox class="checkbox" id="ch" value="$contact->id" ></td>           
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table><br><br>
        <div>
            <?php


            ?>
        </div>
        <div class="pagination"> 
        <?php  

        if (isset($_GET["page"])) 
        {  
            $pn  = $_GET["page"]; 
        }  
        else 
        {  
          $pn=1;  
        } 
        $pagLink = "<p><font color=red>page...</font></p>";                         
        for ($i=1; $i<=$total_pages; $i++) { 
          if ($i==$pn) { 
              $pagLink .= "<a class='active' href='index.php?page=".$i."'>".$i."</a>";  
              
          }             
          else  {               
              $pagLink .= "<a href='index.php?page=".$i."'>".$i."</a>"; 
                
          } 
        };   
        echo $pagLink;   
      ?> 
      </div>
    </body>
</html>