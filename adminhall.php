<?php 
if ($auth==true){
	echo "
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-'>
		<link href='style.css' rel='stylesheet'>
		<title>�������</title>
	</head>
	<body>
		<header>
			<h1>�������� ��������</h1>
		</header>
		<form method='post' action='CreateEvent.php' enctype='multipart/form-data'>
		<table cellpadding='14'>
			<tr>
				<td rowspan='6'>
					<p><input style='height: 30px; width: 400px' type='text' name='name_event' placeholder='�������� ��������' maxlength='200' required /></p>
					<textarea style='height: 150px; width: 400px' name='description' placeholder='�������� ��������' maxlength='10000' required ></textarea>
					<p>��������� �������� <input type='file' accept='image/jpeg' name='downimg'/></p>
				</td>
				<td>���� � �����</br><input type='date' name='date' placeholder='����' required /><input type='time' name='time' placeholder='����' required /></td>
			</tr>
			<tr>
				<td><input type='number' name='ticket_low' placeholder='������ �� ' required /></td>
			</tr>
			<tr>
				<td><input type='number' name='ticket_mid' placeholder='������ ������� ����' required /></td>
			</tr>
			<tr>
				<td><input type='number' name='ticket_high' placeholder='������ ��' required /></td>
			</tr>
			<tr>
				<td>
				<input type='submit' name='relize' value='�������'/>
				</td>
			</tr>
			<tr>
				<td>
				<input type='reset' name='relize' value='��������'/>
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>";
}
else {
	echo "�������� ���������� ";
}

?>