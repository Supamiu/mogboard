<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="alerts")
 * @ORM\Entity(repositoryClass="App\Repository\AlertRepository")
 */
class Alert
{
    const TRIGGER_MIN_PRICE = 1;
    const TRIGGER_MAX_PRICE = 2;
    const TRIGGER_AVG_PRICE = 3;
    const TRIGGER_MIN_STOCK = 10;
    const TRIGGER_MAX_STOCK = 11;
    const TRIGGER_MIN_QTY   = 20;
    const TRIGGER_MAX_QTY   = 21;

    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="alerts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @var AlertItem
     * @ORM\ManyToOne(targetEntity="AlertItem", inversedBy="alerts")
     * @ORM\JoinColumn(name="alert_item_id", referencedColumnName="id")
     */
    private $alertItem;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $added;
    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private $name;
    /**
     * @var int
     * @ORM\Column(type="integer", length=3)
     */
    private $triggerOption;
    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $triggerValue;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $triggerLimit;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $triggerDelay = 300;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $triggerLastSent = 0;
    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $notifiedViaDesktop = false;
    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $notifiedViaEmail = false;
    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $notifiedViaDiscord = false;
    
    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->added = time();
    }
    
    public function getId(): string
    {
        return $this->id;
    }
    
    public function setId(string $id)
    {
        $this->id = $id;
        
        return $this;
    }
    
    public function getUser(): User
    {
        return $this->user;
    }
    
    public function setUser(User $user)
    {
        $this->user = $user;
        
        return $this;
    }
    
    public function getAlertItem(): AlertItem
    {
        return $this->alertItem;
    }
    
    public function setAlertItem(AlertItem $alertItem)
    {
        $this->alertItem = $alertItem;
        
        return $this;
    }
    
    public function getAdded(): int
    {
        return $this->added;
    }
    
    public function setAdded(int $added)
    {
        $this->added = $added;
        
        return $this;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function setName(string $name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    public function getTriggerOption(): int
    {
        return $this->triggerOption;
    }
    
    public function setTriggerOption(int $triggerOption)
    {
        $this->triggerOption = $triggerOption;
        
        return $this;
    }
    
    public function getTriggerValue(): string
    {
        return $this->triggerValue;
    }
    
    public function setTriggerValue(string $triggerValue)
    {
        $this->triggerValue = $triggerValue;
        
        return $this;
    }
    
    public function getTriggerLimit(): int
    {
        return $this->triggerLimit;
    }
    
    public function setTriggerLimit(int $triggerLimit)
    {
        $this->triggerLimit = $triggerLimit;
        
        return $this;
    }
    
    public function getTriggerDelay(): int
    {
        return $this->triggerDelay;
    }
    
    public function setTriggerDelay(int $triggerDelay)
    {
        $this->triggerDelay = $triggerDelay;
        
        return $this;
    }
    
    public function getTriggerLastSent(): int
    {
        return $this->triggerLastSent;
    }
    
    public function setTriggerLastSent(int $triggerLastSent)
    {
        $this->triggerLastSent = $triggerLastSent;
        
        return $this;
    }
    
    public function isNotifiedViaDesktop(): bool
    {
        return $this->notifiedViaDesktop;
    }
    
    public function setNotifiedViaDesktop(bool $notifiedViaDesktop)
    {
        $this->notifiedViaDesktop = $notifiedViaDesktop;
        
        return $this;
    }
    
    public function isNotifiedViaEmail(): bool
    {
        return $this->notifiedViaEmail;
    }
    
    public function setNotifiedViaEmail(bool $notifiedViaEmail)
    {
        $this->notifiedViaEmail = $notifiedViaEmail;
        
        return $this;
    }
    
    public function isNotifiedViaDiscord(): bool
    {
        return $this->notifiedViaDiscord;
    }
    
    public function setNotifiedViaDiscord(bool $notifiedViaDiscord)
    {
        $this->notifiedViaDiscord = $notifiedViaDiscord;
        
        return $this;
    }
}
