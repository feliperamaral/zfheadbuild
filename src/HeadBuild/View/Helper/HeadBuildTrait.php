<?php

namespace HeadBuild\View\Helper;

use Zend\View\Exception\RuntimeException;
use Zend\View\Exception\InvalidArgumentException;

trait HeadBuildTrait {

    public $publicPath;
    public $manifestFile;
    private $_configs;

    /**
     * 
     * @param string $method Method to call
     * @param  array  $args   Arguments of method
     * @return \Zend\View\Helper\Placeholder\Container\AbstractStandalone
     * @throws RuntimeException if "rev-manifest.json" not exists
     * @throws InvalidArgumentException the file not exists in "rev-manisfest.json"
     */
    public function __call($method, $args) {

        if (preg_match('/build$/i', $method)) {
            $method = preg_replace('/build$/i', '', $method);

            if (is_string($args[0])) {
                $src = &$args[0];
            } else {
                $src = &$args[1];
            }
            $publicPath = $this->getPublicPath();
            $basePath = $this->getView()->basePath();
            $newSrc = trim(str_replace($basePath, '', $src), '\/');

            $manifestFile = $this->getManifestFile();

            $manifestPullPath = $publicPath . '/' . $manifestFile;

            if (is_file($manifestPullPath)) {
                $manifest = json_decode(file_get_contents($manifestPullPath), true);
            } else {
                throw new RuntimeException("The file \"{$manifestFile}\" not exists in \"{$publicPath}\"");
            }

            if (isset($manifest[$newSrc])) {
                $src = $this->getView()->basePath('build/' . $manifest[$newSrc]);
            } else {
                throw new InvalidArgumentException("The \"{$src}\" not exists in \"{$manifestFile}\"");
            }
        }
        return parent::__call($method, $args);
    }

    /**
     * @return string
     * @throws \RuntimeException
     */
    public function getPublicPath() {
        if ($this->publicPath) {
            return $this->publicPath;
        }
        $configs = $this->getConfigs();

        if (isset($configs['headbuild']['public_path'])) {
            $path = $configs['headbuild']['public_path'];

            if (!is_dir($path)) {
                throw new \RuntimeException("$path is not a valid path");
            }
        } else {
            $path = $this->generatePublicPath();
        }

        return $this->publicPath = trim($path, '\/');
    }

    private function getManifestFile() {
        if ($this->manifestFile) {
            return $this->manifestFile;
        }
        $configs = $this->getConfigs();
        if (isset($configs['headbuild']['manifest_file'])) {
            $path = trim($configs['headbuild']['manifest_file'], '\/');
        } else {
            $path = 'build\rev-manifest.json';
        }
        return $path;
    }

    private function getConfigs() {
        if ($this->_configs) {
            return $this->_configs;
        }
        return $this->_configs = $this->
                getView()->
                getHelperPluginManager()->
                getServiceLocator()->
                get('config');
    }

    /**
     * @return string
     */
    public function generatePublicPath() {
        $cwd = realpath(getcwd());
        $filename = realpath($_SERVER['SCRIPT_FILENAME']);

        $publicDir = preg_replace('/[^\\\\\/]*$/', '', str_replace($cwd, '', $filename));
        return realpath(trim($publicDir, '\/'));
    }

}
