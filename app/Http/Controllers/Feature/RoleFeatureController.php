<?php

namespace App\Http\Controllers\Feature;

use App\Http\Controllers\Controller;
use App\Models\RolesFeatures;
use Illuminate\Http\Request;
use App\Traits\RoleFeatureTraits;
use Illuminate\Validation\ValidationException;
use App\Traits\RoleTraits;
use App\Traits\FeatureTraits;

class RoleFeatureController extends Controller
{
    use RoleFeatureTraits;
    use RoleTraits;
    use FeatureTraits;

    public function list(Request $request)
    {
        // Inisialisasi Variable
        $items = (null == $request->items) ? 10 : $request->items;

        // Logic Get Data
        $data = $this->featureRoleList($items);

        // Add Index Number
        $data = (false == $data) ? false : $this->addIndexNumber($data);

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Get List Role Fearure Failed');
        endif;

        // Response Not Found
        if (false == $data) :
            return $this->featureRoleNotFound();
        endif;

        // Response Success
        if (false != $data) :
            return $this->generalResponse(200, 'Get List Role-Feature Success', $data);
        endif;
    }

    public function add(Request $request)
    {
        // Validasi Data Mandatori
        try {
            $request->validate([
                'role_id' => ['required', 'numeric'],
                'feature_id' => ['required', 'array'],
                'feature_id.*' => ['numeric']
            ]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Inisialisasi Variable
        $role = $request->role_id;
        $feature = $request->feature_id;
        $countFeature = count($feature);
        $warningNotFound = [];
        $warningExists = [];

        // Cek Data Role
        $cekRole = $this->cekRoleId($role);
        if (false == $cekRole) :
            return $this->roleNotFound();
        endif;

        // Logic Add Data
        for ($i=0; $i < $countFeature; $i++) {
            // Cek Data Feature
            $cekFeature[$i] = $this->featureSearchId($feature[$i]);

            // Cek Feature Exists
            $cekRoleFeature[$i] = $this->featureRoleDuplicateUserFeature($role, $feature[$i]);

            // !Cek_Feature
            if (false == $cekFeature[$i] && false != $cekRoleFeature[$i]) :
                // Masukan feature yang tidak ditemukan kedalam warning
                $warningNotFound[] = $feature[$i];

                // !Role_feature
            elseif (false != $cekFeature[$i] && false == $cekRoleFeature[$i]) :
                // Masukan Data Exists
                $warningExists[] = $feature[$i];

                // !Cek_Feature & !Role_feature
            elseif (false == $cekFeature[$i] && false == $cekRoleFeature[$i]) :
                // Masukan Data Cannot Process
                $warningExists[] = $feature[$i];
                $warningNotFound[] = $feature[$i];

                // Process create data
            else :
                // Inisialisasi Create Field
                $field = ['role' => $role, 'feature' => $feature[$i]];

                // Logic Add Data
                $data = RolesFeatures::create($field);

                // Response Failed
                if (!$data) :
                    return $this->failedResponse('Add Role-Feature Failed');
                endif;
            endif;
        }

        // Response Success
        if (null == $warningNotFound && null == $warningExists) :
            return $this->generalResponse(200, 'Add Role-Feature Success');
        endif;

        // Response Success With Warning Not Registered
        if (null != $warningNotFound && null == $warningExists) :
            $data = ['feature_not_registered' => $warningNotFound];
            return $this->generalResponse(202, 'Add Role-Feature Success But Some Feature Not Registered', $data);
        endif;

        // Response Success With Feature Exists
        if (null == $warningNotFound && null != $warningExists) :
            $data = ['feature_exists' => $warningExists];
            return $this->generalResponse(202, 'Add Role-Feature Success But Some Feature Exists', $data);
        endif;

        // Response Success With Cannot Process
        if (null != $warningNotFound && null != $warningExists) :
            $data = [
                'feature_exists' => $warningExists,
                'feature_not_registered' => $warningNotFound,
            ];
            return $this->generalResponse(202, 'Add Role-Feature Success But Some Data Cannot Processed', $data);
        endif;
    }

    public function delete($id)
    {
        // Logic Get Data
        $data = $this->featureRoleById($id);

        // Response Not Found
        if (false == $data) :
            return $this->featureRoleNotFound();
        endif;

        // Logic Delete Data
        $data->delete();

        // Response Failed
        if (!$data) :
            return $this->failedResponse('Delete Role-Feature Failed');
        endif;

        // Response Success
        if ($data) :
            return $this->generalResponse(200, 'Delete Role-Feature Success');
        endif;
    }

    public function filter(Request $request)
    {
        // Validasi Data Mandatori
        try {
            $request->validate([
                'role_name' => ['string', 'max:50'],
                'feature_name' => ['string', 'max:50'],
            ]);
        } catch (ValidationException $th) {
            return $this->invalidValidation($th->validator->errors());
        }

        // Inisialisasi Variable
        $items = (null == $request->items) ? 10 : $request->items;
        $role = $request->role_name;
        $feature = $request->feature_name;

        // Logic Get Data
        $data = $this->featureRoleFilter($items, $role, $feature);

        // Response Not Found
        if (false == $data) :
            return $this->responseNotFound('Data Role-Feature Not Found');
        endif;

        // Response Success
        if (false != $data) :
            // Add Index Number
            $data = $this->addIndexNumber($data);
            return $this->generalResponse(200, 'Filter Data Role-Feature Success', $data);
        endif;
    }
}
