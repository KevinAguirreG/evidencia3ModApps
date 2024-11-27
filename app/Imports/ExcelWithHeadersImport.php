<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelWithHeadersImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{
	/**
	* @param Collection $collection
	*/
	public function collection(Collection $rows)
	{
		$result = [];
		foreach ($rows as $key => $row) {
			$result[] = (array) $row;
		}
		return $result;
	}
}