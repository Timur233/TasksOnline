<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require "includes/db.php";

$DB = new dataBase();
$rows = $DB->selectTasksForEdit();

while ($row = $rows->fetch_assoc()) {
    if ($row['id'] == $_GET['id']){
        $name = $row['name'];
        $email = $row['email'];
        $task = $row['task'];
        $status = $row['status'];
        $edit = $row['edit'];
    }
}

?>
<!DOCTYPE html>
<html class="gt-ie8 gt-ie9 not-ie pxajs">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Онлайн задачник</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/main.js"></script>

</head>
<body>

<?php require "themplates/header.php"; ?>

<section class="editTaskSection bg-light py-5">
    <div class="container">
        <h4>Редактировать задачу</h4>
        <form id="ajaxForm" method="post" class="mt-4">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nameInput">Имя</label>
                    <input type="text" class="form-control formInput" name="name" id="nameInput" value="<?php echo $name; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="emailInput">E-mail</label>
                    <input type="email" class="form-control formInput" name="email" id="emailInput" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="taskInput">Задача</label>
                <textarea class="form-control" name="task" id="taskInput"><?php echo $task; ?></textarea>
            </div>
            <input hidden="hidden" type="text" value="<?php echo $status; ?>" name="status">
            <input hidden="hidden" type="text" value="<?php echo $_GET['id']; ?>" name="id">
            <input hidden="hidden" type="text" value="<?php echo $edit; ?>" name="edit" id="editInput">
            <input hidden="hidden" type="text" value="editTask" name="modInput" value="editTask">
            <button type="submit" class="btn btn-info sendEditButton">Отправить</button>

            <div id="resultForm" class="mt-3"></div>
        </form>
    </div>
</section>

<?php require "themplates/footer.php"; ?>

<script>
    $('#taskInput').change(function(){
        $('#editInput').val('1');
    });
</script>

</body>
</html>
