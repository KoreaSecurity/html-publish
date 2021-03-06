<?php
/**
* Description of BaseDAO
* @author bugnote@funhansoft.com
* @date 2013-08-07
* @copyright (c)funhansoft.com
* @license http://funhansoft.com/license
* @version 0.2.1
*/
final class ExceptionParam extends Exception {
    public function __construct($message, $code = 0) {
        parent::__construct($message, $code);
		
		$log = new Logging();
		$log->lfile('../WebApp/Debug/NBExceptionParam.txt');
		$log->lwrite(__CLASS__ . ": [{$this->code}]: {$this->message}\n".', '.$_SERVER['REMOTE_ADDR']);
		$log->lclose();
    }
	
    // 객체의 사용자 문자열 표현
    public function __toString() {
        return Utils::jsonEncode(array('result'=>$this->code,'code'=>$this->code,'message'=>$this->message));
    }
}

?>
