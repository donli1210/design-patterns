<?php
// Reference : http://designpatternsphp.readthedocs.io/en/latest/Creational/AbstractFactory/README.html

// In short, the Factory pattern has a default implementation in the factory class itself. 
// The Abstract Factory requires all sub-classes to implement their own version of the factory methods.

namespace DesignPatterns\Creational\AbstractFactory;

/**
 * In this case, the abstract factory is a contract for creating some components
 * for the web. There are two ways of rendering text: HTML and JSON
 */
abstract class AbstractFactory
{
    abstract public function createText(string $content): Text;
}


//JsonFactory.php

namespace DesignPatterns\Creational\AbstractFactory;

class JsonFactory extends AbstractFactory
{
    public function createText(string $content): Text
    {
        return new JsonText($content);
    }
}

//HtmlFactory.php


namespace DesignPatterns\Creational\AbstractFactory;

class HtmlFactory extends AbstractFactory
{
    public function createText(string $content): Text
    {
        return new HtmlText($content);
    }
}

//Text.php

namespace DesignPatterns\Creational\AbstractFactory;

abstract class Text
{
    /**
     * @var string
     */
    protected $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }
}


// JsonText.php

namespace DesignPatterns\Creational\AbstractFactory;

class JsonText extends Text
{
    // do something here
}

// HtmlText.php

namespace DesignPatterns\Creational\AbstractFactory;

class HtmlText extends Text
{
    // do something here
}

// Test

class AbstractFactoryTest extends TestCase
{
    public function testCanCreateHtmlText()
    {
        $factory = new HtmlFactory();
        $text = $factory->createText('foobar');

        $this->assertInstanceOf(HtmlText::class, $text);
    }

    public function testCanCreateJsonText()
    {
        $factory = new JsonFactory();
        $text = $factory->createText('foobar');

        $this->assertInstanceOf(JsonText::class, $text);
    }
}