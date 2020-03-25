<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//Класс CurlConnect
class dataBase
{
    public $DBQuery;

    public function __construct()
    {

        $link = mysqli_connect('srv-pleskdb44.ps.kz:3306', 'smart_tasks', 'frXQXrtkx1', 'smartst3_task_bd');
        $this->DBQuery = $link;

    }

    public function selectTasks($sort, $offset){

        $stmt = $this->DBQuery->prepare("SELECT * FROM Tasks ORDER BY ".$sort." LIMIT 3 ".$offset); //LIMIT 3 OFFSET 3
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();

        return $result;

    }

    public function selectTasksForEdit(){

        $stmt = $this->DBQuery->prepare("SELECT * FROM Tasks");
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();

        return $result;

    }

    public function paginationTasks(){

        $stmt = $this->DBQuery->prepare("SELECT * FROM Tasks");
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows;

        $stmt->close();

        return $result;

    }

    public function insertTask($name, $email, $task, $status, $edit){

        $stmt = $this->DBQuery->prepare("INSERT INTO Tasks(name, email, task, status, edit) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $name, $email, $task, $status, $edit);
        $stmt->execute();

        $stmt->close();

    }

    public function updateTask($id, $name, $email, $task, $status, $edit){

        $stmt = $this->DBQuery->prepare("UPDATE Tasks SET name=?, email=?, task=?, status=?, edit=? WHERE id=?");
        $stmt->bind_param('sssiii', $name, $email, $task, $status, $edit, $id);
        $stmt->execute();

        $stmt->close();

    }

    public function updateStatus($id, $status){

        $stmt = $this->DBQuery->prepare("UPDATE Tasks SET status=? WHERE id=?");
        $stmt->bind_param('ii', $status, $id);
        $stmt->execute();

        $stmt->close();

    }

    public function __destruct()
    {

        mysqli_close($this->DBQuery);

    }

}

?>
