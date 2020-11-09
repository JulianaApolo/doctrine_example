<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks as HasLifecycleCallbacks;

/**
 * @ORM\Entity
 * @ORM\Table(name="rents")
 * @HasLifecycleCallbacks
 */
class Rent extends BaseModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

     /**
     * @ORM\ManyToOne(targetEntity="Vehicle", inversedBy="rents")
     */
    protected $vehicle;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="rents")
     */
    protected $customer;

    /**
     * @ORM\Column(type="datetime",name="rent_date",nullable=false)
     * @var DateTime
     */
    protected $rentDate;

    /**
     * @ORM\Column(type="datetime",name="return_date",nullable=true)
     * @var DateTime
     */
    protected $returnDate;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rentDate.
     *
     * @param \DateTime $rentDate
     *
     * @return Rent
     */
    public function setRentDate($rentDate)
    {
        $this->rentDate = $rentDate;

        return $this;
    }

    /**
     * Get rentDate.
     *
     * @return \DateTime
     */
    public function getRentDate()
    {
        return $this->rentDate;
    }

    /**
     * Set returnDate.
     *
     * @param \DateTime $returnDate
     *
     * @return Rent
     */
    public function setReturnDate($returnDate)
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    /**
     * Get returnDate.
     *
     * @return \DateTime
     */
    public function getReturnDate()
    {
        return $this->returnDate;
    }

    public function setVehicle(Vehicle $vehicle)
    {
        $vehicle->addRent($this);
        $this->vehicle = $vehicle;
    }

    public function getVehicle()
    {
        return $this->vehicle;
    }

    public function setCustomer(Customer $customer)
    {
        $customer->addRent($this);
        $this->customer = $customer;
    }

    public function getCustomer()
    {
        return $this->customer;
    }
}
