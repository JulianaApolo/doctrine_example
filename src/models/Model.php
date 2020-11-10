<?php
namespace Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks as HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use Models\Vehicle;
use Models\Brand;

/**
 * @ORM\Entity
 * @ORM\Table(name="models")
 * @HasLifecycleCallbacks
 */
class Model extends BaseModel
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
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="Brand", inversedBy="models")
     */
    protected $brand;

    /**
     * @ORM\OneToMany(targetEntity="Vehicle", mappedBy="model")
     * @var Vehicles[] An ArrayCollection of Vehicles objects.
     */
    protected $vehicles;

    public function __construct()
    {
        parent::__construct();
        $this->vehicles = new ArrayCollection();
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBrand(Brand $brand)
    {
        $brand->addModel($this);
        $this->brand = $brand;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function addVehicle(Vehicle $vehicle)
    {
        $this->vehicles[] = $vehicle;
    }

    /**
     * Remove vehicle.
     *
     * @param \Vehicle $vehicle
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeVehicle(Vehicle $vehicle)
    {
        return $this->vehicles->removeElement($vehicle);
    }

    /**
     * Get vehicles.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }
}
