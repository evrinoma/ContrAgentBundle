<?php

namespace Evrinoma\ContrAgentBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\ActiveInterface;
use Evrinoma\UtilsBundle\Entity\ActiveTrait;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtTrait;

/**
 * Class AbstractBaseContrAgent
 *
 * @package Evrinoma\ContrAgentBundle\Model
 * @ORM\MappedSuperclass
 */
abstract class AbstractBaseContrAgent implements ActiveInterface
{
    use ActiveTrait, CreateUpdateAtTrait;

//region SECTION: Fields
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", length=255, nullable=false)
     */
    private $shortName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="full_name", type="string", length=255, nullable=true)
     */
    private $fullName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inn", type="string", length=255, nullable=true)
     */
    private $inn;
//endregion Fields

//region SECTION: Getters/Setters
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * @return string|null
     */
    public function getInn(): ?string
    {
        return $this->inn;
    }
//endregion Getters/Setters
}
