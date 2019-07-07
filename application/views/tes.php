<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="form-group">
        <label for="sel1">Select list:</label>
        <select class="form-control" id="sel1">
            
        </select>
    </div>
</div>
<script>
$(document).ready(function(e){
  var data=null;
  $.get('<?php echo base_url('website/tes-request') ?>',function(html){
    $('#sel1').html(html)
    console.log($('#sel1 option:selected').attr('tes'))
  })
  // console.log(window.localStorage)
});
</script>
</body>
</html>