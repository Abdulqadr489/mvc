<?php 

namespace thephp\phpmvccore\db;


use thephp\phpmvccore\Application;

class Database
{
    public \PDO $pdo;
    public function __construct(array $config)
    {
        $dsn=$config['dsn'] ?? '';
        $user=$config['user'] ?? '';
        $password=$config['password'] ?? '';
        

        $this->pdo = new \PDO($dsn,$user,$password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION);  
             
    }

    public function applyMigrations(){

        $this->createMigrationTable();
        $appliedMigrations=$this->getApplyMigration();

        $newMigrations=[];
        $files=scandir(Application::$ROOT_DIR.'/migrations');
        $toAppliedMigrations=array_diff($files,$appliedMigrations);
    var_dump($appliedMigrations);
        foreach ($toAppliedMigrations as $migration)
        {
            if($migration === '.' || $migration==='..')
            {
                continue;
            }
            require_once   Application::$ROOT_DIR.'/migrations/'.$migration;

            $classname=pathinfo($migration,PATHINFO_FILENAME);
            $instance = new $classname;
            $this->log("Applying $migration".PHP_EOL);
            $instance->up();
            $this->log("Applying $migration".PHP_EOL);
            $newMigrations[]=$migration;
        }
        if(!empty($newMigrations))
        {
            $this->saveMigrations($newMigrations);
        }
        else
        {
            $this->log("All migrations are applied");
        }
    }

    public function createMigrationTable()
    {
        $this ->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP   
            )Engine=INNODB;");
    }

    public function getApplyMigration()
    {
       $statement= $this->pdo->prepare("SELECT migration from migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations (array $migrations)
    {

       $str=implode(",",array_map(fn($m) => "('$m')",$migrations));

       $statement=$this->pdo->prepare("INSERT INTO migrations (migration) VALUES
        $str
        ");
    $statement->execute();
    }
    public function  prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    public  function log($message)
    {
        echo '['.date('Y-m-d').'] - ' . $message .PHP_EOL;
    }
}


?>