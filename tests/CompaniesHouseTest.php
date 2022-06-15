<?php

namespace Equipal\CompaniesHouse;

use PHPUnit\Framework\TestCase;
use Equipal\CompaniesHouse\Controllers\CompaniesHouse;

class CompaniesHouseTest extends TestCase
{
    /**
     * @var companiesHouse
     */
    private $companiesHouse;

    protected function setUp(): void
    {
        $this->companiesHouse = new CompaniesHouse;
    }

    public function testSearchCompanyByCompanyNumber()
    {
        $results = $this->companiesHouse->get('search/companies?q=08377339');
        $this->assertEquals($results->total_results, 1);
        $this->assertEquals($results->items[0]->title, 'KUDOS LABS LTD');
    }

    public function testStaticSearchCompanyByCompanyNumber()
    {
        $results = CompaniesHouse::get('search/companies?q=08377339');
        $this->assertEquals($results->total_results, 1);
        $this->assertEquals($results->items[0]->title, 'KUDOS LABS LTD');
    }
}
