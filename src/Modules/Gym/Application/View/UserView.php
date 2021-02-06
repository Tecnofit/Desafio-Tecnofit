<?php

declare(strict_types=1);

namespace App\Modules\Gym\Application\View;

use DateTime;
use Ramsey\Uuid\UuidInterface;
use App\Infrastructure\View;

/**
 * Class UserView
 * @package App\Modules\Gym\Application\View
 */
class UserView extends View
{
    /**
     * @var int|null
     */
    private $profileId;

    /**
     * @var string|null
     */
    private $password;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $status;

    /**
     * @var string|null
     */
    private $firstName;

    /**
     * @var string|null
     */
    private $middleName;

    /**
     * @var string|null
     */
    private $lastName;

    /**
     * @var float|null
     */
    private $weight;

    /**
     * @var float|null
     */
    private $height;

    /**
     * @var string|null
     */
    private $photo;

    /**
     * @var string|null
     */
    private $birthDate;

    /**
     * UserView constructor.
     * @param int|null $id
     * @param UuidInterface|null $uuid
     * @param int|null $profileId
     * @param string|null $password
     * @param string|null $status
     * @param string|null $email
     * @param string|null $firstName
     * @param string|null $middleName
     * @param string|null $lastName
     * @param float|null $weight
     * @param float|null $height
     * @param string|null $photo
     * @param string|null $birthDate
     * @param DateTime|null $createdDateAt
     * @param DateTime|null $updatedDateAt
     * @param DateTime|null $deletedDateAt
     */
    public function __construct(
        ?int $id,
        ?UuidInterface $uuid,
        ?int $profileId,
        ?string $password,
        ?string $status,
        ?string $email,
        ?string $firstName,
        ?string $middleName,
        ?string $lastName,
        ?float $weight,
        ?float $height,
        ?string $photo,
        ?string $birthDate,
        ?DateTime $createdDateAt,
        ?DateTime $updatedDateAt,
        ?DateTime $deletedDateAt
    )
    {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->profileId = $profileId;
        $this->password = $password;
        $this->status = $status;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
        $this->weight = $weight;
        $this->height = $height;
        $this->photo = $photo;
        $this->birthDate = $birthDate;
        $this->createdAt = $createdDateAt;
        $this->updatedAt = $updatedDateAt;
        $this->deletedAt = $deletedDateAt;
    }

    /**
     * @return int|null
     */
    public function getProfileId(): ?int
    {
        return $this->profileId;
    }

    /**
     * @param int|null $profileId
     */
    public function setProfileId(?int $profileId): void
    {
        $this->profileId = $profileId;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @param string|null $middleName
     */
    public function setMiddleName(?string $middleName): void
    {
        $this->middleName = $middleName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return float|null
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * @param float|null $weight
     */
    public function setWeight(?float $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return float|null
     */
    public function getHeight(): ?float
    {
        return $this->height;
    }

    /**
     * @param float|null $height
     */
    public function setHeight(?float $height): void
    {
        $this->height = $height;
    }

    /**
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string|null $photo
     */
    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return string|null
     */
    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    /**
     * @param string|null $birthDate
     */
    public function setBirthDate(?string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @param array $params
     * @return UserView
     */
    public static function fromArray(array $params): UserView
    {
        return new self(
            $params['id'],
            $params['uuid'],
            $params['profile_id'],
            $params['password'],
            $params['status'],
            $params['email'],
            $params['first_name'],
            $params['middle_name'],
            $params['last_name'],
            $params['weight'],
            $params['height'],
            $params['photo'],
            $params['birth_date'],
            $params['created_at'],
            $params['updated_at'],
            $params['deleted_at']
        );
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid->toString(),
            'profile_id' => $this->profileId,
            'password' => $this->password,
            'status' => $this->status,
            'email' => $this->email,
            'first_name' => $this->firstName,
            'middle_name' => $this->middleName,
            'last_name' => $this->lastName,
            'weight' => $this->weight,
            'height' => $this->height,
            'photo' => $this->photo,
            'birth_date' => $this->birthDate,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt ? $this->updatedAt->format('Y-m-d H:i:s') : null,
            'deleted_at' => $this->deletedAt ? $this->deletedAt->format('Y-m-d H:i:s') : null
        ];
    }
}
