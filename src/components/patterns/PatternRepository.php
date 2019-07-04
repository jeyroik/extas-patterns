<?php
namespace extas\components\patterns;

use extas\components\repositories\Repository;
use extas\interfaces\patterns\IPatternRepository;

/**
 * Class PatternRepository
 *
 * @package extas\components\patterns
 * @author jeyroik@gmail.com
 */
class PatternRepository extends Repository implements IPatternRepository
{
    protected $itemClass = Pattern::class;
    protected $pk = Pattern::FIELD__NAME;
    protected $scope = 'extas';
    protected $name = 'patterns';
    protected $idAs = '';
}
