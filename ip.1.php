<?php
$file="text";
//получим данные
$text = file_get_contents($file, true);
if (!empty($text)) {
    //разобъем массивом
    $text_arr = explode(' ', $text);
    if (is_array($text_arr) && count($text_arr)>0) {
        $i = 1;
        foreach ($text_arr as $key => &$word) {
            //проверим слово ли это
            if (preg_match("/[A-Za-zА-Яа-пр-яЁё]+/i", $word, $match)) {
                //узнаем остаток от деления
                $div3 = $i%3;
                $div5 = $i%5;
                //заменим слово
                if (!$div3 && !$div5) {
                    $word = str_replace($match[0], '-ПЯТНАДЦАТЬ-', $word);
                } elseif (!$div3) {
                    $word = str_replace($match[0], '-ТРИ-', $word);
                } elseif (!$div5) {
                    $word = str_replace($match[0], '-ПЯТЬ-', $word);
                }
                $i++;
            }
        }
        unset($word);
    }
}
//соединим обратно
$new_text = implode(' ', $text_arr);
//запишим в новый файл
file_put_contents(dirname(__FILE__).'\\'.$file.'.new', $new_text);
echo 'Work_done!';