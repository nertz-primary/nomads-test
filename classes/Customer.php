<?php
class Customer extends User implements IUser
{
	private $balance;
	private $purchase_count;
	
	public function __construct(int $id, string $name, float $balance, int $purchase_count)
	{
		parent::__construct($id, $name);
		$this->balance = $balance;
		$this->purchase_count = $purchase_count;
	}
	
	public function getInfo()
	{
		$info = parent::getInfo();
		$info['balance'] = $this->balance;
		$info['purchase_count'] = $this->purchase_count;
		return $info;
	}
}