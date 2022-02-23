<?php
session_start();
 if(!isset($_SESSION['login']) || !$_SESSION['login']==1){
   header('Location:login.php');
 }
 $id = $_SESSION['user_id']; 
 include('db/connect.php');
 $query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);

$categoryQuery="SELECT * FROM category";
$categoryResult=mysqli_query($conn, $categoryQuery);


?>

<html>

<head>
    <title>Home-Asmt News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <!-- this is navbar -->
    <?php include('include/nav.php');?>

    <div class="container">
        <div class="row">
            <?php include('include/left-nav.php') ?>


            <div class="col-8">
                <form action="db/addcategory.php" method="POST">
                    <label for="" style="background-color:black; color:white; padding:10px; width:100%;">Category
                        Title</label>
                    <div class="input-group">
                        <input type="text" name="category" class="form-control">
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="fa icon class" name="iconclass">
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color:black;">Save</button>
                </form>
                <?php include('include/message.php'); ?>

                <div class="row justify-content-md-center">
                    <?php
                    if(mysqli_num_rows($categoryResult)==0){
                      echo "<h3>No category found</h3>";
                    }
                    else { ?>
                    <table class="table">
                        <thead>
                            <th>Title</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                         <?php while($row=mysqli_fetch_assoc($categoryResult)){ ?>
                            <tr>
                                <td><?php echo $row['title'] ?></td>
                                <td> <i class="fas fa-trash-alt" style="color:red;"></i> | E</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <?php  } ?>

                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/a74baea4b2.js" crossorigin="anonymous"></script>
    
</body>

</html>