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
                        <a href="?command=show-dashboard&page=dashboard"
                           id="dashboard">Dashboard</a> |
                        <a href="?command=show-list&page=employee-list"
                           id="employee-list-link">Employees</a> |
                        <a href="?command=show-form&page=employee-form"
                           id="employee-form-link">Add Employee</a> |
                        <a href="?command=show-list&page=task-list"
                           id="task-list-link">Tasks</a> |
                        <a href="?command=show-form&page=task-form"
                           id="task-form-link">Add Task</a>
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
                                    <?php foreach ($tasks as $key => $task) : ?>
                                        <?php list($description, $estimate) = explode(',', $task); ?>
                                        <table width="100%"
                                               style="border-color: #91c8e4; border-width: 1px; border-style: solid">
                                            <tr>
                                                <td>
                                                    Description: <?php echo $description; ?><br>
                                                    Estimate: <?php echo $estimate; ?><br>
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
                        <p style="color: #48afe3">icd0007 Employee and Task Management Application</p>
                    </td>
                </tr>
            </table>
        </td>
        <td></td>
    </tr>
</table>
</body>
</html>