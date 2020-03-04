<?php
declare(strict_types=1);

namespace App\Entities;

use DateTime;
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
     * @var int
     *
     * @ORM\Column(name="mobile_number", type="integer", nullable=false)
     */
    protected $mobileNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60, nullable=false)
     */
    protected $password;

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
     * @return int|null
     */
    public function getMobileNumber(): ?int
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
     * @param int|null $mobileNumber
     *
     * @return self
     */
    public function setMobileNumber(?int $mobileNumber = null): self
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
}
