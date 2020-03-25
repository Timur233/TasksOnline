<?php

?>
<!DOCTYPE html>
<html class="gt-ie8 gt-ie9 not-ie pxajs">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Онлайн задачник</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/main.js"></script>

</head>
<body>

<?php require "themplates/header.php"; ?>

<section class="taskSection py-5">
    <div class="container">
        <h4>Список задач:</h4>
        <div class="orderBy mt-4">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="sort">Сортировать</label>
                    <select class="form-control" id="selectSort">
                        <option value="id DESC">Выбрать</option>
                        <option value="name ASC">По имени, А-Я</option>
                        <option value="name DESC">По имени, Я-А</option>
                        <option value="email ASC">По email, А-Я</option>
                        <option value="email DESC">По email, Я-А</option>
                        <option value="status ASC">По статусу, по возростанию</option>
                        <option value="status DESC">По статусу, по убыванию</option>
                    </select>
                </div>
            </div>
        </div>
        <table class="table mt-2">
            <thead class="thead-info">
            <tr>
                <th scope="col">Имя</th>
                <th scope="col">E-mail</th>
                <th scope="col">Задача</th>
                <th scope="col" class="text-right">Статус</th>
                <?php if ($_COOKIE['user']=='admin') {?>
                <th scope="col" class="text-right">Действие</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody id="tasks">
            </tbody>
        </table>
        <div id="pagination">
            <nav aria-label="...">
                <ul class="pagination pagination-sm paginationItems"></ul>
            </nav>
        </div>
    </div>
</section>
<section class="newTaskSection bg-light py-5">
    <div class="container">
        <h4>Создать задачу</h4>
        <form id="ajaxForm" method="post" class="mt-4">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nameInput">Имя</label>
                    <input type="text" class="form-control formInput" name="name" id="nameInput">
                </div>
                <div class="form-group col-md-6">
                    <label for="emailInput">E-mail</label>
                    <input type="email" class="form-control formInput" name="email" id="emailInput">
                </div>
            </div>
            <div class="form-group">
                <label for="taskInput">Задача</label>
                <textarea class="form-control" name="task" id="taskInput"></textarea>
            </div>
            <input hidden="hidden" type="text" value="0" name="status">
            <input hidden="hidden" type="text" value="0" name="edit">
            <input hidden="hidden" type="text" value="<?php echo $_GET['Id']; ?>" name="idInput">
            <input hidden="hidden" type="text" id="sortInput" name="sort" value="id ASC">
            <input hidden="hidden" type="text" value="insertTask" name="modInput">
            <button type="submit" class="btn btn-info sendButton">Отправить</button>

            <div id="resultForm" class="mt-3"></div>
        </form>
    </div>
</section>

<?php require "themplates/footer.php"; ?>

</body>
</html>
