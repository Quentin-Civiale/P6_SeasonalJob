<?php

namespace P6\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use P6\GeneralBundle\Annotation\Uploadable;
use P6\GeneralBundle\Annotation\UploadableField;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Seasonal
 *
 * @ORM\Table(name="seasonal")
 * @ORM\Entity(repositoryClass="P6\GeneralBundle\Repository\SeasonalRepository")
 * @Uploadable()
 */
class Seasonal extends User
{
//    const ROLE_SEASONAL = 'saisonnier';
    const ROLE_DEFAULT1 = 'ROLE_SEASONAL';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="resume_link", type="string", length=255, nullable=true)
     */
    protected $resumeLink;

    /**
     * @var string
     *
     * @ORM\Column(name="profilPicture", type="string", length=255, nullable=true)
     */
    protected $profilPicture;

//    /**
//     * @var File
//     *
//     * @UploadableField(filename="profilPicture", path="uploads/profilPicture")
//     */
//    protected $file;
//
//    /**
//     * @var \DateTime
//     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
//     */
//    protected $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $role = self::ROLE_DEFAULT1;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return parent::getId();
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Seasonal
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Seasonal
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set resumeLink
     *
     * @param string $resumeLink
     *
     * @return Seasonal
     */
    public function setResumeLink($resumeLink)
    {
        $this->resumeLink = $resumeLink;

        return $this;
    }

    /**
     * Get resumeLink
     *
     * @return string
     */
    public function getResumeLink()
    {
        return $this->resumeLink;
    }

    /**
     * Set profilPicture
     *
     * @param string $profilPicture
     *
     * @return Seasonal
     */
    public function setProfilPicture($profilPicture)
    {
        $this->profilPicture = $profilPicture;

        return $this;
    }

    /**
     * Get profilPicture
     *
     * @return string
     */
    public function getProfilPicture()
    {
        return $this->profilPicture;
    }


//    /**
//     * @return File|null
//     */
//    public function getFile()
//    {
//        $test = 'GetFile : '.$this->file;
//        dump($test);
//        return $this->file;
//    }
//
//    /**
//     * @param File $file|null
//     */
//    public function setFile($file)
//    {
//        $test = 'SetFile : '.$file;
//        dump($test);
//        $this->file = $file;
//    }

//    /**
//     * @param null|File $file
//     *
//     * @return Seasonal
//     * @throws Exception
//     */
//    public function setFile($file): self {
//        $this->file = $file;
//        if ( $this->file instanceof UploadedFile ) {
//            $this->updatedAt = new \DateTime( 'now' );
//        }
//
//        return $this;
//    }

//    /**
//     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file|null
//     *
//     * @return Seasonal
//     */
//    public function setFile(File $file = null)
//    {
//        $this->file = $file;
//
//        if ($file) {
//            $this->updatedAt = new \DateTimeImmutable();
//        }
//
//        return $this;
//    }

//    /**
//     * @return mixed
//     */
//    public function getUpdatedAt()
//    {
//        return $this->updatedAt;
//    }
//
//    /**
//     * @param mixed $updatedAt
//     */
//    public function setUpdatedAt($updatedAt)
//    {
//        $this->updatedAt = $updatedAt;
//    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Seasonal
     */
    public function setRole(string $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

//    /** @see \Serializable::serialize() */
//    public function serialize()
//    {
//        return serialize(array(
//            $this->id,
//            $this->profilPicture,
//
//        ));
//    }
//
//    /** @param $serialized
//     * @see \Serializable::unserialize()
//     */
//    public function unserialize($serialized)
//    {
//        list (
//            $this->id,
//            $this->profilPicture,
//
//            ) = unserialize($serialized, array('allowed_classes' => false));
//    }

    public function getFullName()
    {
        return $this->firstname.' '.$this->lastname;
    }

}

