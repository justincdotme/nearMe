<?php namespace nearMe\Lib\Session;

use nearMe\Lib\Session\Persistence\HttpPersistence;
use nearMe\Lib\Session\Persistence\ArrayPersistence;

/**
 * Class Session
 * @package nearMe\Lib\Session
 */
class Session implements SessionInterface
{
    /**
     * @var ArrayPersistence
     */
    protected $_sessionPersistence;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        //TODO - Use DI to set classes based on app context
        //For the web...
        $this->_sessionPersistence = new HttpPersistence();

        //Alternately for testing...
        $this->_sessionPersistence = new ArrayPersistence();
    }

    /**
     * Store a key value pair in session.
     *
     * @param $value
     * @return mixed|void
     */
    public function store($value)
    {
        return $this->_sessionPersistence->store($value);
    }

    /**
     * Flash a key value pair to session.
     * Persists for request lifecycle.
     *
     * @param $value
     * @return mixed|void
     */
    public function flash($value)
    {
        return $this->_sessionPersistence->flash($value);
    }

    /**
     * Pull a key value pair from session.
     * Removes the pair from session.
     *
     * @param $value
     * @return mixed|void
     */
    public function pull($value)
    {
        return $this->_sessionPersistence->pull($value);
    }

    /**
     * Delete a key value pair from session
     *
     * @param $value
     * @return mixed|void
     */
    public function delete($value)
    {
        return $this->_sessionPersistence->delete($value);
    }

    /**
     * Get a value for a given key.
     *
     * @param $key
     * @return mixed|void
     */
    public function get($key)
    {
        return $this->_sessionPersistence->get($key);
    }

    /**
     * @return mixed|void
     */
    public function destroy()
    {
        return $this->_sessionPersistence->destroy();
    }
}