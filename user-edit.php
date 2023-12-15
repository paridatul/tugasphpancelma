<?php
require_once('required/database.php');

$id = $_GET['id'];

$sql = 'SELECT * FROM user WHERE id=?';
$statement = $connectDb->prepare($sql);
$statement->bind_param('i', $id);
$statement->execute();
$person = $statement->get_result()->fetch_object();

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = 'UPDATE user SET username=?, password=?, email=? WHERE id=?';
    $statement = $connectDb->prepare($sql);
    $statement->bind_param('sssi', $username, $password, $email, $id);

    if ($statement->execute()) {
        header("Location: user.php");
    }
}


require 'header.php';
?>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update User</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="username">Name</label>
          <input value="<?= $person->username; ?>" type="text" name="username" id="username" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" value="<?= $person->password; ?>" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-info">Update</button>
        </div>
        <div class="form-group">
            <a href="user.php" class="btn btn-warning">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>