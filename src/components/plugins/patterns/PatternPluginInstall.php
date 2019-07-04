<?php
namespace extas\components\plugins\patterns;

use extas\components\patterns\Pattern;
use extas\components\plugins\PluginInstallDefault;
use extas\interfaces\patterns\IPatternRepository;

/**
 * Class PatternPluginInstall
 *
 * @package extas\components\plugins\patterns
 * @author jeyroik@gmail.com
 */
class PatternPluginInstall extends PluginInstallDefault
{
    const FIELD__PATTERNS = 'patterns';

    protected $selfItemClass = Pattern::class;
    protected $selfName = 'pattern';
    protected $selfSection = 'patterns';
    protected $selfUID = Pattern::FIELD__NAME;
    protected $selfRepositoryClass = IPatternRepository::class;
}
