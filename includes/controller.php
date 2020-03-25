<?php
require "db.php";
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$DB = new dataBase();

if ($_POST['modInput'] == 'insertTask') {
    $name = strip_tags($_POST['name']);
    $email = strip_tags($_POST['email']);
    $task = strip_tags($_POST['task']);
    $status = strip_tags($_POST['status']);
    $edit = strip_tags($_POST['edit']);

    $DB->insertTask($name, $email, $task, $status, $edit);
    echo json_encode("Задача успешно создана!");
    exit;
}

if ($_POST['modInput'] == 'editTask') {
    $id = $_POST['id'];
    $name = strip_tags($_POST['name']);
    $email = strip_tags($_POST['email']);
    $task = strip_tags($_POST['task']);
    $status = strip_tags($_POST['status']);
    $edit = strip_tags($_POST['edit']);

    $DB->updateTask($id, $name, $email, $task, $status, $edit);
    echo json_encode("Задача успешно отредактирована!");
    exit;
}

if ($_POST['modInput'] == 'selectTask') {

    $sort = $_POST['sort'];
    $offset = $_POST['offset'];

    $rows = $DB->selectTasks($sort, $offset);
    $result = '';
    while ($row = $rows->fetch_assoc()) {
        $result .= '<tr>';
        $result .= '<th scope="row">' . $row['name'] . '</th>';
        $result .= '<td>' . $row['email'] . '</td>';
        $result .= '<td>' . $row['task'] . '</td>';

        $result .= '<td class="text-right">';
        switch ($row['status']) {
            case 0:
                $result .= '<a href="#" class="badge badge-pill badge-secondary">Ожидание</a>';
                break;
            case 1:
                $result .= '<a href="#" class="badge badge-pill badge-primary">Выполнение</a>';
                break;
            case 2:
                $result .= '<a href="#" class="badge badge-pill badge-success">Выполнено</a>';
                break;
        }
        if ($_COOKIE['user']=='admin') {
            if ($row['edit'] == 1) {
                $result .= '<a href="#" class="badge badge-pill badge-warning ml-1 mt-1">Отредактирована</a>';
            }
        }
        $result .= '</td>';

        if ($_COOKIE['user']=='admin') {
            $result .= '<td class="text-right"><a class="badge badge-pill badge-info mb-2" href="/edit.php?id='.$row['id'].'">Редактировать</a><br><select style="width: 120px" class="changeStatus custom-select custom-select-sm float-right" data-id="'.$row['id'].'"><option value="">Статус</option><option value="0">Ожидание</option><option value="1">Выполнение</option><option value="2">Выполнено</option></select></td>';
        }

        $result .= '</tr>';
    }

    echo $result;
    exit;

}

if ($_POST['modInput'] == 'updateStatus') {

    $id = $_POST['id'];
    $status = $_POST['status'];

    $DB->updateStatus($id, $status);

    exit;

}

if ($_POST['modInput'] == 'paginationTask') {

    $rows = $DB->paginationTasks();
    $pages = ceil($rows/3);
    $result = '';
    $offset = 0;

    for ($i=1; $i <= $pages; $i++){
        $offset = ($i*3)-3;
        if ($i==1){
            $result .= '<li class="page-item"><a class="first-page page-link pagination-link active" data-offset="'.$offset.'" href="#">'.$i.'</a></li>';
        } else {
            $result .= '<li class="page-item"><a class="page-link pagination-link" data-offset="'.$offset.'" href="#">'.$i.'</a></li>';
        }
    }

    echo $result;
    exit;
}

if ($_POST['modInput'] == 'loginUser'){
    if ($_POST['login'] == 'admin' && $_POST['pass'] == '123'){

    } else {
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
    }
    exit;
}

?>