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

// ______________________________________________________________________

// namespace App\Http\Resources;

// use Statamic\Entries\Entry;
// use Statamic\Facades\Entry as EntryFacade;

// class CustomEntry extends Entry
// {
//     public function shallowAugmentedArrayKeys()
//     {
//         if ($this->collectionHandle() == 'blog_articles') {
//             $augmentedKeys = parent::shallowAugmentedArrayKeys();

//             // Check if this entry has author data
//             if (isset($this->data['author'])) {
//                 $augmentedAuthorArray = $this->getAugmentedAuthorArray($this->data['author']);
//                 $augmentedKeys['author'] = $augmentedAuthorArray;
//                 dd($augmentedKeys['author']);
//             }

//             // Add other fields
//             $augmentedKeys = array_merge($augmentedKeys, ['content', 'test_blog_article_field']);

//             return $augmentedKeys;
//         }

//         return parent::shallowAugmentedArrayKeys();
//     }

//     protected function getAugmentedAuthorArray($authorIds)
//     {
//         $augmentedAuthorArray = [];

//         foreach ($authorIds as $authorId) {
//             $authorEntry = EntryFacade::find($authorId);

//             if ($authorEntry) {
//                 // Augment author data keys
//                 $augmentedAuthorArray[] = [
//                     'blueprint' => $authorEntry->get('blueprint'),
//                     'title' => $authorEntry->get('title'),  // Use get('title') instead of title()
//                     'updated_by' => $authorEntry->get('updated_by'),
//                     'updated_at' => $authorEntry->get('updated_at'),
//                     'test_author_field' => $authorEntry->get('test_author_field'),
//                     'content' => $authorEntry->get('content'),  // Use get('content') instead of content()
//                 ];
//             }
//         }

//         return $augmentedAuthorArray;
//     }
// }

//

// namespace App\Http\Resources;

// use Statamic\Entries\Entry;
// use Statamic\Facades\Entry as EntryFacade;
// use Statamic\Data\AbstractAugmented;

// class AugmentedAuthor extends AbstractAugmented
// {
//     public function keys()
//     {
//         return [
//             'title',
//             'test_author_field',
//             'test_author_image', // If this field exists in the blueprint
//         ];
//     }
// }

// class CustomEntry extends Entry
// {
//     public function shallowAugmentedArrayKeys()
//     {
//         $defaultAugmentedKeys = parent::shallowAugmentedArrayKeys();

//         if ($this->collectionHandle() == 'blog_articles') {
//             return array_merge($defaultAugmentedKeys, ['author', 'content', 'test_blog_article_field']);
//         }

//         if ($this->collectionHandle() == 'authors') {
//             return array_merge($defaultAugmentedKeys, ['content', 'test_author_field', 'test_author_image']);
//         }

//         return $defaultAugmentedKeys;
//     }

//     public function toAugmentedArray($keys = null)
//     {
//         $array = parent::toAugmentedArray($keys);

//         if ($this->collectionHandle() == 'blog_articles' && in_array('author', $keys)) {
//             $authors = $array['author'] ?? [];
//             $augmentedAuthors = [];

//             foreach ($authors as $authorId) {
//                 $authorEntry = EntryFacade::find($authorId);

//                 if ($authorEntry) {
//                     $augmentedAuthor = (new AugmentedAuthor($authorEntry))->all();
//                     $augmentedAuthors[] = $augmentedAuthor;
//                 }
//             }

//             $array['author'] = $augmentedAuthors;
//         }

//         return $array;
//     }
// }

