<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SubFile
 *
 * @ORM\Table(name="sub_file")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubFileRepository")
 */
class SubFile
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
     * @ORM\Column(name="nameFile", type="string", length=255, unique=true)
     */
    private $nameFile;

    /**
     * @var string
     *
     * @ORM\Column(name="extensionFile", type="string", length=5, unique=false)
     */
    private $extensionFile;

    /**
     * @var string
     *
     * @ORM\Column(name="brochureFileName", type="string", length=255, unique=true)
     */
    private $brochureFileName;

    /**
     * @var string
     * @ORM\Column(name="createdAt", type="string", length=10, unique=false)
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="subjectName", type="string", length=20, unique=false)
     */
    private $subjectName;


    /**
     * @return string
     */
    public function getSubjectName()
    {
        return $this->subjectName;
    }

    /**
     * @param string $subjectName
     */
    public function setSubjectName($subjectName)
    {
        $this->subjectName = $subjectName;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
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
     * Set nameFile
     *
     * @param string $nameFile
     *
     * @return SubFile
     */
    public function setNameFile($nameFile)
    {
        $this->nameFile = $nameFile;

        return $this;
    }

    /**
     * Get nameFile
     *
     * @return string
     */
    public function getNameFile()
    {
        return $this->nameFile;
    }

    /**
     * Set extensionFile
     *
     * @param string $extensionFile
     *
     * @return SubFile
     */
    public function setExtensionFile($extensionFile)
    {
        $this->extensionFile = $extensionFile;

        return $this;
    }

    /**
     * Get extensionFile
     *
     * @return string
     */
    public function getExtensionFile()
    {
        return $this->extensionFile;
    }

    /**
     * Set brochureFileName
     *
     * @param string $brochureFileName
     *
     * @return SubFile
     */
    public function setBrochureFileName($brochureFileName)
    {
        $this->brochureFileName = $brochureFileName;

        return $this;
    }

    /**
     * Get brochureFileName
     *
     * @return string
     */
    public function getBrochureFileName()
    {
        return $this->brochureFileName;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
    }
}
