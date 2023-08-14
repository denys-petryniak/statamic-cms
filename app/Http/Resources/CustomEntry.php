<?php

namespace App\Http\Resources;

use Statamic\Entries\Entry;

class CustomEntry extends Entry
{
    public function shallowAugmentedArrayKeys()
    {
        $defaultAugmentedKeys = parent::shallowAugmentedArrayKeys();
        $collectionHandle = $this->collectionHandle();

        $additionalKeys = [
            'blog_articles' => ['author', 'content', 'test_blog_article_field', 'test_blog_article_image'],
            'authors' => ['content', 'test_author_field', 'test_author_image'],
        ];

        if (array_key_exists($collectionHandle, $additionalKeys)) {
            return array_merge($defaultAugmentedKeys, $additionalKeys[$collectionHandle]);
        }

        return $defaultAugmentedKeys;
    }
}
// ____________________________________________________________________

// namespace App\Http\Resources;

// use Statamic\Entries\Entry;
// use Statamic\Facades\Entry as FacadeEntry;

// class CustomEntry extends Entry
// {
//     public function shallowAugmentedArrayKeys()
//     {
//         $defaultAugmentedKeys = parent::shallowAugmentedArrayKeys();
//         $collectionHandle = $this->collectionHandle();

//         $additionalKeys = [
//             'blog_articles' => ['author', 'content', 'test_blog_article_field', 'test_blog_article_image'],
//             'authors' => ['content', 'test_author_field', 'test_author_image'],
//         ];

//         if (array_key_exists($collectionHandle, $additionalKeys)) {
//             $augmentedKeys = array_merge($defaultAugmentedKeys, $additionalKeys[$collectionHandle]);

//             if ($collectionHandle === 'blog_articles' && in_array('author', $augmentedKeys)) {
//                 $authorIds = $this->get('author'); // Assuming 'author' field contains author IDs

//                 $authorData = collect($authorIds)->map(function ($authorId) {
//                     $authorEntry = FacadeEntry::find($authorId);
//                     if ($authorEntry) {
//                         return $authorEntry->shallowAugmentedArrayKeys();
//                     }
//                     return null;
//                 })->filter(); // Remove null entries


//                 // Insert the augmented author data into the $augmentedKeys array
//                 array_splice($augmentedKeys, array_search('author', $augmentedKeys), 1, ['author' => $authorData->toArray()]);

//                 dd($augmentedKeys);
//             }

//             return $augmentedKeys;
//         }

//         return $defaultAugmentedKeys;
//     }
// }
