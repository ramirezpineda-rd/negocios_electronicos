<?php
 namespace MailPoetVendor\Symfony\Component\DependencyInjection\Argument; if (!defined('ABSPATH')) exit; class TaggedIteratorArgument extends \MailPoetVendor\Symfony\Component\DependencyInjection\Argument\IteratorArgument { private $tag; public function __construct($tag) { parent::__construct([]); $this->tag = (string) $tag; } public function getTag() { return $this->tag; } } 