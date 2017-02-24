<?php
/*
 * This file is a part of Mibew Slack Plugin.
 *
 * Copyright 2017 Derek McDaniel <dmcdaniel12@gmail.com>
 *
 */

namespace Mibew\Mibew\Plugin\Slack;

use Maknz\Slack\Client;
use Mibew\EventDispatcher\EventDispatcher;
use Mibew\EventDispatcher\Events;
use Symfony\Component\HttpFoundation\Request;

class Plugin extends \Mibew\Plugin\AbstractPlugin implements \Mibew\Plugin\PluginInterface
{
    public function __construct($config)
    {
        parent::__construct($config);

        // Use autoloader for Composer's packages that shipped with the plugin
        require(__DIR__ . '/vendor/autoload.php');
    }
	/**
	 * Initializer
	 * @return boolean
	 */
    public function initialized()
    {
        return true;
    }
	/**
	 * This creates the listener that listens for new
	 * threads to send out slack notifications
	 */
    public function run()
    {
        $dispatcher = EventDispatcher::getInstance();
        $dispatcher->attachListener(Events::THREAD_CREATE, $this, 'sendSlackNotification');
    }
	/**
	 * Sends notification to slack.
	 * Sends the date with the username as well
	 * @return boolean
	 */
    public function sendSlackNotification(&$args)
    {
        $settings = [
            'username'      => $this->config['username'],
            'channel'       => '#' . $this->config['channel'],
            'link_names'    => true
        ];

        $client = new Client($this->config['slack_url'], $settings);


        $client->send($this->config['message']);

		return true;
    }

    /**
     * Returns pluing's version.
     *
     * @return string
     */
    public static function getVersion()
    {
        return '1.0.0';
    }

    /**
     * Returns plugin's dependencies.
     *
     * @return type
     */
    public static function getDependencies()
    {
        return array();
    }
}
