<?php

namespace App\Interfaces;

interface CountryListInterface
{
    public function getListAsArray();

    public function getListCsv();

    public function getListXls();
}
