<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    if(!$_SESSION['username']) {
        header("Location: login.html");
    }
    $user_directory="/srv/".$_SESSION['username'];
    ?>
    <head>
        <title>PHP File System</title>
        <link rel="stylesheet" href="styles.css"/>
        <!--[if lt IE 9]>
        <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <h1>Home</h1>
        <table>
            <thead>
                <tr>
                    <th>Filename</th>
                    <th>Display</th>
                    <th>Delete</th>
                    <th>Download</th>
                    <th>Compare</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach(scanDir($user_directory) as $file):
                if($file == "." || $file == "..") {
                    continue;
                } else { ?>
                <tr>
                    <td><?= htmlentities($file); ?></td>
                    <td>
                        <form action="display.php" method="GET">
                            <input type="hidden" name="filename" value=<?= $file; ?>/>
                            <input type="submit" value="Display"/>
                        </form>
                    </td>
                    <td>
                        <form action="delete.php" method="GET">
                            <input type="hidden" name="filename" value=<?= $file; ?>/>
                            <input type="submit" value="Delete"/>
                        </form>
                    </td>
                    <td>
                        <form action="download.php" method="GET">
                            <input type="hidden" name="filename" value=<?= $file; ?>/>
                            <input type="submit" value="Download"/>
                        </form>
                    </td>
                    <td>
                        <form action="comparison_selection.php" method="GET">
                            <input type="hidden" name="filename" value=<?= $file; ?>/>
                            <input type="submit" value="Compare"/>
                        </form>
                    </td>
                </tr>
            <?php }
            endforeach;
            ?>
            </tbody>
        </table>
        <form action="upload.html">
            <input type="submit" value="Upload File"/>
        </form>
        <form action="create_user.html">
            <input type="submit" value="Create User"/>
        </form>
        <form action="logout.php">
            <input type="submit" value="Logout"/>
        </form>
    </body>
</html>