<?php
declare(strict_types=1);

namespace Doxadoxa\Soa\Services;

class Message
{
    private $object;
    private $action;
    private $data;

    private const EVENT_DELIMITER = '.';

    /**
     * @param array|string $payload
     * @return Message
     */
    static public function make($payload) : Message
    {
        if ( is_string($payload) ) {
            $payload = json_decode($payload, true);
        }

        if ( !is_array($payload) ) {
            throw new \ParseError('Payload parse error.');
        }

        return new Message($payload);
    }

    /**
     * Message constructor.
     * @param array $payload
     */
    public function __construct(array $payload)
    {
        if ( !isset($payload['event']) ) {
            throw new \ParseError("Event payload don't contains event element.");
        }

        try {
            list($object, $action) = explode(self::EVENT_DELIMITER, $payload['event']);
        } catch (\Exception $e) {
            throw new \ParseError("Event delimiter mismatch.");
        }

        $this->object = $object;
        $this->action = $action;

        if ( isset($payload['data']) ) {
            $this->data = $payload['data'];
        }
    }

    /**
     * @return mixed
     */
    public function object()
    {
        return $this->object;
    }

    /**
     * @return mixed
     */
    public function action()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'event' => $this->getObject() . self::EVENT_DELIMITER . $this->getAction(),
            'data' => $this->getData()
        ];
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }
}