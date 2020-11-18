<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.


include _ROOT_PATH.'/app/security/check.php';


// 1. pobranie parametrów


function getParams(&$x,&$y,&$z){
    $x = isset($_REQUEST['x']) ? $_REQUEST['x'] : null;
    $y = isset($_REQUEST['y']) ? $_REQUEST['y'] : null;
    $z = isset($_REQUEST['z']) ? $_REQUEST['z'] : null;
}

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

function validate(&$x,&$y,&$z,&$messages)
{
    if (!(isset($x) && isset($y) && isset($z))) {
        return false;
    }

// sprawdzenie, czy parametry zostały przekazane

    if ($x == "") {
        $messages [] = 'Nie podano kwoty';
    }
    if ($y == "") {
        $messages [] = 'Nie podano lat kredytu';
    }
    if ($z == "") {
        $messages [] = 'Nie podano oprocentowania';
    }
//nie ma sensu walidować dalej gdy brak parametrów
    if (count($messages) != 0) return false;

    // sprawdzenie, czy $x i $y są liczbami całkowitymi
    if (!is_numeric($x)) {
        $messages [] = 'Kwota nie jest liczbą całkowitą';
    }

    if (!is_numeric($y)) {
        $messages [] = 'Lata kredytu nie są liczbą całkowitą';
    }

    if (!is_numeric($z)) {
        $messages [] = 'Oprocentowanie nie jest liczbą całkowitą';
    }
    if (count($messages) != 0) return false;
    else return true;
//    if ($z>100) {
//        $messages [] = 'Oprocentowanie nie moze być większe niz 100 :D';
//    }
}


// 3. wykonaj zadanie jeśli wszystko w porządku

//if (!empty ( $messages )) {
//    return false;
//}
    function process(&$x,&$y,&$z,&$messages,&$result){
        $x = intval($x);
        $y = intval($y);
        $z = intval($z);
        global $role;

        if($x>100000 && $role !='admin'){
            $messages [] = "Tylko administrator moze uzywac kwot powyzej 100tyś";
        }
        else if($y>70 && $role !='admin'){
            $messages [] = "Tylko administrator moze uzywac tak abstrakcyjnej ilości lat kredytu";
        }
        else{ $result=($x+(($x/100)*$z))/($y*12); }
    }


    $x = null;
    $y = null;
    $z = null;
    $result = null;
    $messages = array();


    getParams($x,$y,$z);
    if ( validate($x,$y,$z,$messages) ) {
        process($x,$y,$z,$messages,$result);
    }


// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';