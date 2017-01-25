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

    public function initialized()
    {
        return true;
    }
    
        public function run()
    {
        $dispatcher = EventDispatcher::getInstance();
        $dispatcher->attachListener(Events::THREAD_CREATE, $this, 'sendSlackNotification');
    }

    public function sendSlackNotification(&$args)
    {
        $settings = [
            'username' => $this->config['username'],
            'channel' => '#' . $this->config['channel'],
            'link_names' => true
        ];

        $client = new Client('https://hooks.slack.com/services/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', $settings);

        
        $client->send(date('Y-m-d H:i:s') . ' - You have a new user waiting for a response. Username: ' . $args['thread']->userName);
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
