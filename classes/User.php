<?php
class User implements IUser
{
		private $id;
		private $name;
		
		public function __construct(int $id, string $name)
		{
			$this->id   = $id;
			$this->name = $name;
		}
		
		public function getInfo()
		{
			return [
				'id'   => $this->id,
				'name' => $this->name,
			];
		}
}