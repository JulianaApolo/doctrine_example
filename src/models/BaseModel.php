<?php
namespace Models;

use Doctrine\ORM\Mapping as ORM;

class BaseModel
{

    /**
     * @ORM\Column(type="datetime",name="creation_date")
     * @var DateTime
     */
    protected $creationDate;

    /**
     * @ORM\Column(type="datetime",name="modification_date",nullable=true)
     * @var DateTime
     */
    protected $modificationDate;

    public function __construct()
    {
        return;
    }

    /** @ORM\PrePersist */
    public function doStuffOnPrePersist()
    {
        $this->setCreationDate(new \DateTime("now"));
    }

    /** @ORM\PreUpdate */
    public function doStuffOnPreUpdate()
    {
        $this->setModificationDate(new \DateTime("now"));
    }

    public function populate(array $values)
    {
        foreach ($values as $attribute => $value) {
            $this->{'set' . ucfirst($attribute)}($value);
        }

        return $this;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;

        return $this;
    }

    public function getModificationDate()
    {
        return $this->modificationDate;
    }
}
