<?
class Config_model extends CI_Model
{

function getConfigName($name)
{
	$row = $this->db->where('name', $name) -> get('config' )-> row();
	return $row ? $row -> value : '';
}

function sendMsg($name, $mail, $txt)
{
	$name = mb_convert_encoding($name, 'koi8-r', 'utf8');

	$result = true;
	$mail2=explode(",", $mail);
	foreach ($mail2 as $mail1):

		$mail1 = trim($mail1);
		$A_admin_mail = $mail1;
		$A_admin_mail_CC = array($mail1);
		$A_admin_mail_From = $mail1;

		$headers  =   'MIME-Version: 1.0' . "\r\n";
		$headers   .= 'Content-type: text/plain;
		charset= utf8' . "\r\n";
		$headers .=
			'From: ' .$name.' <info@'.str_replace("www.","",getenv("HTTP_HOST")).'>'. "\r\n";
		@$result = $result && mail($A_admin_mail,$name , $txt, $headers);
	endforeach;
	return $result;
}
// =========================================


function sendActivationEmail()
{

	$query = $this->db->query("SELECT * FROM `users` WHERE `login`='".$this->input->post("login")."'");
	$result = $query->result();

	if (count($result) > 0) {
		//$userCode = $this->code;
		$code = $result[0]->code;

	} else {

		return false;
	}

	$text = "Запрос активации партнера\n".
		"\nФИО : ".$this->input->post("fio").
		"\nЛогин : ".$this->input->post("login").
		"\ne-mail : ".$this->input->post("mail").
		"\nТелефон : ".$this->input->post("phone").
		"\n\n Сообщение : ".$this->input->post("mess")."\n";

	$name = $_SERVER['HTTP_HOST']."| Register";
	$text_mail = $text."\n\nСсылка для активации: ".base_url()."auth/activation/".urlencode($this->input->post("login"))."/".$code;

	//$mail = $this->input->post("mail");
	$mail = $this->getConfigName('mail');
	return $this->sendMsg($name, $mail, $text_mail);

}

}