<?php
declare(strict_types=1);

namespace CosmonovaRnD\CasparCG\OSC\Message;

use CosmonovaRnD\CasparCG\EventManager;
use CosmonovaRnD\CasparCG\OSC\RawMessage;

/**
 * Class AbstractMessage
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\CasparCG\OSC\Message
 * Cosmonova | Research & Development
 */
abstract class AbstractMessage implements MessageInterface
{
    /** @var  string */
    public static $pattern;
    /** @var  EventManager */
    protected $eventManager;

    /**
     * @inheritdoc
     */
    abstract public static function create(RawMessage $message);

    /**
     * @return EventManager
     */
    public function getEventManager(): EventManager
    {
        return $this->eventManager;
    }

    /**
     * @param mixed $eventManager
     */
    public function setEventManager(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * @inheritDoc
     */
    public function dispatch()
    {
        $eventManager = $this->getEventManager();

        if ($eventManager) {
            $eventManager->dispatch(static::class, $this);
        }
    }
}
