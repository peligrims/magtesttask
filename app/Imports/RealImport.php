<?php

namespace App\Imports;

use App\Models\Realty;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RealImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Realty([
            "name" =>$row["name"],
            "price" =>$row["price"],
            "bedroom" =>$row["bedroom"],
            "bathroom" =>$row["bathroom"],
            "storey" =>$row["storey"],
            "garage" =>$row["garage"],

        ]);
    }
}
