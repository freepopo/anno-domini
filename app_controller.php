<?
class AppController extends Controller {
	
	var $helpers = array('Javascript','Html','Ajax','Calendar');
	
	function checkAdmin() {
		if (!$this->Session->check('User')) {
			$this->Session->setFlash('You must be logged in first.');
			$this->redirect(array('controller'=>'users','action'=>'admin_login'));
		}
	}
}
?>