<?php
class Db{
    public static $tablename;
    public static $executeData;
    public static $where='';
    public static $pdo;  //这是一个对象，应该是默认什么都不给
    public static $stmt;
    public static $order='';
    public static $limit='';
    public static $field='*';

    //判断是否在where组内()
    public $isGrouping = false;
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
    public  function where(Array $condition,$andOrNot='AND'){
        $where ='' ;
        if (!empty($condition)){

            //拼接where
            $whereArray=[];
            $executeData =[];
            foreach ($condition as $key => $value){

                if (strtolower($value[1])=='between'){
                    $whereArray[] ="$value[0] $value[1] ? AND ?";
                    $executeData[] =$value[2][0];
                    $executeData[] =$value[2][1];
                }
                else if (strtolower($value[1]) == 'in'){
                    $str = rtrim(str_repeat('?,',count($value[2])),',');
                    $whereArray[] = "$value[0] $value[1] ($str)";
                    foreach ($value[2] as $vv){
                        $executeData[] =$vv;
                    }

                }
                else{
                    $whereArray[] ="$value[0] $value[1] ?";
                    $executeData[] =$value[2];
                }
            }
            if ($andOrNot !== 'NOT' && $andOrNot !== 'ORNOT'){
                $where = implode(" $andOrNot ",$whereArray);
            }
            else {
                if ($andOrNot =='ORNOT'){
                    $where = 'NOT (' . implode(" OR ", $whereArray) . ')';
                }
                else{
                    $where = 'NOT (' . implode(" AND ", $whereArray) . ')';
                }
            }


            if (isset(self::$executeData )){
                self::$executeData =array_merge(self::$executeData,$executeData);
            }
            else{
                self::$executeData =$executeData;
            }
        }
//        $this ->buildWhere($where,$andOrNot);
        $this ->buildWhere($where);

        return $this;
    }
    public function whereNull($name){
        $where = "$name is null";
        $this ->buildWhere($where);
        return $this;
    }
    public function whereNotNull($name){
        $where = "$name is not null";
        $this ->buildWhere($where);
        return $this;
    }
    public function buildWhere($where,$andOrNot='AND'){
        $oldwhere = self::$where;
        if ($where !== ''){

            if(strpos($oldwhere,'WHERE')===false){
                if($oldwhere  !== ''){
                    $where = 'WHERE '.$oldwhere.' '.$andOrNot.' '.$where;
                }
                $where = 'WHERE '.$where;
            }
            else{
                $where =$oldwhere. ' '.$andOrNot.' ' .$where;
            }

            self::$where =$where;
        }
    }
    public function whereOr(Array $condition){
       return $this->where($condition,'OR');
    }
    public function whereNot(Array $condition){
        return $this->where($condition,'NOT');
    }
    public function whereOrNot(Array $condition){
        return $this->where($condition,'ORNOT');
    }
    //order
    public function order($orderby){
        self::$order ="order by".$orderby;
        return $this;
    }
    public function limit($num1,$num2=null){
        self::$limit =" limit ".(is_null($num2)?$num1:"$num1,num2");
        return $this;
    }
    public function field(string $fields){
        self::$field = $fields;
        return $this;
    }
    //获取凭借sql的语句
    public function getLastSql(){
        return self::$stmt->queryString;
    }
    public function count(){
        $totalArray = $this->field('count(*) as total')->find();
        return $totalArray;
    }
    public function select(){
        try{
            $sql ="select ". self::$field ." from ". self::$tablename ." ".self::$where." ".self::$order." ".self::$limit;
//        echo $sql;
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
        }catch(PDOException $e){
            throw new Exception("查询异常：".$e->getMessage());
        }

    }
    public function find(){
        $result =$this ->limit(1)->select();
        return isset($result[0])?$result[0]:false;
    }
}


$quertObject = Db::table('users')->field("id,username,password")->order('id DESC');
$result =$quertObject->select();
$sql = $quertObject->getLastSql();
echo $sql;
//var_dump($result);

//    Db::table('表格名称')->where([])->select();
//Db::table('表格名称')->where([])->limit(10)->select();
//Db::table('表格名称')->where([])->limit(20,10)->select();
//Db::table('表格名称')->where([])->find();
//Db::table('表格名称')->where([])->instert();
//Db::table('表格名称')->where([])->update();
//Db::table('表格名称')->where([])->delete();


?>