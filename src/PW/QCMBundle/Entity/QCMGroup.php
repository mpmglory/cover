<?php

namespace PW\QCMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PW\QCMBundle\Entity\Matiere;

/**
 * QCMGroup
 *
 * @ORM\Table(name="qcm_group")
 * @ORM\Entity(repositoryClass="PW\QCMBundle\Repository\QCMGroupRepository")
 */
class QCMGroup
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="PW\QCMBundle\Entity\Matiere")
     * @ORM\JoinColumn(nullable=true)
     */
    private $matiere;


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
     * Set titre
     *
     * @param string $titre
     * @return QCMGroup
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return QCMGroup
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
     * @return QCMGroup
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
     * Set date
     *
     * @param \DateTime $date
     * @return QCMGroup
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
     * Set matiere
     *
     * @param \PW\QCMBundle\Entity\Matiere $matiere
     * @return QCMGroup
     */
    public function setMatiere(\PW\QCMBundle\Entity\Matiere $matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * Get matiere
     *
     * @return \PW\QCMBundle\Entity\Matiere 
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * Set image
     *
     * @param \PW\QCMBundle\Entity\Image $image
     * @return QCMGroup
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
