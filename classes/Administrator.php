<?php
class Administrator extends User implements IUser
{
	private $permissions;
		
	public function __construct(int $id, string $name, string $permissions)
	{
		parent::__construct($id, $name);
		$this->permissions = $permissions;
	}
	
	public function getInfo()
	{
		$info = parent::getInfo();
		$info['permissions'] = $this->permissions;
		return $info;
	}
}