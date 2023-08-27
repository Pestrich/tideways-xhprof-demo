<?php

tideways_xhprof_enable(TIDEWAYS_XHPROF_FLAGS_MEMORY | TIDEWAYS_XHPROF_FLAGS_CPU);

function execute(int $i): int {
    return $i ** 2;
}

$iterations = 3000;

for ($i = 0; $i <= $iterations; $i++) {
    static $a;
    $a += execute($i);
}

final class User
{
    private int $id;
    private string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }
}

$user = new User(1, 'Vitaly');
$userId = $user->getId();
$userName = $user->getName();
$user->setId(2);
$user->setName('Dmitry');

function arrayValuesFromKeys($arr, $keys): array {
    return array_map(static fn ($x): string => $arr[$x], $keys);
}

$data = arrayValuesFromKeys(
    [
        'key1' => 'data1',
        'key2' => 'data2',
        'key3' => 'data3',
    ],
    [
        'key1',
        'key2',
    ]
);

$filePath = '/var/tmp/xhprof/' . uniqid() . '.xhprof_testing.xhprof';

echo "<pre>";
print_r($filePath);
echo "</pre>";

file_put_contents(
    $filePath,
    serialize(tideways_xhprof_disable())
);
