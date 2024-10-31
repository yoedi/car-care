<?php

function isOpenValue2(int $param = 0): string
{
    $result = "";

    if ($param === 1) {
        $result = 'Buka';
    } else {
        $result = 'Tutup';
    }

    return $result;
}

function country_with_currency_and_symbol($state = null): string {
    return 'Sukses';
}
