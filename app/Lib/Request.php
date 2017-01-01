<?php namespace nearMe\Lib;

/**
 * Class Request
 * @package nearMe\Lib
 */
class Request {

    /**
     * Determine if the request was sent via the XMLHttpRequest object.
     *
     * @return bool
     */
    public function isAjax()
    {
        return (
            (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) &&
            ('xmlhttprequest' === strtolower($_SERVER['HTTP_X_REQUESTED_WITH']))
        );
    }

    /**
     * Check if the request was submitted via POST.
     *
     * @return bool
     */
    public function isPost()
    {
        return ('POST' === $_SERVER['REQUEST_METHOD']);
    }

    /**
     * Check if the request was submitted via GET.
     *
     * @return bool
     */
    public function isGet()
    {
        return ('GET' === $_SERVER['REQUEST_METHOD']);
    }

    protected function _sanitizeInput()
    {
        return $this;
    }

    public function getRequest()
    {
        return $this->_sanitizeInput();
    }

    public function getRawRequest()
    {
        return $this;
    }
}
