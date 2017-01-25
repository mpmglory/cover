<?php

namespace PW\QCMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QCM
 *
 * @ORM\Table(name="qcm")
 * @ORM\Entity(repositoryClass="PW\QCMBundle\Repository\QCMRepository")
 */
class QCM
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
     * @var bool
     *
     * @ORM\Column(name="validated", type="boolean")
     */
    private $validated;

    /**
     * @var string
     *
     * @ORM\Column(name="enonce", type="text")
     */
    private $enonce;

    /**
     * @var string
     *
     * @ORM\Column(name="propoA", type="string", length=255)
     */
    private $propoA;

    /**
     * @var string
     *
     * @ORM\Column(name="propoB", type="string", length=255)
     */
    private $propoB;

    /**
     * @var string
     *
     * @ORM\Column(name="propoC", type="string", length=255)
     */
    private $propoC;

    /**
     * @var string
     *
     * @ORM\Column(name="propoD", type="string", length=255, nullable=true)
     */
    private $propoD;

    /**
     * @var string
     *
     * @ORM\Column(name="propoE", type="string", length=255, nullable=true)
     */
    private $propoE;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="string", length=255)
     */
    private $reponse;

    /**
     * @var string
     *
     * @ORM\Column(name="Explication", type="text")
     */
    private $explication;

    /**
     * @var string
     *
     * @ORM\Column(name="urlPhoto", type="string", length=255, nullable=true)
     */
    private $urlPhoto;

    /**
     * @ORM\ManyToOne(targetEntity="PW\QCMBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="PW\QCMBundle\Entity\QCMGroup")
     * @ORM\JoinColumn(nullable=true)
     */
    private $qcmgroup;


    public function __construct()
    {
        $this->date = new \Datetime();
        $this->validated = false;
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
     * @return QCM
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
     * Set validated
     *
     * @param boolean $validated
     * @return QCM
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;

        return $this;
    }

    /**
     * Get validated
     *
     * @return boolean 
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * Set enonce
     *
     * @param string $enonce
     * @return QCM
     */
    public function setEnonce($enonce)
    {
        $this->enonce = $enonce;

        return $this;
    }

    /**
     * Get enonce
     *
     * @return string 
     */
    public function getEnonce()
    {
        return $this->enonce;
    }

    /**
     * Set propoA
     *
     * @param string $propoA
     * @return QCM
     */
    public function setPropoA($propoA)
    {
        $this->propoA = $propoA;

        return $this;
    }

    /**
     * Get propoA
     *
     * @return string 
     */
    public function getPropoA()
    {
        return $this->propoA;
    }

    /**
     * Set propoB
     *
     * @param string $propoB
     * @return QCM
     */
    public function setPropoB($propoB)
    {
        $this->propoB = $propoB;

        return $this;
    }

    /**
     * Get propoB
     *
     * @return string 
     */
    public function getPropoB()
    {
        return $this->propoB;
    }

    /**
     * Set propoC
     *
     * @param string $propoC
     * @return QCM
     */
    public function setPropoC($propoC)
    {
        $this->propoC = $propoC;

        return $this;
    }

    /**
     * Get propoC
     *
     * @return string 
     */
    public function getPropoC()
    {
        return $this->propoC;
    }

    /**
     * Set propoD
     *
     * @param string $propoD
     * @return QCM
     */
    public function setPropoD($propoD)
    {
        $this->propoD = $propoD;

        return $this;
    }

    /**
     * Get propoD
     *
     * @return string 
     */
    public function getPropoD()
    {
        return $this->propoD;
    }

    /**
     * Set propoE
     *
     * @param string $propoE
     * @return QCM
     */
    public function setPropoE($propoE)
    {
        $this->propoE = $propoE;

        return $this;
    }

    /**
     * Get propoE
     *
     * @return string 
     */
    public function getPropoE()
    {
        return $this->propoE;
    }

    /**
     * Set explication
     *
     * @param string $explication
     * @return QCM
     */
    public function setExplication($explication)
    {
        $this->explication = $explication;

        return $this;
    }

    /**
     * Get explication
     *
     * @return string 
     */
    public function getExplication()
    {
        return $this->explication;
    }

    /**
     * Set urlPhoto
     *
     * @param string $urlPhoto
     * @return QCM
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
     * Set reponse
     *
     * @param string $reponse
     * @return QCM
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string 
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set user
     *
     * @param \PW\QCMBundle\Entity\User $user
     * @return QCM
     */
    public function setUser(\PW\QCMBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PW\QCMBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set qcmgroup
     *
     * @param \PW\QCMBundle\Entity\QCMGroup $qcmgroup
     * @return QCM
     */
    public function setQcmgroup(\PW\QCMBundle\Entity\QCMGroup $qcmgroup)
    {
        $this->qcmgroup = $qcmgroup;

        return $this;
    }

    /**
     * Get qcmgroup
     *
     * @return \PW\QCMBundle\Entity\QCMGroup 
     */
    public function getQcmgroup()
    {
        return $this->qcmgroup;
    }
}
