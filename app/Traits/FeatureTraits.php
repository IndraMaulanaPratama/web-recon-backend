<?php

namespace App\Traits;

use App\Models\Features;

trait FeatureTraits
{
    protected function featureSimpleField()
    {
        return [
            'id AS ID',
            'name AS NAME',
            'desc AS DESC',
        ];
    }

    protected function featureDetailField()
    {
        return [
          'features.id AS ID',
          'features.name AS NAME',
          'features.desc AS DESC',
          'modul.name AS MODUL',
          'users.name AS CREATED',
          'features.created_at AS CREATED_AT',
        ];
    }

    // Response Feature Not Found
    public function featureNotFound()
    {
        return $this->generalResponse(404, 'Feature Not Found');
    }

    // Response Duplicate Name
    public function featureDuplicateName()
    {
        return $this->generalResponse(409, 'Name Duplicated');
    }

    // Search By Id
    public function featureSearchId($id)
    {
        $data = Features::id($id)->first(
            [
                'features.id AS ID',
                'features.name AS NAME',
                'features.desc AS DESC',
                'features.modul AS MODUL',
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

    // Search By Name
    public function featureSearchName($name)
    {
        $data = Features::name($name)->first();

        // Response Not Found
        if (null == $data) :
            return false;
        endif;

        // Response Found Data
        if (null != $data) :
            return $data;
        endif;
    }

    // Cek Duplicate Name
    public function featureCekName($name, $id)
    {
        $data = Features::duplicateName($name, $id)->first();

        // Response Duplicate
        if (null == $data) :
            return true;
        endif;

        // Response Available
        if (null != $data) :
            return false;
        endif;
    }
}
