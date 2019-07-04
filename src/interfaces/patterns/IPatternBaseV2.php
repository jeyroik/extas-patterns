<?php
namespace extas\interfaces\patterns;

/**
 * Interface IPatternBaseV2
 *
 * @package extas\interfaces\patterns
 * @author jeyroik@gmail.com
 */
interface IPatternBaseV2
{
    const FIELD__VERSION = 'version';
    const FIELD__TOKEN = 'token';
    const FIELD__ACTION = 'action';
    const FIELD__DATA = 'data';

    /**
     * @return string
     */
    public function getVersion(): string;

    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @return mixed
     */
    public function getData();
}
