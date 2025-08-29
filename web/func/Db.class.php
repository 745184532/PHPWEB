<?php
class Db{
    public static $tablename;
    public static $executeData;
    public static $where='';
    public static $pdo;  //这是一个对象，应该是默认什么都不给
    public static $stmt;
    //这个方法是用于连接数据库时调用
    public function __construct(){
        self::connect();
        self::setAttr();
    }
    //用于捕获异常的
    private static function setAttr(){
        self::$pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    //数据库连接方法
    public static function connect(){ //连接数据库的方法
        $DS = DIRECTORY_SEPARATOR;  //这个是识别系统的斜杠
        $config = require __DIR__.$DS."..".$DS."conf".$DS."database.php";
        $dbms= $config["dbms"];
        $host= $config["host"];
        $user= $config["user"];
        $pass= $config["pass"];
        $dbName=$config["dbName"];

        $dsn="$dbms:host=$host;dbname=$dbName;charset=utf8";
        try{
            self::$pdo =new PDO($dsn,$user,$pass); //初始化一个pdo对象

        }catch (PDOException $e){
            die ("数据库连接错误错误！：".$e ->getMessage());
        }
    }
    public static function table($tablename){
        self::$tablename=$tablename;
        return new self();
    }
    public  function where(Array $condition){
        $where ='' ;
        if (!empty($condition)){
            //拼接where
            $whereArray=[];
            $executeData =[];
            foreach ($condition as $key => $value){
                $whereArray[] ="$value[0] $value[1] ?";
                $executeData[] =$value[2];
            }
            $where = implode(' AND ',$whereArray);

            if (isset(self::$executeData )){
                self::$executeData =array_merge(self::$executeData,$executeData);
            }
            else{
                self::$executeData =$executeData;
            }
        }

        $oldwhere = self::$where;
        if ($where !== ''){

            if(strpos($oldwhere,'WHERE')===false){
                if($oldwhere  !== ''){
                    $where = 'WHERE '.$oldwhere.' AND '.$where;
                }
                $where = 'WHERE '.$where;
            }
            else{
                $where =$oldwhere. ' AND ' .$where;
            }

            self::$where =$where;
        }
        return $this;
    }
    public function select(){
        $sql ="select * from ". self::$tablename ." ".self::$where."";
        echo $sql;
        self::$stmt = self::$pdo -> prepare($sql);

        if(isset(self::$executeData)){
            self::$stmt -> execute(self::$executeData);
        }
        else{
            self::$stmt -> execute();
        }
        $result = self::$stmt -> fetchAll(PDO::FETCH_ASSOC);
        self::$stmt ->closeCursor();
        return $result;
    }
}

$result = Db::table('users')->where([
    ["username","<>","123"],

])->where([
//    ["id",">=","1"],
])->select();

var_dump($result);

//    Db::table('表格名称')->where([])->select();
//Db::table('表格名称')->where([])->limit(10)->select();
//Db::table('表格名称')->where([])->limit(20,10)->select();
//Db::table('表格名称')->where([])->find();
//Db::table('表格名称')->where([])->instert();
//Db::table('表格名称')->where([])->update();
//Db::table('表格名称')->where([])->delete();


?>