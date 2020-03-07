<?php
declare(strict_types=1);

namespace App\Entities;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="email", columns={"email"}),
 * })
 */
class User extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="api_key", type="string", length=64, nullable=true)
     */
    protected $apiKey;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    protected $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=20, nullable=true)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", nullable=true)
     */
    protected $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=20, nullable=true)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile_number", type="string", nullable=false)
     */
    protected $mobileNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60, nullable=false)
     */
    protected $password;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Todo", mappedBy="user")
     */
    protected $todos;

    /**
     * Todo constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();

        $this->todos = new ArrayCollection();
    }

    /**
     * @param \App\Entities\Todo $todo
     *
     * @return \App\Entities\User
     */
    public function addTodo(Todo $todo): self
    {
        if ($this->todos->contains($todo) === false) {
            $this->todos->add($todo);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * @return DateTime|null
     */
    public function getBirthday(): ?DateTime
    {
        return $this->birthday;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getMobileNumber(): ?string
    {
        return $this->mobileNumber;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $todos
     *
     * @return self
     */
    public function getTodos(?Collection $todos = null): self
    {
        $this->todos = $todos;

        return $this;
    }

    /**
     * @param string|null $apiKey
     *
     * @return self
     */
    public function setApiKey(?string $apiKey = null): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @param DateTime|null $birthday
     *
     * @return self
     */
    public function setBirthday(?DateTime $birthday = null): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @param string|null $email
     *
     * @return self
     */
    public function setEmail(?string $email = null): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string|null $firstName
     *
     * @return self
     */
    public function setFirstName(?string $firstName = null): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @param string|null $gender
     *
     * @return self
     */
    public function setGender(?string $gender = null): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @param string|null $lastName
     *
     * @return self
     */
    public function setLastName(?string $lastName = null): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @param string|null $mobileNumber
     *
     * @return self
     */
    public function setMobileNumber(?string $mobileNumber = null): self
    {
        $this->mobileNumber = $mobileNumber;

        return $this;
    }

    /**
     * @param string|null $password
     *
     * @return self
     */
    public function setPassword(?string $password = null): self
    {
        $this->password = $password;

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
            'firstname' => $this->firstName,
            'lastname' => $this->lastName,
            'mobile' => $this->mobileNumber,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'email' => $this->email,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
