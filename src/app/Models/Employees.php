<?php
namespace App\Models;

use Core\Orm\Insert;
use Core\Orm\Select;

class Employees
{
	public function getEmployees(): array
	{
		$select = new Select();
		$select->setTableName("employees");
		$select->execute();
		$employees = $select->fetch();

		$select->setFields(["COUNT(*) AS total"]);
		$select->setLimit(0);
		$select->setOffset(0);
		$select->execute();
		$total = $select->fetch();
		return [
			"total" => $total[0]["total"],
			"list" => $employees
		];
	}

	public function getJobTitles(): array
	{
		$select = new Select();
		$select->setTableName("employees");
		$select->setFields(["jobTitle, COUNT(*)"]);
		$select->setGroupBy(["jobTitle"]);
		$select->execute();
		$jobTitles = $select->fetch();

		return [
			"total" => count($jobTitles),
			"list" => $jobTitles
		];
	}

	public function addEmployee($data): void
	{
		$insert = new Insert();
		$insert->setTableName("employees");
		$insert->setData($data);
		$insert->execute();
	}
}
