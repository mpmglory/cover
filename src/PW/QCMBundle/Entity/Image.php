<?php

namespace PW\QCMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="PW\QCMBundle\Repository\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Image
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
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;

    private $file;

    private $tempFilename;


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
     * Set url
     *
     * @param string $url
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
       return $this->file = $file;
    }

     /**
    * @ORM\PrePersist()
    * @ORM\PreUpdate()
    */
    public function preUpload(){

            if(null === $this->getFile()){
                return;
            }

            $this->url = $this->getFile()->guessExtension();
            $this->alt = $this->getFile()->getClientOriginalName();
    }

    /**
    * @ORM\PostPersist()
    * @ORM\PostUpdate()
    */
    public function upload(){

            if(null === $this->getFile()){
                return;
            }

            if(null !== $this->tempFilename){
                
                $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;

                if(file_exist($oldFile)){
                    unlink($oldFile);
                }
            }

            $this->getFile()->move(
                $this->getUploadRootDir(),
                'qcm'.$this->id.'.'.$this->url
                );

    }

    /**
    * @ORM\PreRemove()
    */
    public function preRemoveUpload(){

            $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
    }

    /**
    * @ORM\PostRemove()
    */
    public function removeUpload(){

            if(file_exists($this->tempFilename)){
                unlink($this->tempFilename);
            }
    }

    public function getUploadDir(){

            return 'uploads/img';
    }

    protected function getUploadRootDir(){

            return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    public function getWebPath(){

            return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
    }

}
