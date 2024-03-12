<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task form</title>
</head>

<body id="task-form-page">
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
                        <table border="0" width="100%"
                               style="border-color: #91c8e4; border-width: 1px; border-style: solid">
                            <tr>
                                <td width="100%" style="background-color: #91c8e4; padding: 5px">Add
                                    Employee
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table border="0" align="center">
                                        <tr>
                                            <td>
                                                <div style="width: 500px">
                                                    <form method="POST" action="?">
                                                        <br>
                                                        <div>
                                                            <label for="description">Description</label>
                                                            <textarea id="description" name="description" rows="3"
                                                                      cols="40"></textarea>
                                                        </div>
                                                        <br>
                                                        <div>
                                                            <label>Estimate</label>
                                                            <input type="radio" name="estimate" value="1"> 1
                                                            <input type="radio" name="estimate" value="2"> 2
                                                            <input type="radio" name="estimate" value="3"> 3
                                                            <input type="radio" name="estimate" value="4"> 4
                                                            <input type="radio" name="estimate" value="5"> 5
                                                        </div>
                                                        <br>
                                                        <div>
                                                            <label for="selection">Assigned to</label>
                                                            <select id="selection">
                                                                <option></option>
                                                                <option value="o1">Option 1</option>
                                                                <option value="o1">Option 2</option>
                                                            </select>
                                                        </div>
                                                        <br>
                                                        <div align="right">
                                                            <button type="submit" name="submitButton"
                                                                    value="task">Save
                                                            </button>
                                                        </div>
                                                        <br>
                                                    </form>
                                                </div>
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