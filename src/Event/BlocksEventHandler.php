<?php

require_once(ROOT . DS . "Vendor" . DS . "cookie" . DS . "StringConverter.php");

use Cake\Event\EventListenerInterface;
use Cake\Event\Event;
use Cake\Event\EventManager;

class BlocksEventHandler implements EventListenerInterface
{

    public function implementedEvents()
    {
        return [
            'Helper.Regions.beforeSetBlock' => 'filterBlockShortcode',
            
            'Helper.Regions.afterSetBlock' => 'filterBlockShortcode'
        ];
    }

    /**
 * Filter block shortcode in node body, eg [block:snippet] and replace it with
 * the block content
 *
 * @param CakeEvent $event
 * @return void
 */
	public function filterBlockShortcode($event) {
		static $converter = null;
		if (!$converter) {
			$converter = new StringConverter();
		}

		$View = $event->subject;
		$body = null;
		if (isset($event->data['content'])) {
			$body =& $event->data['content'];
		}

		$parsed = $converter->parseString('block|b', $body, array(
			'convertOptionsToArray' => true,
		));
                
		$regex = '/\[(block|b):([A-Za-z0-9_\-]*)(.*?)\]/i';
		foreach ($parsed as $blockAlias => $config) {
                    $block = $View->Regions->block($blockAlias);
                    preg_match_all($regex, $body, $matches);
                    if (isset($matches[2][0])) {
                            $replaceRegex = '/' . preg_quote($matches[0][0]) . '/';
                            $body = preg_replace($replaceRegex, $block, $body);
                    }
		}
                
                $event = new Event('Helper.Layout.beforeFilter', $View, [
                        'content' => &$body,
			'options' => array()
                    ]);
                EventManager::instance()->dispatch($event);
	}

}

