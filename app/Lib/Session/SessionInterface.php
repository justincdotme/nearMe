<?php namespace nearMe\Lib\Session;


/**
 * Interface SessionInterface
 * @package nearMe\Lib\Session
 */
interface SessionInterface
{
    /**
     * @param $value
     * @return mixed
     */
    public function store($value);

    /**
     * @param $value
     * @return mixed
     */
    public function flash($value);

    /**
     * @param $value
     * @return mixed
     */
    public function pull($value);

    /**
     * @param $value
     * @return mixed
     */
    public function delete($value);

    /**
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * @return mixed
     */
    public function destroy();
}