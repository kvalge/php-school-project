<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task list</title>
</head>

<body id="task-list-page">
<table border="0" width="100%">
    <tr>
        <td></td>
        <td width="700px">
            <table border="0" width="100%">
                <tr>
                    <td>
                        <?php include 'hw2/menu.html' ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" style="border-color: #91c8e4; border-width: 1px; border-style: solid">
                            <tr>
                                <td width="100%" style="background-color: #91c8e4; padding: 5px">Tasks</td>
                            </tr>
                            <tr>
                                <td width="90%">
                                    <?php foreach ($tasks as $key => $value) : ?>
                                        <table width="100%"
                                               style="border-color: #91c8e4; border-width: 1px; border-style: solid">
                                            <tr>
                                                <td>
                                                    Description: <?php echo $key; ?><br>
                                                    Estimate: <?php echo $value; ?><br>
                                                </td>
                                                <td align="right"><a href="">Edit</a></td>
                                            </tr>
                                        </table>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="color: #48afe3">
                            <?php include 'hw2/footer.html' ?>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
        <td></td>
    </tr>
</table>
</body>
</html>