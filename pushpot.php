<?php
session_start();
if(!isset($_SESSION['push-username'])){
    echo "<script>alert('用户未登录，请先登录！')</script>";
   header("Location: index.php");
    exit();
}
//?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="https://img-baldfish.oss-cn-hangzhou.aliyuncs.com/logo.png">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <script>
        function showOrder(str)
        {
            if (str=="")
            {
                document.getElementById("txtHint").innerHTML="";
                return;
            }
            if (window.XMLHttpRequest)
            {
                // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
                xmlhttp=new XMLHttpRequest();
            }
            else
            {
                // IE6, IE5 浏览器执行代码
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","php/getsite_mysql.php?q="+str,true);
            xmlhttp.send();
        }
    </script>
</head>
    <body>
    <div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-pushpot p-l-55 p-r-55 p-t-65 p-b-54">
                <div class='flex-col-l p-t-25'>
                    <p style='text-align: right;margin-left: 20px'>
                        <a href='php/push_userpage.php' class='txt2'><img src='images/return.jpg' height=15px>返回</a>
                    </p>
                </div>
                <br>
                <form action="php/submit.php" enctype="multipart/form-data" id="pushform" method="post" class="pushpot-form" onsubmit="return checkPushpot()">
                    <table border="1" width="960px">
                        <tr>
                            <td colspan="4"><b>下单表</b></td>
                        </tr>
                        <tr>
                            <td width="240"><b>活动名称</b></td>
                            <td colspan="3"><input name="name" type="text" placeholder="请输入活动名称"></td>
                        </tr>
                        <tr>
                            <td width="240"><b>活动部门</b></td>
                            <td width="240">
                                <select name="department" id="department" onchange="showOrder(this.value)">
                                    <option value="">选择一个部门：</option>
                                    <option value = 9>主席部长团</option>
                                    <option value = 1>秘书处</option>
                                    <option value = 2>发展创新部</option>
                                    <option value = 3>宣传与网络中心</option>
                                    <option value = 4>权益服务部</option>
                                    <option value = 5>文艺部</option>
                                    <option value = 6>学术部</option>
                                    <option value = 7>体育部</option>
                                    <option value = 8>对外交流部</option>
                                </select>
                            </td>
                            <td width="240"><b>订单类型</b></td>
                            <td width="240">
                                <select name="potType" id="potType">
                                    <option value = "">选择订单类型：</option>
                                    <option value = "推文">推文</option>
                                    <option value = "传单">传单</option>
                                    <option value = "海报">海报</option>
                                    <option value = "易拉宝">易拉宝</option>
                                    <option value = "电子屏">电子屏</option>
                                    <option value = "摄影">摄影</option>
                                    <option value = "院网文">院网文</option>
                                    <option value = "other">其它(请在备注中说明)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="240"><b>订单序号</b></td>
                            <td width="240"><div id="txtHint">订单序号</div></td>
                            <td width="240"><b>对接人</b></td>
                            <td width="240"><input name="contactPerson" type="text" placeholder="请输入对接人姓名"></td>
                        </tr>
                        <tr>
                            <td width="240"><b>对接人联系方式</b></td>
                            <td width="240"><input name="phone" type="text" placeholder="请输入对接人手机号"></td>
                            <td width="240"><b>对接人QQ</b></td>
                            <td width="240"><input name="QQ" type="text" placeholder="请输入对接人QQ"></td>
                        </tr>
                        <tr>
                            <td width="240"><b>下单时间</b></td>
                            <td width="240">
                                <?php
                                date_default_timezone_set("Asia/Shanghai");
                                echo date("Y/m/d");
                                ?>
                            </td>
                            <td width="240"><b>DDL</b></td>
                            <td width="240"><input name="ddl" type="date" placeholder="请输入DDL"></td>
                        </tr>
                        <tr>
                            <td width="240"><b>活动地点</b>（可选）</td>
                            <td colspan="3"><input name="place" type="text" placeholder="请输入活动地点，可不填，摄影单必须填写！"></td>
                        </tr>
                        <tr>
                            <td width="240"><b>订单要求</b></td>
                            <td colspan="3"><input name="requirement" type="text" placeholder="请输入订单要求，无要求则写无"></td>
                        </tr>
                        <tr>
                            <td width="240"><b>审核人</b></td>
                            <td colspan="3"><input name="reviewPerson" type="text" placeholder="请输入审核人姓名，无审核人则写无"></td>
                        </tr>
                        <tr>
                            <td width="240"><b>备注</b>（可选）</td>
                            <td colspan="3"><input name="comment" type="text" placeholder="请输入备注，可不填"></td>
                        </tr>
                    </table>
                    <code id="errText"></code>
                    <div class="container-login100-form-btn" id="submitbtn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button name="submit" value="pushpot" id="submit" class="login100-form-btn">下 一 步</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="js/main.js"></script>
    <script src="js/checker.js"></script>
    </body>
    <footer>
        <div style="width:300px;margin:0 auto; padding:20px 0;">
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=33010602011602" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;"><img src="" style="float:left;"/><p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;">浙公网安备 33010602011602号</p></a>
        </div>
    </footer>
</html>