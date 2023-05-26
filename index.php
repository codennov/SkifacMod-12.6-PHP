

<?php

echo 'Source array' . PHP_EOL;

$persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];


for ($n = 0; $n < count($persons_array); $n++) {
    echo $n + 1 . '. ' . $persons_array[$n]['fullname'] . '; ' . $persons_array[$n]['job'] . PHP_EOL;
}
?>



<?php

echo 'Разбиение и объединение ФИО / Partitioning and joining' . PHP_EOL;
echo 'Разбиение: / Splitting:' . PHP_EOL;

$prime_persons_array = $persons_array;

function getPartsFromFullname()
{
    global $prime_persons_array;
    $count = sizeof($prime_persons_array);

    for ($i = 0; $i < $count; ++$i) {

        $key_array = array("0" => "nachname", "1" => "name", "2" => "fathername",);

        $new = array_combine($key_array, explode(' ', $prime_persons_array[$i]['fullname']));

        $prime_persons_array[$i]['fullname'] = $new;

        echo $i + 1 . '. ' . implode(' ', $prime_persons_array[$i]['fullname']) . PHP_EOL;
    }
}
getPartsFromFullname($prime_persons_array);

?>


<?php

echo 'Oбъединение:/ Association:' . PHP_EOL;

function getFullnameFromParts($prime_persons_array)
{
    $count = sizeof($prime_persons_array);

    for ($i = 0; $i < $count; ++$i) {

        echo $i + 1 . '. ' . implode(' ', $prime_persons_array[$i]['fullname']) . PHP_EOL;
    }
}
getFullnameFromParts($prime_persons_array);

?>


<?php
echo 'Сокращение ФИО /Full name abbreviation' . PHP_EOL;

$new1_persons_array = $prime_persons_array;
//print_r($new1_persons_array);

function  getShortName()
{
    global $new1_persons_array;

    for ($i = 0; $i < sizeof($new1_persons_array); ++$i) {

        // echo '<br>вырезаем отчество: <br>';
        unset($new1_persons_array[$i]['fullname']['fathername']);

        // echo '<br>сокращаем имя: <br>';
        $name = $new1_persons_array[$i]['fullname']['name'];
        $new1_persons_array[$i]['fullname']['name'] = substr_replace($name, ".", 2);


        echo  $i + 1 . '. ' .  implode(' ', $new1_persons_array[$i]['fullname']) . PHP_EOL;
    }
}
getShortName($new1_persons_array);

?>


<?php

echo 'Функция определения пола по ФИО / The function of determining gender by full name' . PHP_EOL;

$new2_persons_array = $prime_persons_array;

function  getGenderFromName($new2_persons_array)
{

    // получаем доступ к 3 строкам ФИО
    for ($i = 0; $i < sizeof($new2_persons_array); ++$i) {

        // выделяем окончания у ФИО
        $gender_nachname = substr($new2_persons_array[$i]['fullname']['nachname'], -4);
        //var_export($gender_nachname);
        $gender_name = substr($new2_persons_array[$i]['fullname']['name'], -2);
        //var_export($gender_name);
        $gender_fathername = substr($new2_persons_array[$i]['fullname']['fathername'], -6);
        //var_export($gender_fathername);

        echo PHP_EOL;

        // признаки мужского и женского пола
        $gender_male = ($gender_nachname == 'ов' | $gender_name === 'й'  || $gender_fathername === 'вич') == 1;
        $gender_female = ($gender_nachname == 'ва' || $gender_name == 'а' || $gender_fathername == 'вна') == -1;
        
        // с помощью spaceshife разбираем ФИО по полу
        $so = $gender_male <=> $gender_female;


        // добавляем новый элемент gender  с обозначением пола в общий массив * вместо цифр в принципе можно назначить имена
        $gender = array('gender' => $so);
        $new2_persons_array[$i]['fullname'] = array_merge($new2_persons_array[$i]['fullname'], $gender);
        
        echo $i + 1 . '. ' .  implode(' ', $new2_persons_array[$i]['fullname']) . PHP_EOL;

       
    }
}
getGenderFromName($new2_persons_array);


?>













