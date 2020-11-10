<?php
namespace Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks as HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use Models\Model;
use Models\Rent;

/**
 * @ORM\Entity
 * @ORM\Table(name="vehicles")
 * @HasLifecycleCallbacks
 */
class Vehicle extends BaseModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(name="license_plate",type="string",length=7, unique=true, nullable=false)
     */
    protected $licensePlate;

     /**
     * @ORM\ManyToOne(targetEntity="Model", inversedBy="vehicles")
     */
    protected $model;

    /**
     * @ORM\OneToMany(targetEntity="Rent", mappedBy="vehicle")
     * @var Rents[] An ArrayCollection of Rents objects.
     */
    protected $rents;

    public function __construct()
    {
        parent::__construct();
        $this->rents = new ArrayCollection();
    }

    public function setLicensePlate($licensePlate)
    {
        $this->licensePlate = $licensePlate;
    }

    public function getLicensePlate()
    {
        return $this->licensePlate;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setModel(Model $model)
    {
        $model->addVehicle($this);
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function addRent(Rent $rent)
    {
        $this->rents[] = $rent;
    }
}
