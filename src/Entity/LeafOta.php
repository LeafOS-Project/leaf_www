<?php

namespace App\Entity;

use App\Repository\LeafOtaRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\GeneratedValue;

#[ORM\Entity(repositoryClass: LeafOtaRepository::class)]
class LeafOta {
    #[ORM\Column(length: 255)]
    private ?string $device = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?int $datetime = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\Id]
    #[ORM\Column(length: 255)]
    #[GeneratedValue(strategy: 'IDENTITY')]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    private ?string $romtype = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $size = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(length: 255)]
    private ?string $version = null;

    #[ORM\Column(length: 255)]
    private ?string $flavor = null;

    #[ORM\Column(length: 255)]
    private ?string $incremental = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $incremental_base = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $upgrade = null;

    public function getId(): ?string {
        return $this->id;
    }

    public function getDevice(): ?string {
        return $this->device;
    }

    public function setDevice(string $device): self {
        $this->device = $device;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface {
        $dateTime = new DateTime();
        $dateTime->setTimestamp($this->datetime);
        return $dateTime;
    }

    public function setDatetime(int $datetime): self {
        $this->datetime = $datetime;

        return $this;
    }

    public function getFilename(): ?string {
        return $this->filename;
    }

    public function setFilename(string $filename): self {
        $this->filename = $filename;

        return $this;
    }

    public function getRomtype(): ?string {
        return $this->romtype;
    }

    public function setRomtype(string $romtype): self {
        $this->romtype = $romtype;

        return $this;
    }

    public function getSize(): ?string {
        return $this->size;
    }

    public function setSize(string $size): self {
        $this->size = $size;

        return $this;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(string $url): self {
        $this->url = $url;

        return $this;
    }

    public function getVersion(): ?string {
        return $this->version;
    }

    public function setVersion(string $version): self {
        $this->version = $version;

        return $this;
    }

    public function getFlavor(): ?string {
        return $this->flavor;
    }

    public function setFlavor(string $flavor): self {
        $this->flavor = $flavor;

        return $this;
    }

    public function getIncremental(): ?string {
        return $this->incremental;
    }

    public function setIncremental(string $incremental): self {
        $this->incremental = $incremental;

        return $this;
    }

    public function getIncrementalBase(): ?string {
        return $this->incremental_base;
    }

    public function setIncrementalBase(string $incremental_base): self {
        $this->incremental_base = $incremental_base;

        return $this;
    }

    public function getUpgrade(): ?string {
        return $this->upgrade;
    }

    public function setUpgrade(?string $upgrade): self {
        $this->upgrade = $upgrade;

        return $this;
    }

    public function getRecoveryUrl(): ?string {
        $url = $this->getUrl();

        return str_replace('.zip', '-recovery.img', $url);
    }
}
