<?php 
if ($auth==true){
	echo "
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-'>
		<link href='style.css' rel='stylesheet'>
		<title>Админка</title>
	</head>
	<body>
		<header>
			<h1>Создание концерта</h1>
		</header>
		<form method='post' action='CreateEvent.php' enctype='multipart/form-data'>
		<table cellpadding='14'>
			<tr>
				<td rowspan='6'>
					<p><input style='height: 30px; width: 400px' type='text' name='name_event' placeholder='Название концерта' maxlength='200' required /></p>
					<textarea style='height: 150px; width: 400px' name='description' placeholder='Описание концерта' maxlength='600' required ></textarea>
					<p>Загрузить картинку <input type='file' accept='image/jpeg' name='downimg'/></p>
				</td>
				<td>Дата и время</br><input type='date' name='date' placeholder='дата' required /><input type='time' name='time' placeholder='дата' required /></td>
			</tr>
			<tr>
				<td><input type='number' name='ticket_low' placeholder='билеты от ' required /></td>
			</tr>
			<tr>
				<td><input type='number' name='ticket_mid' placeholder='билеты средней цены' required /></td>
			</tr>
			<tr>
				<td><input type='number' name='ticket_high' placeholder='билеты до' required /></td>
			</tr>
			<tr>
				<td>
				<input type='submit' name='relize' value='Создать'/>
				</td>
			</tr>
			<tr>
				<td>
				<input type='reset' name='relize' value='Сбросить'/>
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>";
}
else {
	echo "Страница недоступна ";
}

?>
