# patterns

Данный пакет позволяет использовать функционал паттернов для Extas-совместимого проекта.

Паттерн - это аналог мапера данных.

# Установка

`composer require jeyroik/extas-patterns:*`

# Использование

Идея использования паттернов заключается в создании расширения для конкретного плагина.

Допустим, имеем массив
```php
$data = [
    'level1' => [
        'level2' => [
            'level3' => 'enough'
        ],
        'level2.1' => 'stop'
    ],
    'level1.1' => 'break'
];
``` 

## Создаём расширение

### Сначала интерфейс

```php
namespace my\extas\interafces\extensions;

interface ILevelsPatternExtension
{
    public function getLevel1(): array;
    public function getLevel1_1(): string;
    public function getLevel2(): array;
    public function getLevel2_1(): string;
    public function getLevel3(): string;
}
```

### Теперь само расширение

```php
namespace my\extas\components\extensions;

use extas\components\extensions\Extension;
use extas\interfaces\patterns\IPattern;

class LevelsPatternExtension extends Extension implements ILevelsPatternExtension
{
    public function getLevel1(IPattern $pattern = null)
    {
        $schema = $pattern->getImportedData();
        return $schema['level1'] ?? [];
    }
    
    public function getLevel1_1(IPattern $pattern)
    {
        $schema = $pattern->getImportedData();
        return $schema['level1.1'] ?? '';
    }
    
    public function getLevel2(IPattern $pattern = null)
    {
        $level1 = $this->getLevel1($pattern);
        return $level1['level2'] ?? [];
    }
    
    public function getLevel2_1(IPattern $pattern = null)
    {
        $level1 = $this->getLevel1($pattern);
        return $level1['level2.1'] ?? '';
    }
    
    public function getLevel3(IPattern $pattern = null)
    {
        $level2 = $this->getLevel2($pattern);
        return $level2['level3'] ?? '';
    }
}
```

## Добавляем расширение в пакет extas'a:

`subject` = `extas.pattern.<pattern.name>`

```json
{
  "extensions": [
    {
      "interface": "my\\extas\\interfaces\\extensions\\ILevelsPatternExtension",
      "class": "my\\extas\\components\\extensions\\ILevelsPatternExtension",
      "subject": "extas.pattern.levels",
      "methods": [
        "getLevel1",
        "getLevel1_1",
        "getLevel2",
        "getLevel2_1",
        "getLevel3"
      ]
    }
  ]
}
```

## Устанавливаем паттерн и расширение:

`/vendor/bin/extas i -p extas.json -s 0 -r 1`

## Применяем паттерн

```php
use \extas\components\patterns\Pattern;

$data = [
    'level1' => [
        'level2' => [
            'level3' => 'enough'
        ],
        'level2.1' => 'stop'
    ],
    'level1.1' => 'break'
];

$pattern = new Pattern([Pattern::FIELD__NAME => 'levels', Pattern::FIELD__SCHEMA => $data]);
echo $pattern->getLevel3(); // 'enough'
```