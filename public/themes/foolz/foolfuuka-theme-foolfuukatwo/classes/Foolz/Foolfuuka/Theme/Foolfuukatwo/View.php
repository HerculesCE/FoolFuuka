<?php

namespace Foolz\Foolfuuka\Theme\Foolfuukatwo;

use Foolz\Foolfuuka\Model\Radix;
use Symfony\Component\HttpFoundation\Request;

class View extends \Foolz\Theme\View {
    /**
     * @var null|Request
     */
    protected $request;

    /**
     * @var null|Radix
     */
    protected $radix;

    public function doBuild() {
        $this->request = $this->getBuilderParamManager()->getParam('request', null);
        $this->radix = $this->getBuilderParamManager()->getParam('radix', null);

        return parent::doBuild();
    }

    /**
     * Returns the Symfony request
     *
     * @return null|Request
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * Returns the Radix object
     *
     * @return Radix|null
     */
    public function getRadix() {
        return $this->radix;
    }

    /**
     * The base URL of the request
     *
     * @return string
     */
    public function getBaseUrl() {
        return $this->request->getBaseUrl();
    }

    /**
     * Takes a string or an array with the elements of the uri
     *
     * @param $uri string|array The path with slashes or the elements of the path
     * @return string The compiled URI
     */
    public function getUriForPath($uri) {
        return $this->request->getUriForPath('/'.(is_array($uri) ? implode('/', $uri) : trim($uri, '/'))).'/';
    }

    /**
     * Creates an uri relative to the Radix
     *
     * @param $uri string|array The path with slashes or the elements of the path
     * @return string The compiled URI
     */
    public function getRadixUri($uri = '') {
        return $this->request->getUriForPath('/'.$this->radix->shortname.'/'.(is_array($uri) ? implode('/', $uri) : trim($uri, '/'))).'/';
    }
}