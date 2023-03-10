<?php
namespace App\Models;

use Core\Orm\Select;

class Offices
{
	public function getOffices(): array
	{
		$select = new Select();
		$select->setTableName("offices");
		$select->execute();
		$offices = $select->fetch();

		$select->setFields(["COUNT(*) AS total"]);
		$select->setLimit(0);
		$select->setOffset(0);
		$select->execute();
		$total = $select->fetch();
		return [
			"total" => $total[0]["total"],
			"list" => $offices
		];
	}
}
