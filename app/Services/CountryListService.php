<?php

namespace App;

use App\Interfaces\CountryListInterface;
use GuzzleHttp\Client;

/**
 * Class CountryListService
 *
 * @package App
 */
class CountryListService implements CountryListInterface
{
    public $content;
    public $contentCsv;
    public $contentXls;

    private $countryListUrl = 'http://www.umass.edu/microbio/rasmol/country-.txt';
    private $http;

    /**
     * CountryListService constructor.
     */
    public function __construct()
    {
        $this->http = new Client(['base_uri' => $this->countryListUrl]);
    }

    private function makeRequestAndGetDataFromSource(): void
    {
        $response = $this->http->get($this->countryListUrl);
        $this->setContent((string)$response->getBody()->getContents());
    }

    /**
     * @return string
     */
    private function getContent(): string
    {
        if (empty($this->content)) {
            $this->makeRequestAndGetDataFromSource();
        }

        return $this->content;
    }

    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function getListAsArray(): array
    {
        return $this->replaceStringIntoArrayWithValidCountryCodeAndName($this->getContent());
    }

    /**
     * @param string $content
     * @return array
     */
    private function replaceStringIntoArrayWithValidCountryCodeAndName(
        string $content
    ): array
    {
        $contentAsArray = explode("\n", $content);

        $countryList = [];
        foreach (array_values($contentAsArray) as $value) {
            // 1 group countryCode ({AA}{SPACE}) 2 group all after space ({.+$})
            $regex = '/(^[A-Z][A-Z])\s(.+$)/s';
            if (preg_match_all($regex, $value, $matches,
                PREG_SET_ORDER)
            ) {
                $countryList[trim($matches[0][1])] = trim($matches[0][2]);
            }
        }

        return $countryList;
    }

    /**
     * @param array $content
     */
    public function createCsv(array $content): void
    {
        $csv = '';
        //headers
        foreach (['Código', 'Nome'] as $header) {
            $csv .= "{$header};";
        }

        $csv = str_replace_last(';', "\n", $csv);

        //contents
        foreach ($content as $key => $value) {
            $csv .= "{$key};{$value}\n";
        }
        $this->contentCsv = $csv;
    }

    /**
     * @return string
     */
    public function getListCsv(): string
    {
        if (empty($this->contentCsv)) {
            $this->createCsv($this->getListAsArray());
        }

        return $this->contentCsv;
    }

    /**
     * @param array $content
     */
    public function createXls(array $content): void
    {
        $xls = '';
        //headers
        foreach (['Código', 'Nome'] as $header) {
            $xls .= "{$header};";
        }

        $xls = str_replace_last(';', "\n", $xls);

        //contents
        foreach ($content as $key => $value) {
            $xls .= "{$key};{$value}\n";
        }
        $this->contentXls = $xls;
    }

    /**
     * Get the csv string
     *
     * @return string
     */
    public function getListXls(): string
    {
        if (empty($this->contentXls)) {
            $this->createXls($this->getListAsArray());
        }

        return $this->contentXls;
    }


}
