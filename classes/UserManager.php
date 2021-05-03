<?php
class UserManager
{
	public function __construct()
	{

	}
	
	public function getUserInfo(IUser $user)
	{
		$info = $user->getInfo();
		if (empty($info) || !is_array($info)) {
			return "";
		}
		$res = '';
		foreach ($info as $key => $value) {
			$res .= "{$key}: $value <br/>\n";
		}
		if ($res) {
			$res = "user-type: " . get_class($user) . "<br>\n" . $res;
			$res .= "<br>\n";
		}
		return $res;
	}
}