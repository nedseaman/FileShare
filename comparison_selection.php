<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    if(!$_SESSION['username']) {
        header("Location: login.html");
    }
    $user_directory="/srv/".$_SESSION['username'];
    $file1 = str_replace("/", "", $_GET['filename']);
    ?>
    <head>
        <title>PHP File System</title>
        <link rel="stylesheet" href="styles.css"/>
        <!--[if lt IE 9]>
        <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <h1>Select 2nd file for comparison</h1>
        <table>
            <thead>
                <tr>
                    <th>Filename</th>
                    <th>Compare</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach(scanDir($user_directory) as $file):
                if($file == "." || $file == ".." || $file == $file1) {
                    continue;
                } else { ?>
                <tr>
                    <td><?= htmlentities($file); ?></td>
                    <td>
                        <form action="comparison.php" method="GET">
                            <input type="hidden" name="file1" value=<?= $file1; ?>/>
                            <input type="hidden" name="file2" value=<?= $file; ?>/>
                            <input type="submit" value="Compare"/>
                        </form>
                    </td>
                </tr>
            <?php }
            endforeach;
            ?>
            </tbody>
        </table>
    </body>
</html>