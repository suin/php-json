<?php

declare(strict_types=1);

// Code before migrating from built-in functions to suin/json's functions.

namespace BeforeMigration {
    $json = json_encode([1, 2, 3]); // this is built-in function
    var_dump($json);

    $value = json_decode($json); // this is built-in function
    var_dump($value);

    // Output:
    // string(7) "[1,2,3]"
    // array(3) {
    //   [0]=>
    //   int(1)
    //   [1]=>
    //   int(2)
    //   [2]=>
    //   int(3)
    // }
}

// Code after migrating from built-in functions to suin/json's functions.

namespace AfterMigration {
    // Add these two lines to migrate:
    use function Suin\Json\json_decode;
    use function Suin\Json\json_encode;

    $json = json_encode([1, 2, 3]); // Now this is this library's function.
    var_dump($json);

    $value = json_decode($json); // Now this is this library's function.
    var_dump($value);

    // Output:
    // string(7) "[1,2,3]"
    // array(3) {
    //   [0]=>
    //   int(1)
    //   [1]=>
    //   int(2)
    //   [2]=>
    //   int(3)
    // }
}
