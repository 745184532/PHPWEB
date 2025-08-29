<?php
    // 判断字符串是否为空
    function isEmpty($str){
        return $str === null || empty($str);
    }
    // 判断字符串是否小于6
    function strlenMin($str){
        return strlen($str) < 6;
    }

    foreach (["username", "password"] as $key => $value){
      if(!isset($_POST[$value])){
          $message =$value.'为必填值';
          break;
      }
      if (isEmpty($_POST[$value])){
          $message =$value."不能为空";
          break;
      }
      if ($value === 'password' && strlenMin($_POST[$value])){
          $message =$value."不能小于6";
          break;
      }
    }
    //0 是正确的，非0就是错误
    $responseData = [
        "code" => 0,
        "msg" =>$message,
        "data" =>[]
    ];
    if($message !== ""){
        $responseData["code"]= 1;
    }
//    print_r(json_encode($_POST,JSON_UNESCAPED_UNICODE));
?>