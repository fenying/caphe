<?php
/**
 * File: apcu.php
 * Created Date: 2017年6月1日 下午4:32:07
 */
declare (strict_types = 1);

require  __DIR__ . '/../vendor/autoload.php';

function testAPCu() {

    $connection = \Caphe\Driver\APCu\Connection::connect();

    $reader = $connection->getReader();

    $writer = $connection->getWriter();

    $writer->removeAll();

    echo '# 1. Testing Caphe driver APCu:', PHP_EOL;

    # First roll

    echo PHP_EOL, '## 1.1. Testing add with not existing key', PHP_EOL, PHP_EOL;

    echo 'addInt        "/test/integer" -> ', $writer->addInt('/test/integer', 1123) ? 'OK' : 'Failed', PHP_EOL;

    echo 'getInt        "/test/integer" -> ', $reader->getInt('/test/integer'), PHP_EOL;

    echo 'addString     "/test/string"  -> ', $writer->addString('/test/string', 'this is a string') ? 'OK' : 'Failed', PHP_EOL;

    echo 'getString     "/test/string"  -> ', $reader->getString('/test/string'), PHP_EOL;

    echo 'addFloat      "/test/float"   -> ', $writer->addFloat('/test/float', 1.4) ? 'OK' : 'Failed', PHP_EOL;

    echo 'getFloat      "/test/float"   -> ', $reader->getFloat('/test/float'), PHP_EOL;

    echo 'addAny        "/test/array"   -> ', $writer->add('/test/array', [1, 2, 3, 4, '5']) ? 'OK' : 'Failed', PHP_EOL;

    echo 'getAny        "/test/array"   -> ', json_encode($reader->get('/test/array')), PHP_EOL;

    # Second roll

    echo PHP_EOL, '## 1.2. Testing set', PHP_EOL, PHP_EOL;

    echo 'setInt        "/test/integer" -> ', $writer->setInt('/test/integer', 5555) ? 'OK' : 'Failed', PHP_EOL;

    echo 'getInt        "/test/integer" -> ', $reader->getInt('/test/integer'), PHP_EOL;

    echo 'setString     "/test/string"  -> ', $writer->setString('/test/string', 'this is a new string') ? 'OK' : 'Failed', PHP_EOL;

    echo 'getString     "/test/string"  -> ', $reader->getString('/test/string'), PHP_EOL;

    echo 'setFloat      "/test/float"   -> ', $writer->setFloat('/test/float', 555.2) ? 'OK' : 'Failed', PHP_EOL;

    echo 'getFloat      "/test/float"   -> ', $reader->getFloat('/test/float'), PHP_EOL;

    echo 'setAny        "/test/array"   -> ', $writer->set('/test/array', [7, 6, 5, 4, ['f']]) ? 'OK' : 'Failed', PHP_EOL;

    echo 'getAny        "/test/array"   -> ', json_encode($reader->get('/test/array')), PHP_EOL;

    # Third roll

    echo PHP_EOL, '## 1.3. Testing add with existing key', PHP_EOL, PHP_EOL;

    echo 'addInt        "/test/integer" -> ', $writer->addInt('/test/integer', 1123) ? 'OK' : 'Failed', PHP_EOL;

    echo 'getInt        "/test/integer" -> ', $reader->getInt('/test/integer'), PHP_EOL;

    echo 'addString     "/test/string"  -> ', $writer->addString('/test/string', 'this is a string') ? 'OK' : 'Failed', PHP_EOL;

    echo 'getString     "/test/string"  -> ', $reader->getString('/test/string'), PHP_EOL;

    echo 'addFloat      "/test/float"   -> ', $writer->addFloat('/test/float', 1.4) ? 'OK' : 'Failed', PHP_EOL;

    echo 'getFloat      "/test/float"   -> ', $reader->getFloat('/test/float'), PHP_EOL;

    echo 'addAny        "/test/array"   -> ', $writer->add('/test/array', [1, 2, 3, 4, '5']) ? 'OK' : 'Failed', PHP_EOL;

    echo 'getAny        "/test/array"   -> ', json_encode($reader->get('/test/array')), PHP_EOL;

    # Forth roll

    echo PHP_EOL, '## 1.4. Testing CAS with equal value', PHP_EOL, PHP_EOL;

    echo 'casInt        "/test/integer" -> ', $writer->cas('/test/integer', 5555, 666) ? 'OK' : 'Failed', PHP_EOL;

    echo 'getInt        "/test/integer" -> ', $reader->getInt('/test/integer'), PHP_EOL;

    # Fifth roll

    echo PHP_EOL, '## 1.5. Testing CAS with not equal value', PHP_EOL, PHP_EOL;

    echo 'casInt        "/test/integer" -> ', $writer->cas('/test/integer', 5555, 666) ? 'OK' : 'Failed', PHP_EOL;

    echo 'getInt        "/test/integer" -> ', $reader->getInt('/test/integer'), PHP_EOL;

}

testAPCu();
