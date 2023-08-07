<?php

namespace App\Traits;

use App\Models\Menu;
use App\Traits\ApiResponser;
use Illuminate\Validation\ValidationException;

trait MenuTraits
{
    use ApiResponser;

    // Response Not Found
    public function menuNotFound()
    {
        return $this->generalResponse(404, 'Data Menu Not Found');
    }

    // Response Name Duplicated
    public function menuDuplicatedName()
    {
        return $this->generalResponse(409, 'Name Duplicated');
    }

    // Config Simple Field
    public function menuSimpleField()
    {
        return [
            'id AS ID',
            'name AS NAME',
            'desc AS DESC',
        ];
    }

    // Config Detail Field
    public function menuDetailField()
    {
        return [
            'menu.id AS ID',
            'menu.name AS NAME',
            'menu.desc AS DESC',
            'users.name AS CREATED',
            'menu.created_at AS CREATED_AT'
        ];
    }

    // Get Data Simple
    public function menuSimpleData()
    {
        $data = Menu::all($this->menuSimpleField());
        $countData = count($data);

        // null = false | !null = $data
        return (null == $countData) ? false : $data;
    }

    // Get Data Detail
    public function menuDetailData($items)
    {
        $data = Menu::toUser()->paginate($items, $this->menuDetailField());
        $countData = count($data);

        // null = false | !null = $data
        return (null == $countData) ? false : $data;
    }

    // Get Data
    public function menuGetData($id)
    {
        $data = Menu::id($id)->first($this->menuSimpleField());

        // null = false | !null = $data
        return (null == $data) ? false : $data;
    }

    // Search Menu By Id
    public function menuSearchId($id)
    {
        $data = Menu::id($id)->first();

        // Not Found
        if (null == $data) :
            return false;
        endif;

        // Response Success
        if (null != $data) :
            return $data;
        endif;
    }

    // Search By Name
    public function menuSearchName($name)
    {
        $data = Menu::name($name)->first();

        // Not Found
        if (null == $data) :
            return false;
        endif;

        // Response Success
        if (null != $data) :
            return $data;
        endif;
    }

    // Cek Duplicated Name
    public function menuCekName($name, $id)
    {
        $data = Menu::cekName($name, $id)->first();

        // Duplicate Name
        if (null != $data) :
            return false;
        endif;

        // Availablle Name
        if (null == $data) :
            return true;
        endif;
    }

    // Get Data Filter
    public function menuFilter($items, $name)
    {
        $data = Menu::filter($name)->paginate($items, $this->menuDetailField());
        $countData = count($data);

        // null = false | !null = $data
        return (null == $countData) ? false : $data;
    }


    // Validasi Data Mandatori
    public function menuValidasiMandatori($request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:50'],
                'desc' => ['required', 'string', 'max:100'],
            ]);
            return 'valid';
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }
    }
}
