<?php
header("Content-Type: text/html; charset=utf-8");
$email = htmlspecialchars($_POST["email"]);
$name = htmlspecialchars($_POST["name"]);
$tel = htmlspecialchars($_POST["tel"]);

$check = is_array($_POST['check']) ? $_POST['check'] : array();
$check = implode (', ', $check );

$refferer = getenv('HTTP_REFERER');
$date=date("d.m.y"); // число.месяц.год  
$time=date("H:i"); // часы:минуты:секунды 
$myemail = "DimaSmirn44@yandex.ru";

$tema = "Тема письма админу";
$message_to_myemail = "Текст письма:
<br><br>
Имя: $name<br>
E-mail: $email<br>
Телефон: $tel<br>
Чек-бокс: $check<br>
Источник (ссылка): $refferer
";

mail($myemail, $tema, $message_to_myemail, "From: Sitename <SITENAME> \r\n Reply-To: SITENAME \r\n"."MIME-Version: 1.0\r\n"."Content-type: text/html; charset=utf-8\r\n" );


$tema = "Тема письма клиенту";
$message_to_myemail = "
Текст письма<br>


";
$myemail = $email;
mail($myemail, $tema, $message_to_myemail, "From: SITENAME <SITENAME> \r\n Reply-To: SITENAME \r\n"."MIME-Version: 1.0\r\n"."Content-type: text/html; charset=utf-8\r\n" );


$f = fopen("leads.xls", "a+");
fwrite($f," <tr>");    
fwrite($f," <td>$email</td> <td>$name</td> <td>$tel</td>   <td>$date / $time</td>");   
fwrite($f," <td>$refferer</td>");    
fwrite($f," </tr>");  
fwrite($f,"\n ");    
fclose($f);


?>