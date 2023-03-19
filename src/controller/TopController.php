<?php

class TopController extends Controller
{
    public function index()
    {

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../config');
        $dotenv->load();

        $test = "";

        $dbDatabase = $_ENV['DB_DATABASE'];
        $dbHost     = $_ENV['DB_HOST'];
        $dbUsername = $_ENV['DB_USERNAME'];
        $dbPassword = $_ENV['DB_PASSWORD'];

        try{
            $dsn = "mysql:dbname=$dbDatabase;host=$dbHost;";
            $user = $dbUsername;
            $password =$dbPassword;

            $dbh = new PDO($dsn,$user,$password);
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        if(isset($_POST['shuffle'])){
            $sql1 = 'SELECT name FROM menus WHERE category_id = 1 ORDER BY RAND() LIMIT 1';
            $sql2 = 'SELECT name FROM menus WHERE category_id = 2 ORDER BY RAND() LIMIT 1';
            $stmt1 = $dbh->query($sql1);
            $results[] = $stmt1->fetch(PDO::FETCH_ASSOC);
            if($_POST['mode'] === '1'){
                $stmt2 = $dbh->query($sql2);
                $results[] = $stmt2->fetch(PDO::FETCH_ASSOC);
            }
        }

        include __DIR__ . '/../views/index.php';
    }
}
