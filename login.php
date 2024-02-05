<?
    session_start();
    
    header("Content-Type: text/html; charset=UTF-8");
    
    $page = basename($_SERVER["PHP_SELF"]);//현재경로

    $ori_uid = "hello";//기존 회원아이디
    $in_uid = $_GET["uid"];//입력된 회원아이디
    $ori_upw = "123";//기존 비밀번호
    $in_upw = $_GET["upw"];//입력된 비밀번호
    
    $logout = $_GET["logout"];//로그아웃

    if($in_uid!="" && $in_upw!=""){
        if($ori_uid==$in_uid && $ori_upw==$in_upw){
            $_SESSION["userchk"] = "Y";
        }else{
            echo "<script>alert('올바르지 않은 비밀번호 입니다.');history.back(-1);</script>";
            exit();
        }
    }

    if($logout=="Y"){
        unset($_SESSION["userchk"]);
        session_destroy();
        echo "<script>location.href='".$page."';</script>";
    }
?>
<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>간단한 로그인기능 php페이지-GET</title>
    <script>
        function login(){
            var uid = loginfrm.uid.value;
            var upw = loginfrm.upw.value;
            location.href="<?=$page?>?uid="+uid+"&upw="+upw;
        }
        function logout(){
            location.href='<?=$page?>?logout=Y';
        }
    </script>
</head>
<body>
    <? if($_SESSION["userchk"]=="Y"){ ?>
        어서오세요, <?=$in_uid?>님. 로그인되었습니다.
        <button onclick="logout();">logout</button>
    <? }else{ ?>
    <form action="./login.php" name="loginfrm" method="get">
        <label for="uid">아이디</label>
        <input type="text" id="uid" name="uid"><br>
        <label for="upw">비밀번호</label>
        <input type="password" id="upw" name="upw"><br>
        <input type="button" onclick="login();" value="로그인">
    </form>
    <?} ?>
</body>
</html>