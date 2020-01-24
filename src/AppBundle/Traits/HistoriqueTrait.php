<?php


namespace AppBundle\Traits;


trait HistoriqueTrait
{

    /**
     * @var
     * @ORM\Column(name="last_update", type="datetime")
     */
    private $lastUpdate;

    /**
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * @param mixed $lastUpdate
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    }

    /**
     * @ORM\PreUpdate()
     */
    public  function  preUpdate() {
        $this->setLastUpdate(new \DateTime());

    }
}