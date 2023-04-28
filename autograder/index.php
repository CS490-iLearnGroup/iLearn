<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body style="background-color:powderblue;">
    <div class="container" style="margin-top:50px">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-7">
        <?php
        include_once('config.php');
        if(isset($_POST['rate'])){
            $essay = $_POST['essay'];
            ilearn_grader($essay);


        } 
        ?>
        <div class="card" style="margin-top:10px;">
        <div class="card-body">
        <form action="index.php" method="post">

        <div class="form-group">
            <label for="essay">Essay:</label>
            <textarea name="essay" class="form-control" id="essay" rows="13"></textarea>
        </div>
        <div class="d-grid gap-2" style="margin-top:10px;">
         <button name="rate" class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
        </div>
       </div>
    </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>