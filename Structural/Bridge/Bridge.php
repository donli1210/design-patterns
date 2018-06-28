<?php
/*
http://designpatternsphp.readthedocs.io/en/latest/Structural/Bridge/README.html
https://github.com/kamranahmedse/design-patterns-for-humans#-bridge
Bridge pattern is about preferring composition over inheritance. 
Implementation details are pushed from a hierarchy to another object with a separate hierarchy.

The example below,
The implementation details are pushed to PlainTextFormatter, HtmlFormatter.

*/

// FormatterInterface.php

namespace DesignPatterns\Structural\Bridge;

interface FormatterInterface
{
    public function format(string $text);
}

// PlainTextFormatter.php

namespace DesignPatterns\Structural\Bridge;

class PlainTextFormatter implements FormatterInterface
{
    public function format(string $text)
    {
        return $text;
    }
}

// HtmlFormatter.php

namespace DesignPatterns\Structural\Bridge;

class HtmlFormatter implements FormatterInterface
{
    public function format(string $text)
    {
        return sprintf('<p>%s</p>', $text);
    }
}

// Service.php

namespace DesignPatterns\Structural\Bridge;

abstract class Service
{
    /**
     * @var FormatterInterface
     */
    protected $implementation;

    /**
     * @param FormatterInterface $printer
     */
    public function __construct(FormatterInterface $printer)
    {
        $this->implementation = $printer;
    }

    /**
     * @param FormatterInterface $printer
     */
    public function setImplementation(FormatterInterface $printer)
    {
        $this->implementation = $printer;
    }

    abstract public function get();
}

// HelloWorldService.php

namespace DesignPatterns\Structural\Bridge;

class HelloWorldService extends Service
{
    public function get()
    {
        return $this->implementation->format('Hello World');
    }
}

// Tests

namespace DesignPatterns\Structural\Bridge\Tests;

use DesignPatterns\Structural\Bridge\HelloWorldService;
use DesignPatterns\Structural\Bridge\HtmlFormatter;
use DesignPatterns\Structural\Bridge\PlainTextFormatter;
use PHPUnit\Framework\TestCase;

class BridgeTest extends TestCase
{
    public function testCanPrintUsingThePlainTextPrinter()
    {
        $service = new HelloWorldService(new PlainTextFormatter());
        $this->assertEquals('Hello World', $service->get());

        // now change the implementation and use the HtmlFormatter instead
        $service->setImplementation(new HtmlFormatter());
        $this->assertEquals('<p>Hello World</p>', $service->get());
    }
}