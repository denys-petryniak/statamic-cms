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

// _____________________________________________

// namespace App\Http\Resources;

// use Statamic\Http\Resources\API\EntryResource;

// class CustomEntryResource extends EntryResource
// {
//     public function toArray($request)
//     {
//         $entryArray = parent::toArray($request);

//         $entryArray = $this->processNestedEntries($entryArray);

//         return $entryArray;
//     }

//     protected function processNestedEntries($entryArray)
//     {
//         foreach ($entryArray as $key => &$value) {
//             if (is_array($value) && array_key_exists('id', $value)) {
//                 $entry = \Statamic\Facades\Entry::find($value['id']);

//                 if ($entry) {
//                     $value = $entry->toAugmentedArray();
//                 }
//             } elseif (is_array($value)) {
//                 $value = $this->processNestedEntries($value);
//             }
//         }

//         return $entryArray;
//     }
// }


// ______________________________________________

// namespace App\Http\Resources;

// use Statamic\Http\Resources\API\EntryResource;
// use Statamic\Facades\Entry as EntryFacade;

// class CustomEntryResource extends EntryResource
// {
//     public function toArray($request)
//     {
//         $augmentedArray = parent::toArray($request);

//         return $this->augmentNestedCollections($augmentedArray);
//     }

//     protected function augmentNestedCollections($array)
//     {
//         foreach ($array as &$value) {
//             if (is_array($value)) {
//                 foreach ($value as &$nestedValue) {
//                     if (is_array($nestedValue)) {
//                         foreach ($nestedValue as &$nestedItem) {
//                             if (is_string($nestedItem)) {
//                                 $nestedItem = $this->augmentNestedItem($nestedItem);
//                             }
//                         }
//                     }
//                 }
//             }
//         }

//         return $array;
//     }

//     protected function augmentNestedItem($itemId)
//     {
//         $item = EntryFacade::find($itemId);

//         if ($item) {
//             $itemResource = new CustomEntryResource($item);
//             return $itemResource->toArray(request());
//         }

//         return null;
//     }
// }

// ________________________________________________
// namespace App\Http\Resources;

// use Statamic\Http\Resources\API\EntryResource;
// use Statamic\Facades\Asset;

// class CustomEntryResource extends EntryResource
// {
//     public function toArray($request)
//     {
//         $data = parent::toArray($request);

//         if ($this->resource->collectionHandle() === 'blog_articles') {
//             $augmentedCollection = $this->resource->toAugmentedCollection()->withShallowNesting();

//             $data['author'] = $augmentedCollection->map(function ($item) {
//                 $authors = [];
//                 $authorIds = $item->value('author');

//                 foreach ($authorIds as $authorId) {
//                     $author = Entry::find($authorId);
//                     if ($author) {
//                         $authors[] = [
//                             'id' => $author->id(),
//                             'title' => $author->value('title'),
//                             'url' => $author->url(),
//                             'permalink' => $author->absoluteUrl(),
//                             'api_url' => route('statamic.api.entries.show', [$author->collectionHandle(), $author->id()]),
//                             'content' => $author->value('content'),
//                             'test_author_field' => $author->value('test_author_field'),
//                             'test_author_image' => [
//                                 'id' => $author->value('test_author_image'),
//                                 'url' => $author->value('test_author_image') ? Asset::find($author->value('test_author_image'))->url() : null,
//                                 'permalink' => $author->value('test_author_image') ? Asset::find($author->value('test_author_image'))->absoluteUrl() : null,
//                                 'api_url' => $author->value('test_author_image') ? route('statamic.api.assets.show', [$author->value('test_author_image')]) : null,
//                                 'width' => $author->value('test_author_image') ? Asset::find($author->value('test_author_image'))->width() : null,
//                                 'height' => $author->value('test_author_image') ? Asset::find($author->value('test_author_image'))->height() : null,
//                                 'alt' => $author->value('test_author_image') ? Asset::find($author->value('test_author_image'))->alt() : null,
//                             ],
//                         ];
//                     }
//                 }

//                 $item['author'] = $authors;

//                 return $item->toArray();
//             });

//             $data['hero_article'] = $data['author'];
//         }

//         return $data;
//     }
// }

// _________________________________________________

// class CustomEntryResource extends EntryResource
// {
//     public function toArray($request)
//     {
//         return match($this->resource->collectionHandle()) {
//           'blog_articles' => $this->customBlogArticlesCollection($request),
//           default => $this->standard($request),
//         };
//     }

//     public function standard($request)
//     {
//         return parent::toArray($request);
//     }

//     public function customBlogArticlesCollection($request)
//     {
//         return [
//             ...$this->standard($request),
//             'author' => $this->resource->value('author'),
//             'content' => $this->resource->value('content'),
//         ];
//     }
// }
