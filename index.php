<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <title>PHP CRUD</title>
</head>
<body>
<?php require_once'process.php'; ?> 

<?php 

if(isset($_SESSION['message'])):
?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message'])

    ?>
    </div>
    <?php endif ?>

<div class="container">
<?php
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    
    //pre_r($result); 
?>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                        class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>"
                        class="btn btn-danger">Delete</a>
                    </td>
                </tr>
             <?php endwhile; ?>
            </table>
        </div>


<?php
        function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }

?>
    <div class="row justify-content-center">
        <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-group">
                <label for="name">Name</label>
                 <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter your name" class="form-control">
            </div>
    
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" value="<?php echo $location; ?>" placeholder="Enter your location" class="form-control">
            </div>

            <div class="form-group">
                <?php 
                 if($update == true):
                ?>
                <button type="submit" name="update" class="btn btn-info">Update</button>
                    <?php else: ?>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
    </div>
</body>
</html>