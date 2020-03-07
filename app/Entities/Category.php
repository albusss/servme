<?php
declare(strict_types=1);

namespace App\Entities;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="categories", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="name", columns={"name"})
 * })
 */
class Category extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    protected $name;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
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
     * Transform to array.
     *
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'createdAt' => $this->createdAt->format(DateTimeInterface::ATOM),
            'updatedAt' => $this->updatedAt->format(DateTimeInterface::ATOM),
        ];
    }
}
