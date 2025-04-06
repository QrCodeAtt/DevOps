<?php
define('isActive', '1');
define('isAccessible','enabled');
include_once('dbconfig.php');

//if(!defined('QRCODE') || constant('QRCODE') !== 'active'){ die ('Sure! You missed a step.'); }
class QRCodeManager extends dbSetup{
	
	function __construct(){ $this->qrCodeMaker(); }
	
	function qrCodeMaker(){
		require_once('phpqrcode/qrlib.php');
		$code = isset($_POST['stid'])?$this->getValidInput($_POST['stid']):'invalid';
		QRcode::png($code, 'images/'.$code.'.png');
		echo "<img src='images/{$code}.png' />";
	}

}
$launch = new QRCodeManager();

?>