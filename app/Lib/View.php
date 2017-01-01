<?php namespace nearMe\Lib;

/**
 * Class View
 * @package nearMe\Lib
 */
class View {

    /**
     * Include a view with optional data
     *
     * @param $view -  Filename of view, minus path and extension.
     * @param null $data - Data to be sent to view.
     */
    public function make($view, $data = null)
    {
        //TODO - Add check for file and filetype here
        $file = '../src/views/' . $view . '.php';
        include($file);
    }
}