<?php
namespace extas\components\extensions\patterns;

use extas\interfaces\patterns\IPattern;
use extas\interfaces\patterns\IPatternBaseV2;
use extas\components\extensions\Extension;

/**
 * Class PatternExtensionBaseV2
 *
 * @package extas\components\extensions\patterns
 * @author jeyroik@gmail.com
 */
class PatternExtensionBaseV2 extends Extension implements IPatternBaseV2
{
    public $subject = 'extas.pattern.base.v2';

    public $name = 'extas.pattern.base.v2';
    public $description = '';
    public $version = '2.0.0';
    public $schema = [
        self::FIELD__VERSION => '<string>',
        self::FIELD__TOKEN => '<string>',
        self::FIELD__ACTION => '<string>',
        self::FIELD__DATA => '<object>'
    ];

    /**
     * @param IPattern|null $pattern
     *
     * @return string
     */
    public function getVersion(IPattern $pattern = null): string
    {
        $schema = $pattern->getSchema();

        return $schema[static::FIELD__VERSION] ?? '';
    }

    /**
     * @param IPattern|null $pattern
     *
     * @return string
     */
    public function getToken(IPattern $pattern = null): string
    {
        $schema = $pattern->getSchema();

        return $schema[static::FIELD__TOKEN] ?? '';
    }

    /**
     * @param IPattern|null $pattern
     *
     * @return string
     */
    public function getAction(IPattern $pattern = null): string
    {
        $schema = $pattern->getSchema();

        return $schema[static::FIELD__ACTION] ?? '';
    }

    /**
     * @param IPattern|null $pattern
     *
     * @return array|mixed
     */
    public function getData(IPattern $pattern = null)
    {
        $schema = $pattern->getSchema();

        return $schema[static::FIELD__DATA] ?? [];
    }
}
