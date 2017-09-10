<?php

class ReportRow
{
    protected $country;
    protected $population;
    protected $date;
    protected $internetUsers;
    protected $percentageCountryIU;
    protected $percentageWorldIU;

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {

        $this->country = self::trimCountryName($country);
    }

    /**
     * @return mixed
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * @param mixed $population
     */
    public function setPopulation($population)
    {
        $nf = new NumberFormatter("en_EN", NumberFormatter::DECIMAL);
        $this->population = $nf->parse($population, NumberFormatter::TYPE_INT64);
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getInternetUsers()
    {
        return $this->internetUsers;
    }

    /**
     * @param mixed $internetUsers
     */
    public function setInternetUsers($internetUsers)
    {
        $nf = new NumberFormatter("en_EN", NumberFormatter::DECIMAL);
        $this->internetUsers = $nf->parse($internetUsers, NumberFormatter::TYPE_INT64);
    }

    /**
     * @return mixed
     */
    public function getPercentageCountryIU()
    {
        if (!$this->getInternetUsers() || !$this->getPopulation()) {
            return null;
        }
        return ($this->getInternetUsers() / $this->getPopulation()) * 100;
    }


    /**
     * @param mixed $percentageCountryIU
     */
    public function setPercentageCountryIU($percentageCountryIU)
    {
        $this->percentageCountryIU = $percentageCountryIU;
    }

    /**
     * @return mixed
     */
    public function getPercentageWorldIU($totalWorldInternetUsers)
    {
        if(!$this->getInternetUsers() || !$totalWorldInternetUsers) {
            return null;
        }
        $div = bcdiv($this->getInternetUsers(), $totalWorldInternetUsers, 8);

        return bcmul($div, 100, 5);

    }


    public static function trimCountryName($country)
    {
        $country = explode("[",$country);
        return trim($country[0], " \t\n\r\0\x0B\xc2\xa0");
    }
}