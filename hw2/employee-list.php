<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee list</title>
</head>
<body id="employee-list-page">
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
                                <td colspan="2" width="40%" style="background-color: #91c8e4; padding: 5px">Employees
                                </td>
                            </tr>
                            <tr>
                                <td width="90%">
                                    <?php foreach ($employees as $key => $employee) : ?>
                                    <?php list($first_name, $last_name) = explode(',', $employee); ?>
                                    <table width="100%"
                                           style="border-color: #91c8e4; border-width: 1px; border-style: solid">
                                            <tr>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>pilt</td>
                                                            <td align="">
                                                                <?php echo $first_name; ?> <?php echo $last_name; ?><br>
                                                                Ametikoht
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td align="right"><a href="">Edit</a></td>
                                            </tr>
                                    </table>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                            <br>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php include 'hw2/footer.html' ?>
                    </td>
                </tr>
            </table>
        </td>
        <td></td>
    </tr>
</table>
</body>
</html>