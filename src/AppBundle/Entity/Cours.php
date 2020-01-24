<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cours
 *
 * @ORM\Table(name="cours")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoursRepository")
 */
class Cours
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;

    /**
     * @var int
     *
     * @ORM\Column(name="nbHeures", type="integer")
     */
    private $nbHeures;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return Cours
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set nbHeures
     *
     * @param integer $nbHeures
     *
     * @return Cours
     */
    public function setNbHeures($nbHeures)
    {
        $this->nbHeures = $nbHeures;

        return $this;
    }

    /**
     * Get nbHeures
     *
     * @return int
     */
    public function getNbHeures()
    {
        return $this->nbHeures;
    }

    public function __toString()
    {
        return $this->designation;
        // TODO: Implement __toString() method.
    }
}

