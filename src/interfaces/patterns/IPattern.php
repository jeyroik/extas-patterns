<?php
namespace extas\interfaces\patterns;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IHasVersion;
use extas\interfaces\IItem;

/**
 * Interface IPattern
 *
 * @package extas\interfaces\patterns
 * @author jeyroik@gmail.com
 */
interface IPattern extends IItem, IHasName, IHasDescription, IHasVersion
{
    const SUBJECT = 'extas.pattern';

    const FIELD__SCHEMA = 'schema';

    /**
     * @return mixed
     */
    public function getSchema();

    /**
     * @param $schema
     *
     * @return $this
     */
    public function setSchema($schema);

    /**
     * @return bool
     */
    public function isValid(): bool;
}
