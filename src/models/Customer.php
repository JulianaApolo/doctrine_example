<?php
namespace Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks as HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use Models\Rent;

/**
 * @ORM\Entity
 * @ORM\Table(name="customers")
 * @HasLifecycleCallbacks
 */
class Customer extends BaseModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Rent", mappedBy="customer")
     * @var Rents[] An ArrayCollection of Rents objects.
     */
    protected $rents;

    public function __construct()
    {
        parent::__construct();
        $this->rents = new ArrayCollection();
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function addRent(Rent $rent)
    {
        $this->rents[] = $rent;
    }
}
