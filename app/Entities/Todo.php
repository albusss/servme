<?php
declare(strict_types=1);

namespace App\Entities;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="todos")
 */
class Todo extends AbstractEntity
{
    /**
     * @var \App\Entities\Category
     *
     * @ORM\ManyToOne(targetEntity="Category", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_time", type="datetime", nullable=false)
     */
    protected $deadline;

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
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    protected $status;

    /**
     * @var \App\Entities\User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="todos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

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
    public function getDeadline(): ?DateTime
    {
        return $this->deadline;
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
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return \App\Entities\User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
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
     * @param DateTime|null $deadline
     *
     * @return self
     */
    public function setDeadline(?DateTime $deadline = null): self
    {
        $this->deadline = $deadline;

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
     * @param string|null $status
     *
     * @return self
     */
    public function setStatus(?string $status = null): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param \App\Entities\User|null $user
     *
     * @return self
     */
    public function setUser(?User $user = null): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Transforms to array.
     *
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category->getId(),
            'user' => $this->user->getId(),
            'status' => $this->status,
            'deadline' => $this->deadline->format(DateTimeInterface::ATOM),
            'createdAt' => $this->createdAt->format(DateTimeInterface::ATOM),
            'updatedAt' => $this->updatedAt->format(DateTimeInterface::ATOM),
        ];
    }
}
