<?php

namespace App\Http\Resources;

use Statamic\Assets\Asset;

class CustomAsset extends Asset
{
    public function shallowAugmentedArrayKeys()
    {
        $defaultAugmentedKeys = parent::shallowAugmentedArrayKeys();
        $additionalKeys = ['width', 'height', 'alt'];

        return array_merge($defaultAugmentedKeys, $additionalKeys);
    }
}
