<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee form</title>
</head>

<body id="employee-form-page">
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
                                <td width="100%" style="background-color: #91c8e4; padding: 5px">Add
                                    Employee
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table align="center">
                                        <tr>
                                            <td>
                                                <form method="post" action="?">
                                                    <div>
                                                        <label for="firstName">First name:</label>
                                                        <input type="text" name="firstName" id="firstName">
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <label for="lastName">Last name:</label>
                                                        <input type="text" name="lastName" id="lastName">
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <label for="selection">Position:</label>
                                                        <select id="selection">
                                                            <option></option>
                                                            <option value="specialist">Specialist</option>
                                                            <option value="manager">Manager</option>
                                                            <option value="head">Head</option>
                                                            <option value="administrator">Administrator</option>
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <label for="picture">Picture:</label>
                                                        <button id="picture">Choose File</button>
                                                        No file chosen
                                                    </div>
                                                    <br>
                                                    <div align="right">
                                                        <button type="submit" name="submitButton"
                                                                value="employee">Save
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
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