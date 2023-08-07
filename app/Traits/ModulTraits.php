<?php

namespace App\Traits;

use App\Models\Modul;
use App\Traits\ApiResponser;
use Illuminate\Validation\ValidationException;

trait ModulTraits
{
    use ApiResponser;

    // Config Simple Field
    protected function modulSimpleField()
    {
        return [
            'id AS ID',
            'name AS NAME',
            'desc AS DESC',
        ];
    }

    // Config Detail Field
    protected function modulDetailField()
    {
        return [
            'modul.id AS ID',
            'modul.name AS NAME',
            'modul.desc AS DESC',
            'menu.name AS MENU',
            'users.name AS CREATED',
            'modul.created_at AS CREATED_AT',
        ];
    }

    // Response Not Found
    public function modulNotFound()
    {
        return $this->generalResponse(404, 'Data Modul Not Found');
    }

    // Response Name Duplicated
    public function modulDuplicatedName()
    {
        return $this->generalResponse(409, 'Name Duplicated');
    }

    // Get Config Simple
    public function modulSimpleData()
    {
        $data = Modul::all($this->modulSimpleField());
        $countData = count($data);

        // Response Not Found
        if (false == $countData) :
            return false;
        endif;

        // Response Success
        if (false != $data) :
            return $data;
        endif;
    }

    // Get Config Detail
    public function modulDetailData($items)
    {
        $data = Modul::getDetail()->paginate($items, $this->modulDetailField());
        $countData = count($data);

        // Response Not Found
        if (false == $countData) :
            return false;
        endif;

        // Response Success
        if (false != $data) :
            return $data;
        endif;
    }

    // Search By Id
    public function modulGetData($id)
    {
        $data = Modul::id($id)->first(
            [
                'id AS ID',
                'name AS NAME',
                'desc AS DESC',
                'menu AS MENU',
            ]
        );

        // Response Not Found
        if (null == $data) :
            return false;
        endif;

        // Response Found Data
        if (null != $data) :
            return $data;
        endif;
    }

    // Search By Id
    public function modulSearchId($id)
    {
        $data = Modul::id($id)->first();

        // Response Not Found
        if (null == $data) :
            return false;
        endif;

        // Response Found Data
        if (null != $data) :
            return $data;
        endif;
    }

    // Search By Name
    public function modulsearchName($name)
    {
        $data = Modul::name($name)->first();

        // Response Not Found
        if (null == $data) :
            return false;
        endif;

        // Response Success
        if (null != $data) :
            return $data;
        endif;
    }

    // Cek Duplicated Name
    public function modulCheckName($name, $id)
    {
        $data = Modul::checkName($name, $id)->first();

        // Response Duplicated
        if (null != $data) :
            return false;
        endif;

        // Response Success
        if (null == $data) :
            return true;
        endif;
    }

    // Filter Data
    public function modulFilter($items, $name, $menu)
    {
        $data = Modul::filter($name, $menu)->paginate($items, $this->modulDetailField());
        $countData = count($data);

        // Data Not Found
        if (null == $countData) :
            return false;
        endif;

        // Response Success
        if (null != $countData) :
            return $data;
        endif;
    }

    // Function Validasi Mandatori
    public function modulValidasiMandatory($request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:50'],
                'desc' => ['required', 'string', 'max:100'],
                'menu' => ['required', 'numeric'],
            ]);
            return 'valid';
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }
    }
}
