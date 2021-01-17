<?php
include 'database.php';
include 'validate.php';
$data = new Database;

$success = '';
if (isset($_POST['submit'])) {
  $title = validate($_POST['post_title']);
  $desc = validate($_POST['post_description']);

  $insert_array = array(
    'post_title' => mysqli_real_escape_string($data->con, $title),
    'post_desc' => mysqli_real_escape_string($data->con, $desc)
  );

  if ($data->insert("tbl_posts", $insert_array)) {
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
  <meta name="Description" content="Enter your description here" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="assets/styles/style.css">
  <title>PHP OOP CRUD</title>
</head>

<body>
  <h3 class="display-4 text-center">Create Post</h3>
  <div class="container">
    <form action="" method="post">
      <?php
      if (isset($_GET['edit'])) {
        if (isset($_GET["post_id"])) {
          $where = array(
            'post_id' => $_GET["post_id"]
          );
          $single_data = $data->select_where("tbl_posts", $where);
          foreach ($single_data as $post) {
      ?>
            <div class="form-group">
              <label for="post_title"><strong>Title</strong></label>
              <input type="text" name="post_title" id="post_title" class="form-control" placeholder="Enter post title" value="<?php echo $post['post_title']; ?>" />
              <small id="help_title" class="text-muted">Eg. PHP using OOP</small>
            </div>
            <div class="form-group">
              <label for="post_description">Description</label>
              <textarea name="post_description" id="post_description" class="form-control" placeholder="Enter post title"><?php echo $post['post_title']; ?></textarea>
              <small id="help_post" class="text-muted">Eg. Any message you would like to say</small>
            </div>
            <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
            <input type="submit" value="Submit" name="edit" class="btn btn-outline-secondary col-md-3" />
        <?php
          }
        }
      } else {
        ?>
        <div class="form-group">
          <label for="post_title"><strong>Title</strong></label>
          <input type="text" name="post_title" id="post_title" class="form-control" placeholder="Enter post title" />
          <small id="help_title" class="text-muted">Eg. PHP using OOP</small>
        </div>
        <div class="form-group">
          <label for="post_description">Description</label>
          <textarea name="post_description" id="post_description" class="form-control" placeholder="Enter post title"></textarea>
          <small id="help_post" class="text-muted">Eg. Any message you would like to say</small>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-outline-success col-md-3" />
        <span class="text-success">
        <?php } ?>
        <?php
        if (isset($success)) {
          echo "<br><br>" . $success;
        }
        ?>
        </span>
    </form>
  </div>
  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table table-hover table-bordered">
        <thead class="thead-inverse">
          <tr>
            <th>S. No</th>
            <th>Title</th>
            <th>Content</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- content goes here -->
          <?php
          $counter = 1;
          $post_data = $data->select("tbl_posts");
          foreach ($post_data as $post) {
            
          ?>
            <tr>
              <td width="5%"><?php echo $counter++; ?></td>
              <td width="15%"><?php echo $post["post_title"]; ?></td>
              <td width="50%"><?php echo substr($post["post_desc"], 0, 200); ?></td>
              <td width="20%"><span><a href="" class="btn btn-outline-primary">View</a></span>
                <span><a href="index.php?edit=1&post_id=<?php echo $post["post_id"]; ?>" class="btn btn-outline-info">Edit</a></span>
                <span><a href="#" id="<?php echo $post["post_id"]; ?>" class="btn btn-outline-danger">Delete</a></span>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
</body>

</html>