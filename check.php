<?php
require 'decipher_key.php';
$code = date('mdYhis');
echo $code;
$encrypt = Decipher::encrypt_string($code);
echo $encrypt;

?>