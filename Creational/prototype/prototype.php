<?php
// To avoid the cost of creating objects the standard way (new Foo()) and instead create 
// a prototype and clone it.

// BookPrototype.php

namespace DesignPatterns\Creational\Prototype;

abstract class BookPrototype
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $category;

    // An object's __clone() method cannot be called directly.
    abstract public function __clone();

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
}

// BarBookPrototype.php


namespace DesignPatterns\Creational\Prototype;

class BarBookPrototype extends BookPrototype
{
    /**
     * @var string
     */
    protected $category = 'Bar';

    public function __clone()
    {
    }
}

// FooBookPrototype.php

namespace DesignPatterns\Creational\Prototype;

class FooBookPrototype extends BookPrototype
{
    /**
     * @var string
     */
    protected $category = 'Foo';

    public function __clone()
    {
    }
}

// Tests/PrototypeTest.php

namespace DesignPatterns\Creational\Prototype\Tests;

use DesignPatterns\Creational\Prototype\BarBookPrototype;
use DesignPatterns\Creational\Prototype\FooBookPrototype;
use PHPUnit\Framework\TestCase;

class PrototypeTest extends TestCase
{
    public function testCanGetFooBook()
    {
        $fooPrototype = new FooBookPrototype();
        $barPrototype = new BarBookPrototype();

        for ($i = 0; $i < 10; $i++) {
            // An object's __clone() method cannot be called directly.
            $book = clone $fooPrototype;
            $book->setTitle('Foo Book No ' . $i);
            $this->assertInstanceOf(FooBookPrototype::class, $book);
        }

        for ($i = 0; $i < 5; $i++) {
            $book = clone $barPrototype;
            $book->setTitle('Bar Book No ' . $i);
            $this->assertInstanceOf(BarBookPrototype::class, $book);
        }
    }
}
