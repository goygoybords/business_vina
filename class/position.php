<?php
	class Position
	{
		private $id;
		private $position;
		private $status;

		public function getId()
		{
			return $this->id;
		}

		public function setId($id)
		{
			$this->id = $id;
		}


		public function getPosition()
		{
			return $this->position;
		}

		public function setPosition($position)
		{
			$this->position = $position;
		}


		public function getStatus()
		{
			return $this->status;
		}

		public function setStatus($status)
		{
			$this->status = $status;
		}
	}
?>