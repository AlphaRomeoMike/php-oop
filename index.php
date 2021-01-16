<?php
  include 'database.php';
  include 'validate.php';
  $data = new Database;

  $success = '';
  if(isset($_POST['submit'])) {
    $title = validate($_POST['post_title']);
    $desc = validate($_POST['post_description']);

    $insert_array = array (
      'title' => mysqli_real_escape_string($data->con, $title),
      'description' => mysqli_real_escape_string($data->con, $desc)
    );

    if($data->insert("tbl_posts", $insert_array)) {
      $success = 'Data inserted';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<link rel="stylesheet" href="assets/styles/style.css">
<title>PHP OOP CRUD</title>
</head>
<body>
    <h3 class="display-4 text-center">INSERT DATA</h3>
    <div class="container">
        <form action="" method="post">
            <div class="form-group">
              <label for="post_title"><strong>Title</strong></label>
              <input type="text" name="post_title" id="post_title" class="form-control" placeholder="Enter post title" />
              <small id="help_title" class="text-muted">Eg. PHP using OOP</small>
            </div>
            <div class="form-group">
              <label for="post_description">Description</label>
              <input type="text" name="post_description" id="post_description" class="form-control" placeholder="Enter post title" />
              <small id="help_post" class="text-muted">Eg. Any message you would like to say</small>
            </div>
            <input type="submit" value="Submit" name="submit" class="btn btn-outline-warning align-center">
            <span class="text-success">
            <?php
              if(isset($success)) {
                echo "<br><br>" .$success;
              }
            ?>
            </span>
        </form>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
</body>
</html>