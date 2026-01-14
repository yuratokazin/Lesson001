<?php
# для вывода сообщений об ошибках
ini_set('display_errors',0);
error_reporting(E_ALL|E_STRICT);

class webPoll {
const POLL = true;
const VOTES = false;
# количество пикселей для 1% на прямоугольнике вывода
public $scale = 2;
# вопрос и ответы
public $question = '';
public $answers = array();
# разметка HTML
private $header = '<form class="webPoll" method="post"
action="%src%">
<input type="hidden" name="QID"
value="%qid%" />
<h4>%question%</h4>
<fieldset><ul>';
private $center = '';
private $footer = "\n</ul></fieldset>%button%\n</form>\n";
private $button = '<p class="buttons"><button type="submit"
class="vote">Голосовать!</button></p>';
# идентификатор вопроса
private $md5 = '';
/**
* --* Таблица, которая содержит вопросы и список ответов, является
аргументом.
* Создаем HTML либо для списка голосования, либо для списка
результатов в зависимости
* от того, голосовал пользователь или нет
*/
public function __construct($params) {
$this->question = array_shift($params);
$this->answers = $params;
$this->md5 = md5($this->question);
$this->header = str_replace('%src%',
$_SERVER['SCRIPT_NAME'], $this->header);
$this->header = str_replace('%qid%', $this->md5, $this>header);
$this->header = str_replace('%question%', $this->question,
$this->header);
# отдельный куки для каждого индивидуального набора
голосования
isset($_COOKIE[$this->md5]) ? $this->poll(self::VOTES) :
$this->poll(self::POLL);
}
private function poll($show_poll) {
$replace = $show_poll ? $this->button : '';
$this->footer = str_replace('%button%', $replace, $this>footer);
if(!$show_poll) {
$results = webPoll::getData($this->md5);
$votes = array_sum($results);
}
for( $x=0; $x<count($this->answers); $x++ ) {
$this->center .= $show_poll ? $this->pollLine($x) :
$this->voteLine($this->answers[$x],$results[$x],$votes);
}
echo $this->header, $this->center, $this->footer;
}
private function pollLine($x) {
isset($this->answers[$x+1]) ? $class = 'bordered' : $class =
'';
return "
<li class='$class'>
<label class='poll_active'>
<input type='radio' name='AID' value='$x' />
{$this->answers[$x]}
</label>
</li>
";
}
private function voteLine($answer,$result,$votes) {
$result = isset($result) ? $result : 0;
$percent = round(($result/$votes)*100);
$width = $percent * $this->scale;
return "
<li>
<div class='result'
style='width:{$width}px;'>&nbsp;</div>{$percent}%
<label class='poll_results'>
$answer
</label>
</li>
";
}
/**
static function vote() {
if(!isset($_POST['QID']) || !isset($_POST['AID']) ||
isset($_COOKIE[$_POST['QID']])) {
return;
}
$dbh = new PDO('sqlite:bryanskpivo.db');
$dbh->setAttribute( PDO::ATTR_ERRMODE,
PDO::ERRMODE_EXCEPTION );
try {
$sth = $dbh->prepare( "INSERT INTO poll_results
(QID,AID,votes) values (:QID, :AID, 1)" );
$sth->execute(array($_POST['QID'],$_POST['AID']));
}
catch(PDOException $e) {
# Ошибка 23000 означает, что ключ уже существует,
поэтому надо использовать UPDATE!
if($e->getCode() == 23000) {
try {
$sth = $dbh->prepare( "UPDATE poll_results SET
votes = votes+1 WHERE QID=:QID AND AID=:AID");
$sth>execute(array($_POST['QID'],$_POST['AID']));
}
catch(PDOException $e) {
webPoll::db_error($e->getMessage());
}
}
else {
webPoll::db_error($e->getMessage());
}
}
# Вводим значение для $_COOKIE для подтверждения того, что
пользователь проголосовал.
if($sth->rowCount() == 1) {
setcookie($_POST['QID'], 1, time()+60*60*24*365);
$_COOKIE[$_POST['QID']] = 1;
}
}
static function getData($question_id) {
try {
$dbh = new PDO('sqlite:poll_results');
$dbh->setAttribute( PDO::ATTR_ERRMODE,
PDO::ERRMODE_EXCEPTION );
$STH = $dbh->prepare('SELECT AID, votes FROM
poll_results WHERE QID = ?');
$STH->execute(array($question_id));
}
catch(PDOException $e) {
# Ошибка при получении данных, просто отправляем пустой
набор данных
return array(0);
}
while($row = $STH->fetch()) {
$results[$row['AID']] = $row['votes'];
}
return $results;
}
/*
* С сообщением об ошибке можно сделать что-нибудь. Например,
отправить e-mail
* или сделать запись в логе
*/
static function db_error($error) {
echo "Ошибка базы данных. $error";
exit;
}
}
?>
