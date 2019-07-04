<?php
namespace extas\components\patterns;

use extas\interfaces\patterns\IPattern;
use extas\components\Item;

/**
 * Class Pattern
 *
 * @package extas\components\patterns
 * @author jeyroik@gmail.com
 */
class Pattern extends Item implements IPattern
{
    protected $importedData = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->config[static::FIELD__NAME] ?? '';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->config[static::FIELD__DESCRIPTION] ?? '';
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->config[static::FIELD__VERSION] ?? '';
    }

    /**
     * @param string $name
     * @param mixed $default
     *
     * @return mixed
     */
    public function getParam($name, $default = null)
    {
        return $this->config[$name] ?? $default;
    }

    /**
     * @return array|mixed
     */
    public function getSchema()
    {
        return $this->config[static::FIELD__SCHEMA] ?? [];
    }

    /**
     * @return mixed
     */
    public function getImportedData()
    {
        return $this->importedData;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasParam($name): bool
    {
        return isset($this->config[$name]);
    }

    /**
     * @param string $name
     *
     * @return $this|IPattern
     */
    public function setName($name)
    {
        $this->config[static::FIELD__NAME] = $name;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return $this|IPattern
     */
    public function setDescription($description)
    {
        $this->config[static::FIELD__DESCRIPTION] = $description;

        return $this;
    }

    /**
     * @param $version
     *
     * @return $this|IPattern
     */
    public function setVersion($version)
    {
        $this->config[static::FIELD__VERSION] = $version;

        return $this;
    }

    /**
     * @param $schema
     *
     * @return $this|IPattern
     */
    public function setSchema($schema)
    {
        $this->config[static::FIELD__SCHEMA] = $schema;

        return $this;
    }

    /**
     * @param $name
     * @param $value
     *
     * @return $this|IPattern
     */
    public function setParam($name, $value)
    {
        $this->config[$name] = $value;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this|IPattern
     */
    public function import($data)
    {
        $stage = $this->getSubjectForExtension() . '.import';
        foreach ($this->getPluginsByStage($stage) as $plugin) {
            $data = $plugin($data, $this);
        }

        $this->importedData = $data;

        return $this;
    }

    /**
     * @param array $data
     * @param $pattern
     *
     * @return bool|mixed
     */
    public function isValid($data = [], $pattern = []): bool
    {
        $data = empty($data) ? $this->getImportedData() : $data;
        $pattern = empty($pattern) ? $this->getSchema() : $pattern;

        $intersection = array_intersect_key($pattern, $data);

        if (count($intersection) == count($pattern)) {
            foreach ($pattern as $field => $content) {
                if (is_array($content)) {
                    if (!$this->isValid($data[$field], $content)) {
                        return false;
                    }
                }
            }
        }

        return true;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return $this->getName();
    }
}
