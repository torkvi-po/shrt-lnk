<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $fillable = ['url'];

    public static function boot()
    {
        parent::boot();

        //Так как у нас нет ID-increment из базы при записи, то мы заполняем его после сохранения
        static::created(function ($link) {
            $link->id26 = $link->generateId26($link->id);
            $link->save();
        });
    }

    function generateId26($number): string
    {
        //получаем алфавит массив символов от "а" до "z"
        //если у нас не алфавит, то надо явно указать допустимые символы
        $alphabet = range('a', 'z');
        $result = '';

        $i=0;
        while ($number > 0) {
            //получаем остаток от деления
            $remainder = ($number - 1) % 26; // -1, чтобы индексация начиналась с 0
            //дополняем результат нахождения элемента в
            $result = $alphabet[$remainder] . $result;
            //получаем остаточное число
            $number = floor(($number - 1) / 26);
        }
        return $result;
    }
}
