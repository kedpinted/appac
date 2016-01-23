<?php include("1.php");?>

<!DOCTYPE html>
<html>
<head>

    <title>5555</title>


<script type = "text/javascript" src = "http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>


$(function(){

$('#submit').click(function(){
 $('#container').append('<img src = "images/loader.gif" alt="Currently loading" id = "loading" />');

    var comment=$("#comment").val();
    var pos_x=$("#pos_x").val();
    var pos_y=$("#pos_y").val();
    var time=$("#time").val();


     $.ajax({

        url: '1.php',
        type: 'POST',
        data: 'comment =' + comment + '&pos_x=' + pos_x + '&pos_y=' + pos_y + '&time=' + time ,


        success: function(result){
             $('#response').remove();
             $('#container').append('<p id = "response">' + result + '</p>');
             $('#loading').fadeOut(500, function(){
                 $(this).remove();

             });

        }

     });         

    return false;

});


});

</script>
</head>

<body>
<!--we have our html form here where user information will be entered-->
<form action='1.php' method='post' border='0'>
<div id = "container">  <br>
    <label>Comment:            </label>    <input type='text' id="comment" name='comment' /><br>  <br>
    <label>Pos_x:         </label>    <input type='text' id="pos_x" name='pos_x' /><br><br>
    <label>Pos_y:         </label>    <input type='text' id="pos_y" name='pos_y' /><br><br>
    <label>Time:         </label>    <input type='text' id="time" name='time' /><br><br>

    <input type='hidden' name='action' value='create' />
    <input type='submit' value='Submit' id="submit" value = "send feedBack"/>
    <input type="reset" value="Reset" class="reset-org">

    <a href='index.php'>Back to index</a> 
    </body>
</html>