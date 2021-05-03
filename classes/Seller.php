<?php
class Seller extends User implements IUser
{
	private $earnings_balance;
	private $product_count;
	
	public function __construct(int $id, string $name, float $earnings_balance, int $product_count)
	{
		parent::__construct($id, $name);
		$this->earnings_balance = $earnings_balance;
		$this->product_count    = $product_count;
	}
	
	public function getInfo()
	{
		$info = parent::getInfo();
		$info['earnings_balance'] = $this->earnings_balance;
		$info['product_count']    = $this->product_count;
		return $info;
	}
}