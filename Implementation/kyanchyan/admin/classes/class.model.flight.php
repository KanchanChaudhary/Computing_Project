<?php 

class Flight{

	private $id;
	private $departureTime;
	private $flyingFrom;
	private $flyingTo;
	private $flyingAgencyName;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getDepartureTime()
    {
        return $this->departureTime;
    }
    public function setDepartureTime($departureTime)
    {
        $this->departureTime = $departureTime;
    }
    public function getFlyingFrom()
    {
        return $this->flyingFrom;
    }
    public function setFlyingFrom($flyingFrom)
    {
        $this->flyingFrom = $flyingFrom;
    }
    public function getFlyingTo()
    {
        return $this->flyingTo;
    }
    public function setFlyingTo($flyingTo)
    {
        $this->flyingTo = $flyingTo;
    }
    public function getFlyingAgencyName()
    {
        return $this->flyingAgencyName;
    }
    public function setFlyingAgencyName($flyingAgencyName)
    {
        $this->flyingAgencyName = $flyingAgencyName;
    }
}

?>