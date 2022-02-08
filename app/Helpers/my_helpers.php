<?php

function check_login()
{
    if (session()->get("isLoggedIn") !== true) {
        return false;
    } else {
        return true;
    }
}

function intToRupiah($value)
{
    $rupiahResult = "Rp " . number_format($value, 0, ',', '.');
    return $rupiahResult;
}

function rupiahToInt($value)
{
    // $valueWithoutComma = explode(",", $value);
    // $valueWithoutComma = $valueWithoutComma[0];
    return  (int) preg_replace("/[^0-9]/", "", $value);
}

function getMonthByNumber($monthNumber)
{
    $monthData = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];
    return $monthData[$monthNumber - 1];
}

function getMonthList()
{
    return  [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];
}


function getMonthNow()
{
    date_default_timezone_set('Asia/Jakarta');
    return $month = date('m', time());
}
function getYearNow()
{
    date_default_timezone_set('Asia/Jakarta');
    return $year = date('Y', time());
}
function getDateNow()
{
    date_default_timezone_set('Asia/Jakarta');
    return date('Y-m-d', time());
}


function getStatusName($idStatus)
{
    $status = [
        1 => "Desain Selesai",
        2 =>  "Produksi Selesai",
        3 => "Packing Selesai",
        4 => "Checkout Selesai",
        5 => "Waiting List"
    ];
    return $status[$idStatus];
}
