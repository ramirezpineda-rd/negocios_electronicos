<?php
 namespace MailPoetVendor\Twig\TokenParser; if (!defined('ABSPATH')) exit; use MailPoetVendor\Twig\Node\FlushNode; use MailPoetVendor\Twig\Token; class FlushTokenParser extends \MailPoetVendor\Twig\TokenParser\AbstractTokenParser { public function parse(\MailPoetVendor\Twig\Token $token) { $this->parser->getStream()->expect(\MailPoetVendor\Twig\Token::BLOCK_END_TYPE); return new \MailPoetVendor\Twig\Node\FlushNode($token->getLine(), $this->getTag()); } public function getTag() { return 'flush'; } } \class_alias('MailPoetVendor\\Twig\\TokenParser\\FlushTokenParser', 'MailPoetVendor\\Twig_TokenParser_Flush'); 