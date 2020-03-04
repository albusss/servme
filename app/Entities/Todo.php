<?php
declare(strict_types=1);

namespace App\Entities;

use App\Entities\Traits\IdentifiableTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="todos")
 */
class Todo
{
    use IdentifiableTrait;

    /**
     * @var \App\Entities\Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_time", type="datetime", nullable=false)
     */
    protected $dateTime;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    protected $name;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", length=1, nullable=false)
     */
    protected $status;

    /**
     * @return \App\Entities\Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @return DateTime|null
     */
    public function getDateTime(): ?DateTime
    {
        return $this->dateTime;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param \App\Entities\Category|null $category
     *
     * @return self
     */
    public function setCategory(?Category $category = null): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @param DateTime|null $dateTime
     *
     * @return self
     */
    public function setDateTime(?DateTime $dateTime = null): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * @param string|null $description
     *
     * @return self
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param string|null $name
     *
     * @return self
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param int|null $status
     *
     * @return self
     */
    public function setStatus(?int $status = null): self
    {
        $this->status = $status;

        return $this;
    }
}
