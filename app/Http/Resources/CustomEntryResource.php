<?php

namespace App\Http\Resources;

use Statamic\Http\Resources\API\EntryResource;

class CustomEntryResource extends EntryResource
{
    public function toArray($request)
    {
        // return $this->resource
        //     ->toAugmentedCollection()
        //     ->withShallowNesting()
        //     ->toArray();

        // return $this->augmented()->select($this->shallowAugmentedArrayKeys())->withShallowNesting();

        // return [
        //     'id' => $this->resource->id(),
        //     'title' => $this->resource->value('title'),
        // ];

        return parent::toArray($request);
    }
}

// __________________________________________________
// namespace App\Http\Resources;

// use Statamic\Http\Resources\API\EntryResource;
// use Statamic\Facades\Entry as FacadeEntry;

// class CustomEntryResource extends EntryResource
// {
//     public function toArray($request)
//     {
//         $entryArray = parent::toArray($request);
//         $entryArray = $this->processNestedEntries($entryArray);

//         dd($entryArray);

//         return $entryArray;
//     }

//     protected function processNestedEntries($entryArray)
//     {
//         foreach ($entryArray as $key => &$value) {
//             if ($value instanceof \Statamic\Fields\Value && $value->fieldtype() === 'entries') {
//                 $entryIds = $value->raw();
//                 $entries = [];

//                 foreach ($entryIds as $entryId) {
//                     $entry = FacadeEntry::find($entryId);
//                     if ($entry) {
//                         $entries[] = $entry->shallowAugmentedArrayKeys();
//                     }
//                 }

//                 $value = $entries;
//             } elseif (is_array($value)) {
//                 $value = $this->processNestedEntries($value);
//             }
//         }

//         return $entryArray;
//     }
// }

