<?php
namespace extas\components\patterns;

use extas\components\THasDescription;
use extas\components\THasName;
use extas\components\THasVersion;
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
    use THasName;
    use THasDescription;
    use THasVersion;

    /**
     * @return array|mixed
     */
    public function getSchema()
    {
        return $this->config[static::FIELD__SCHEMA] ?? [];
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
     * @return bool
     */
    public function isValid(): bool
    {
        $valid = true;
        $stage = $this->getSubjectForExtension() . '.validation';
        foreach ($this->getPluginsByStage($stage) as $plugin) {
            $plugin($this, $valid);
        }

        return $valid;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT . '.' . $this->getName();
    }
}
