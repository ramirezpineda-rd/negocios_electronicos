<?php
 namespace MailPoetVendor\Twig\Node; if (!defined('ABSPATH')) exit; use MailPoetVendor\Twig\Compiler; class FlushNode extends \MailPoetVendor\Twig\Node\Node { public function __construct($lineno, $tag) { parent::__construct([], [], $lineno, $tag); } public function compile(\MailPoetVendor\Twig\Compiler $compiler) { $compiler->addDebugInfo($this)->write("flush();\n"); } } \class_alias('MailPoetVendor\\Twig\\Node\\FlushNode', 'MailPoetVendor\\Twig_Node_Flush'); 