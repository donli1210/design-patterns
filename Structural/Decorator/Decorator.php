<?php
// To dynamically add new functionality to class instances.

// RenderableInterface.php
namespace DesignPatterns\Structural\Decorator;

interface RenderableInterface
{
    public function renderData(): string;
}

// Webservice.php

namespace DesignPatterns\Structural\Decorator;

class Webservice implements RenderableInterface
{
    /**
     * @var string
     */
    private $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function renderData(): string
    {
        return $this->data;
    }
}

// RendererDecorator.php

namespace DesignPatterns\Structural\Decorator;

/**
 * the Decorator MUST implement the RenderableInterface contract, this is the key-feature
 * of this design pattern. If not, this is no longer a Decorator but just a dumb
 * wrapper.
 * 
 * This class is still a abstract class.
 * 
 */
abstract class RendererDecorator implements RenderableInterface
{
    /**
     * @var RenderableInterface
     */
    protected $wrapped;

    /**
     * @param RenderableInterface $renderer
     */
    public function __construct(RenderableInterface $renderer)
    {
        $this->wrapped = $renderer;
    }
}

// XmlRenderer.php

namespace DesignPatterns\Structural\Decorator;

class XmlRenderer extends RendererDecorator
{
    public function renderData(): string
    {
        $doc = new \DOMDocument();
        $data = $this->wrapped->renderData();
        $doc->appendChild($doc->createElement('content', $data));

        return $doc->saveXML();
    }
}

// JsonRenderer.php

namespace DesignPatterns\Structural\Decorator;

class JsonRenderer extends RendererDecorator
{
    public function renderData(): string
    {
        return json_encode($this->wrapped->renderData());
    }
}


namespace DesignPatterns\Structural\Decorator\Tests;

use DesignPatterns\Structural\Decorator;
use PHPUnit\Framework\TestCase;

class DecoratorTest extends TestCase
{
    /**
     * @var Decorator\Webservice
     */
    private $service;

    protected function setUp()
    {
        $this->service = new Decorator\Webservice('foobar');
    }

    public function testJsonDecorator()
    {
        $service = new Decorator\JsonRenderer($this->service);

        $this->assertEquals('"foobar"', $service->renderData());
    }

    public function testXmlDecorator()
    {
        $service = new Decorator\XmlRenderer($this->service);

        $this->assertXmlStringEqualsXmlString('<?xml version="1.0"?><content>foobar</content>', $service->renderData());
    }
}