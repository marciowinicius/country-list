<?php

namespace App\Http\Controllers;

use App\Interfaces\CountryListInterface;

class HomeController extends Controller
{
    private $countries;

    public function __construct(CountryListInterface $countryInterface)
    {
        $this->countries = $countryInterface;
    }

    public function index()
    {
        return view('index');
    }

    public function showListView()
    {
        $countries = $this->countries->getListAsArray();

        return view('country-list', compact('countries'));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function csv()
    {
        $csv = $this->countries->getListCsv();

        return response()->stream(function () use ($csv) {
            echo $csv;
        }, 200, [
            'Content-type' => 'text/csv;charset=UTF-8',
            'Content-Disposition' => 'attachment;filename=countries.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function xls()
    {
        $xls = $this->countries->getListXls();

        return response()->stream(function () use ($xls) {
            echo $xls;
        }, 200, [
            'Content-type' => 'application/x-msexcel;charset=UTF-8',
            'Content-Disposition' => 'attachment;filename=countries.xls',
            'Expires' => '0',
            'Pragma' => 'public',
        ]);
    }
}
