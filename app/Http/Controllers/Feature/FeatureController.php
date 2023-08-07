<?php

namespace App\Http\Controllers\Feature;

use App\Http\Controllers\Controller;
use App\Models\Features;
use Illuminate\Http\Request;
use App\Traits\FeatureTraits;
use Illuminate\Validation\ValidationException;
use App\Traits\ModulTraits;
use Codeception\Lib\Generator\Feature;

class FeatureController extends Controller
{
    use FeatureTraits;
    use ModulTraits;

    // Get List Config
    public function list(Request $request, $config)
    {
        // Inisialisasi Variable
        $items = (null == $request->items) ? 10 : $request->items;

        // Handler Undefined Variable
        if ('simple' != $config && 'detail' != $config) :
            return $this->invalidValidation();
        endif;

        // Logic Config Simple
        if ('simple' == $config) :
            $data = Features::all($this->featureSimpleField());
            $countData = count($data);
        endif;

        // Logic Config Detail
        if ('detail' == $config) :
            $data = Features::detail()->paginate($items, $this->featureDetailField());
            $countData = count($data);

            // Add Index Number
            $data = $this->addIndexNumber($data);
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Get List Feature Failed');
        endif;

        // Response Not Found
        if (null == $countData) :
            return $this->featureNotFound();
        endif;

        // Response Success
        if (null != $countData && $data) :
            return $this->configResponse(200, 'Get List Feature Success', $data, $config);
        endif;
    }

    // Add
    public function add(Request $request)
    {
        // Inisialisasi Variable
        $name = $request->name;
        $desc = $request->desc;
        $modul = $request->modul;
        $userLogin = $this->getIdUser();

        // Validasi Data Mandatori
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:50'],
                'desc' => ['required', 'string', 'max:100'],
                'modul' => ['required', 'numeric'],
            ]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Validasi Duplicated Name
        $duplicateName = $this->featureSearchName($name);
        if (false != $duplicateName) :
            return $this->featureDuplicateName();
        endif;

        // Validasi Data Modul
        $cekModul = $this->modulSearchId($modul);
        if (false == $cekModul) :
            return $this->modulNotFound();
        endif;

        // Inisialisasi Create Field
        $field = [
            'name' => $name,
            'desc' => $desc,
            'modul' => $modul,
            'created_by' => $userLogin,
        ];

        // Logic Create Data
        $data = Features::create($field);

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Add Feature Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Add Feature Success');
        endif;
    }

    // Get Data
    public function show(Request $request)
    {
        // Inisialisasi Variable
        $id = $request->id;

        // Validasi Data Mandatori
        try {
            $request->validate(['id' => ['required', 'numeric']]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Logic Get Data
        $data = $this->featureSearchId($id);

        // Response Not Found
        if (false == $data) :
            return $this->featureNotFound();
        endif;

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Get Data Feature Failed');
        endif;

        // Response Success
        if (false != $data) :
            return $this->generalResponse(200, 'Get Data Feature Success', $data);
        endif;
    }

    // Update
    public function update(Request $request, $id)
    {
        // Inisialisasi Variable
        $name = $request->name;
        $desc = $request->desc;
        $modul = $request->modul;
        $userLogin = $this->getIdUser();

        // Validasi Data Mandatori
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:50'],
                'desc' => ['required', 'string', 'max:100'],
                'modul' => ['required', 'numeric'],
            ]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Logic Get Data
        $data = Features::simpleId($id)->first();

        // Response Not Found
        if (false == $data) :
            return $this->featureNotFound();
        endif;

        // Validasi Data Modul
        $cekModul = $this->modulSearchId($modul);
        if (false == $cekModul) :
            return $this->modulNotFound();
        endif;

        // Cek Duplicate Name
        $cekName = $this->featureCekName($name, $id);
        if (false == $cekName) :
            return $this->featureDuplicateName();
        endif;

        // Logic Update Data
        $data->name = $name;
        $data->desc = $desc;
        $data->modul = $modul;
        $data->created_by = $userLogin;
        $data->save();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Update Feature Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Update Feature Success');
        endif;
    }

    // Delete
    public function delete($id)
    {
        // Logic Get Data
        $data = Features::simpleId($id);

        // Response Not Found
        if (false == $data) :
            return $this->featureNotFound();
        endif;

        // Logic Delete
        $data->delete();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Delete Feature Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Delete Feature Success');
        endif;
    }

    // Filter
    public function filter(Request $request)
    {
        // Inisialisasi Variable
        $items = (null == $request->items) ? 10 : $request->items;
        $name = $request->name;
        $modul = $request->modul;

        // Validasi Data Mandatory
        try {
            $request->validate([
                'name' => ['string', 'max:50'],
                'modul' => ['numeric'],
            ]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Logic Get Data
        $data = Features::filter($name, $modul)->paginate($items, $this->featureDetailField());
        $countData = count($data);

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Filter Data Feature Failed');
        endif;

        // Response Not Found
        if (null == $countData) :
            return $this->featureNotFound();
        endif;

        // Add Index Number
        $data = $this->addIndexNumber($data);

        // Response Success
        if (null != $data) :
            return $this->generalResponse(200, 'Filter Data Feature Success', $data);
        endif;
    }
}
