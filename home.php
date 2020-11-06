<?php
include("Config/Connection.php");
include("Controllers/verify_submit.php");

//check if user logged in or not
if (!isset($_SESSION['user_id'])) {
    header("Location:index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="CSS/style.css">
    <title>Synchronizer Token Patterns</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="head" align="center" style="padding-top: 20px;">
        <div class="col-12">
            <h2 style="font-size: 50px;">Test Synchronizer Token </h2>
        </div>
    </div>
    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">
                <form action="" method="post">
                    <h3>Submit Your Comment Here!</h3>
                    <div class="form-group">
                        <?php echo $msg; ?>
                        <label>Comment:</label>
                        <input type="text" class="form-control" name="comment" id="firstName" />
                    </div>

                    <div class="form-group">
                            <!-- CSRF Hidden -->
                        <input type='hidden' name='Csrf_Token' id='Csrf_Token' value="">

                    </div>

                    <button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block">
                        Submit
                    </button>
                    <a class="btn btn-danger btn-block" href="logout.php">Log out</a>
                </form>
            </div>
        </div>
    </div>
</body>
<!-- Ajax Request for token -->
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'Controllers/csrf.php',
            type: 'post',
            async: false,
            data: {
                //validate request with the server side
                'req_csrf': '<?php echo $_SESSION["user_id"] ?>'
            },
            success: function(data) {
                //set returned token to hidden field value
                document.getElementById("Csrf_Token").value = data;
                $("#Csrf_Token").text(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log("Error on Ajax call :: " + xhr.responseText);
            }
        });
    });
</script>

</html>