<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php print htmlentities($title) ?>
        </title>
    </head>
    <body>
        <?php
        if ( $errors ) {
            print '<ul class="errors">';
            foreach ( $errors as $field => $error ) {
                print '<li>'.htmlentities($error).'</li>';
            }
            print '</ul>';
        }
        ?>
        <form method="POST" action=""><br><br>
            <div style="background-color: lightgreen;margin-left :30%;margin-right :30%;">
                <center>
            <table>
            <tr><td><label for="name">Name:</label></td>
            <td><input type="text" name="name" value="<?php print htmlentities($name); if($flag==0)print $contact->name; ?>"/>
           </td></tr>
            
            <tr><td><label for="phone">Phone:</label></td>
            <td><input type="text" name="phone" value="<?php print htmlentities($phone); if($flag==0)print $contact->phone; ?>"/></td>
            </tr>

            <tr><td><label for="email">Email:</label></td>
            <td><input type="text" name="email" value="<?php print htmlentities($email); if($flag==0)print $contact->email; ?>" /></td>
            </tr>

            <tr><td><label for="address">Address:</label></td>
            <td><textarea name="address"><?php print htmlentities($address); if($flag==0)print $contact->address; ?></textarea></td>
            </tr>

            <tr><td><input type="hidden" name="form-submitted" value="1" /></td>
            <td><input type="submit" value="Submit" name="submit" /></td></tr>
            </table>
            </center>
            </div>
        </form>
        
    </body>
</html>
