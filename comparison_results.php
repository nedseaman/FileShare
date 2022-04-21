<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();

    if(!$_SESSION['username']) {
        header("Location: login.html");
    }
    
    $similarity = $_SESSION['similarity'];
    ?>
    <head>
        <title>PHP File System</title>
        <link rel="stylesheet" href="styles.css"/>
        <!--[if lt IE 9]>
        <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <h1>Results</h1>
        <?php echo "<p>The similarity between the two files you chose is $similarity percent</p>"?>
    </body>
</html>