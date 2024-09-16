<?php

declare(strict_types=1);

namespace Albums\models;

use Albums\core\Model;

class Home extends Model
{
//    public static function getAllAlbums(): array
//    {
//        try {
//            $albums = App::database()->query("SELECT * FROM albums ORDER BY created_at DESC")->fetchAll(); // TODO: replace * with 'id, LEFT(name, 60) as name, LEFT(description, 60) as description'
//        } catch (\Exception $exception) {
//            var_dump($exception->getMessage());
//
//            return [];
//        }
//
//        if (!is_array($albums)) {
//            var_dump("An error occurred while getting albums");
//
//            return [];
//        }
//
//        return $albums;
//    }
}