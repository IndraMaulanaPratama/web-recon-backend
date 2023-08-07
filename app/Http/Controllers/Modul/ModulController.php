<?php

namespace App\Http\Controllers\Modul;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use Illuminate\Http\Request;
use App\Traits\ModulTraits;
use App\Traits\FeatureTraits;
use App\Traits\MenuTraits;
use Illuminate\Validation\ValidationException;

class ModulController extends Controller
{
    use ModulTraits;
    use FeatureTraits;
    use MenuTraits;

    public function list(Request $request, $config)
    {
        // Inisialisasi Variable
        $items = (null == $request->items) ? 10 : $request->items;

        // Handle Undefined Config
        if ('simple' != $config && 'detail' != $config) :
            return $this->invalidValidation();
        endif;

        // Logic Config Simple
        if ('simple' == $config) :
            $data = $this->modulSimpleData();
        endif;

        // Logic Config Detail
        if ('detail' == $config) :
            $data = $this->modulDetailData($items);

            // Add Index Number
            if (false != $data) :
                $data = $this->addIndexNumber($data);
            endif;
        endif;

        // Response Not Found
        if (false == $data) :
            return $this->modulNotFound();
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Get List Modul Failed');
        endif;

        // Response Success
        if (false != $data) :
            return $this->configResponse(200, 'Get List Modul Success', $data, $config);
        endif;
    }

    public function add(Request $request)
    {
        // Validasi Data Mandatori
        $validate = $this->modulValidasiMandatory($request);
        if ('valid' != $validate) :
            return $validate;
        endif;

        // Inisialisasi Variable
        $name = $request->name;
        $desc = $request->desc;
        $menu = $request->menu;
        $user = $this->getIdUser();

        // Check Duplicated Name
        $checkName = $this->modulsearchName($name);
        if (false != $checkName) :
            return $this->modulDuplicatedName();
        endif;

        // Check Data Menu
        $checkMenu = $this->menuSearchId($menu);
        if (false == $checkMenu) :
            return $this->menuNotFound();
        endif;

        // Config Create Field
        $field = [
            'name' => $name,
            'desc' => $desc,
            'menu' => $menu,
            'created_by' => $user,
        ];

        // Logic Add Data
        $data = Modul::create($field);

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Add Modul Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Add Modul Success');
        endif;
    }

    public function show(Request $request)
    {
        // Validasi Data Mandatory
        try {
            $request->validate(['id' => ['required', 'numeric']]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Inisialisasi Variable
        $id = $request->id;

        // Logic Get Data
        $data = $this->modulGetData($id);

        // Response Not Found
        if (false == $data) :
            return $this->modulNotFound();
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Get Data Modul Failed');
        endif;

        // Response Success
        if (false != $data) :
            return $this->generalResponse(200, 'Get Data Modul Success', $data);
        endif;
    }

    public function update(Request $request, $id)
    {
        // Logic get data
        $data = $this->modulSearchId($id);

        // Response Not Found
        if (false == $data) :
            return $this->modulNotFound();
        endif;

        // Validasidata data mandatori
        $validate = $this->modulValidasiMandatory($request);
        if ('valid' != $validate) :
            return $validate;
        endif;

        // Inisialisasi Variable
        $name = $request->name;
        $desc = $request->desc;
        $menu = $request->menu;
        $user = $this->getIdUser();

        // Check Duplicated Name
        $checkName = $this->modulCheckName($name, $id);
        if (false == $checkName) :
            return $this->modulDuplicatedName();
        endif;

        // Check Data Menu
        $checkMenu = $this->menuSearchId($menu);
        if (false == $checkMenu) :
            return $this->menuNotFound();
        endif;

        // Logic Update Data
        $data->name = $name;
        $data->desc = $desc;
        $data->menu = $menu;
        $data->created_by = $user;
        $data->save();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Update Modul Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Update Modul Success');
        endif;
    }

    public function delete($id)
    {
        // Logic Get Data
        $data = $this->modulSearchId($id);

        // Response Not Found
        if (false == $data) :
            return $this->modulNotFound();
        endif;

        // Logic Delete Data
        $data->delete();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Delete Modul Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Delete Modul Success');
        endif;
    }

    public function filter(Request $request)
    {
        // Validasi Data Mandatory
        try {
            $request->validate([
                'name' => ['string', 'max:50'],
                'menu' => ['numeric'],
            ]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Inisialisasi Variable
        $items = (null == $request->items) ? 10 : $request->items;
        $name = $request->name;
        $menu = $request->menu;

        // Logic Get Data
        $data = $this->modulFilter($items, $name, $menu);

        // Response Not Found
        if (false == $data) :
            return $this->modulNotFound();
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Filter Data Modul Failed');
        endif;

        // Add Index Number
        $data = $this->addIndexNumber($data);

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Filter Data Modul Success', $data);
        endif;
    }
}
