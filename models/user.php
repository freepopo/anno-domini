<?
class User extends AppModel {
	var $name = 'User';
	
	function login($user=array()) {
		if (!$user) {
			return false;
		} else {
			$record = $this->findByUsername($user['User']['username']);
			if (!$record || $record['User']['password'] != $user['User']['password']) {
				return false;
			} else {
				return true;
			}
		}
	}
}
?>