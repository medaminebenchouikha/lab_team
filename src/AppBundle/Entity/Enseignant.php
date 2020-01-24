<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Enseignant
 *
 * @ORM\Table(name="enseignant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EnseignantRepository")
 */
class Enseignant
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
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank(message="veuillez remplir ce champ")
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="cin", type="integer", unique=true)
     */
    private $cin;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Cours")
     */
    private $cours;

    /**
     * @var
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Section")
     */
    private $sections;

    /**
     * @var string
     * @ORM\Column(name="image",type="string", length=255)
     * @Assert\File(maxSize="1024k",
     *     mimeTypes={"image/jpeg","image/png"},
     *     maxSizeMessage="vous avez le drois que 1 mg",
     *     mimeTypesMessage="vous pouvez uploads que des jpg ou png")
     */
    private $image;

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    public function  NameImage()
    {
        return 'uploads/enseignants/'.$this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Enseignant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set cin
     *
     * @param integer $cin
     *
     * @return Enseignant
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return int
     */
    public function getCin()
    {
        return $this->cin;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sections = new ArrayCollection();
    }

    /**
     * Set cours
     *
     * @param \AppBundle\Entity\Cours $cours
     *
     * @return Enseignant
     */
    public function setCours(\AppBundle\Entity\Cours $cours = null)
    {
        $this->cours = $cours;

        return $this;
    }

    /**
     * Get cours
     *
     * @return \AppBundle\Entity\Cours
     */
    public function getCours()
    {
        return $this->cours;
    }

    /**
     * Add section
     *
     * @param \AppBundle\Entity\Section $section
     *
     * @return Enseignant
     */
    public function addSection(\AppBundle\Entity\Section $section)
    {
        $this->sections[] = $section;

        return $this;
    }

    /**
     * Remove section
     *
     * @param \AppBundle\Entity\Section $section
     */
    public function removeSection(\AppBundle\Entity\Section $section)
    {
        $this->sections->removeElement($section);
    }

    /**
     * Get sections
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSections()
    {
        return $this->sections;
    }
}
