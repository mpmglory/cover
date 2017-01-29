<?php

namespace PW\QCMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matiere
 *
 * @ORM\Table(name="matiere")
 * @ORM\Entity(repositoryClass="PW\QCMBundle\Repository\MatiereRepository")
 */
class Matiere
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="PW\QCMBundle\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="PW\QCMBundle\Entity\Concours")
     * @ORM\JoinColumn(nullable=true)
     */
    private $concours;



    public function __construct()
    {
        $this->date = new \Datetime();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Matiere
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Matiere
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
     * Set description
     *
     * @param string $description
     * @return Matiere
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set urlPhoto
     *
     * @param string $urlPhoto
     * @return Matiere
     */
    public function setUrlPhoto($urlPhoto)
    {
        $this->urlPhoto = $urlPhoto;

        return $this;
    }

    /**
     * Get urlPhoto
     *
     * @return string 
     */
    public function getUrlPhoto()
    {
        return $this->urlPhoto;
    }

    /**
     * Set concours
     *
     * @param \PW\QCMBundle\Entity\Concours $concours
     * @return Matiere
     */
    public function setConcours(\PW\QCMBundle\Entity\Concours $concours)
    {
        $this->concours = $concours;

        return $this;
    }

    /**
     * Get concours
     *
     * @return \PW\QCMBundle\Entity\Concours 
     */
    public function getConcours()
    {
        return $this->concours;
    }

    /**
     * Set image
     *
     * @param \PW\QCMBundle\Entity\Image $image
     * @return Matiere
     */
    public function setImage(\PW\QCMBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \PW\QCMBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
}
