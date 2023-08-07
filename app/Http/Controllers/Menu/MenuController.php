<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Traits\MenuTraits;
use Illuminate\Validation\ValidationException;

class MenuController extends Controller
{
    use MenuTraits;

    public function list(Request $request, $config)
    {
        // Handle Undefined Config
        if ('simple' != $config && 'detail' != $config) :
            return $this->invalidValidation();
        endif;

        // Inisialisasi Variable
        $items = (null == $request->items) ? 10 : $request->items;

        // Logic Config Simple
        if ('simple' == $config) :
            $data = $this->menuSimpleData();
        endif;

        // Logic Config Detail
        if ('detail' == $config) :
            $data = $this->menuDetailData($items);

            // Add Index Number
            (null != $data) ? $data = $this->addIndexNumber($data) : null;
        endif;

        // Response Not Found
        if (false == $data) :
            return $this->menuNotFound();
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Get List Menu Failed');
        endif;

        // Response Success
        if (false != $data) :
            return $this->configResponse(200, 'Get List Menu Success', $data, $config);
        endif;
    }

    public function add(Request $request)
    {
        // Validasi Data Mandatori
        $validasi = $this->menuValidasiMandatori($request);
        if ('valid' != $validasi) :
            return $validasi;
        endif;

        // Inisialisasi Variable
        $name = $request->name;
        $desc = $request->desc;

        // Cek Duplicate Name
        $cekName = $this->menuSearchName($name);
        if (false != $cekName) :
            return $this->menuDuplicatedName();
        endif;

        // Config Create Field
        $field = [
            'name' => $name,
            'desc' => $desc,
        ];

        // Logic Add Data
        $data = Menu::create($field);

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Add Menu Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Add Menu Success');
        endif;
    }

    public function show(Request $request)
    {
        // Validasi Data Mandatori
        try {
            $request->validate(['id' => ['required', 'numeric']]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Inisialisasi Variable
        $id = $request->id;

        // Logic Get Data
        $data = $this->menuGetData($id);

        // Response Not Found
        if (false == $data) :
            return $this->menuNotFound();
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Get Data Menu Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Get Data Menu Success', $data);
        endif;
    }

    public function update(Request $request, $id)
    {
        // Cek Data Menu
        $data = $this->menuSearchId($id);

        // Response Not Found
        if (false == $data) :
            return $this->menuNotFound();
        endif;

        // Validasi Data Mandatori
        $validasi = $this->menuValidasiMandatori($request);
        if ('valid' != $validasi) :
            return $validasi;
        endif;

        // Inisialisasi Variable
        $name = $request->name;
        $desc = $request->desc;

        // Cek Duplicated Name
        $cekDuplicateName = $this->menuCekName($name, $id);
        if (false == $cekDuplicateName) :
            return $this->menuDuplicatedName();
        endif;

        // Logic Update Data
        $data->name = $name;
        $data->desc = $desc;
        $data->save();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Update Menu Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Update Menu Success');
        endif;
    }

    public function delete($id)
    {
        // Logic Get Data
        $data = $this->menuSearchId($id);

        // Response Not Found
        if (false == $data) :
            return $this->menuNotFound();
        endif;

        // Logic Delete Data
        $data->delete();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Delete Menu Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Delete Menu Success');
        endif;
    }

    public function filter(Request $request)
    {
        // Validasi Data Mandatori
        try {
            $request->validate(['name' => ['string', 'max:50']]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Inisialisasi Variable
        $items = (null == $request->items) ? 10 : $request->items;
        $name = $request->name;

        // Logic Get Data
        $data = $this->menuFilter($items, $name);

        // Response Not Found
        if (false == $data) :
            return $this->menuNotFound();
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Filter Data Menu Failed');
        endif;

        // Add Index Number
        $data = $this->addIndexNumber($data);

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Filter Data Menu Success', $data);
        endif;
    }
}
