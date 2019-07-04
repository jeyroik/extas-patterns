<?php
namespace extas\interfaces\patterns;

use extas\interfaces\IItem;

/**
 * Interface IPattern
 *
 * @package extas\interfaces\patterns
 * @author jeyroik@gmail.com
 */
interface IPattern extends IItem
{
    const SUBJECT = 'extas.pattern';

    const FIELD__NAME = 'name';
    const FIELD__DESCRIPTION = 'description';
    const FIELD__VERSION = 'version';
    const FIELD__SCHEMA = 'schema';

    const STAGE__IMPORT = 'extas.pattern.import';

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return string
     */
    public function getVersion(): string;

    /**
     * @return mixed
     */
    public function getSchema();

    /**
     * @return mixed
     */
    public function getImportedData();

    /**
     * @param $name string
     *
     * @return $this
     */
    public function setName($name);

    /**
     * @param $description string
     *
     * @return $this
     */
    public function setDescription($description);

    /**
     * @param $version
     *
     * @return $this
     */
    public function setVersion($version);

    /**
     * @param $schema
     *
     * @return $this
     */
    public function setSchema($schema);

    /**
     * @param $name string
     *
     * @return bool
     */
    public function hasParam($name): bool;

    /**
     * @param string $name
     * @param mixed $default
     *
     * @return mixed
     */
    public function getParam($name, $default = null);

    /**
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function setParam($name, $value);

    /**
     * @param $data
     *
     * @return $this
     */
    public function import($data);

    /**
     * @param array $data
     * @param $pattern
     *
     * @return bool|mixed
     */
    public function isValid($data = [], $pattern = []): bool;
}
