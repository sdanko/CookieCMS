<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Event\Event;
use Cake\Event\EventManager;

class LayoutHelper extends Helper
{
    
    var $helpers = array('Html', 'Session');

    public function sessionFlash() {
            $messages = $this->Session->read('Message');
            $output = '';
            if (is_array($messages)) {
                    foreach (array_keys($messages) as $key) {
                            $output .= $this->Session->flash($key);
                    }
            }
            return $output;
    }
        
    /**
    * Filter content
    *
    * Replaces bbcode-like element tags
    *
    * @param string $content content
    * @return string
    */
    public function filter($content, $options = array()) {
            $event = new Event('Helper.Layout.beforeFilter', $this->_View, [
                        'content' => &$content,
			'options' => $options
                    ]);
            EventManager::instance()->dispatch($event);
                
            $content = $this->filterElements($content, $options);

            return $content;
    }
    
    public function filterElements($content, $options = array()) {
            preg_match_all('/\[(element|e):([A-Za-z0-9_\-\/]*)(.*?)\]/i', $content, $tagMatches);
            $validOptions = array('plugin', 'cache', 'callbacks');
            for ($i = 0, $ii = count($tagMatches[1]); $i < $ii; $i++) {
                    $regex = '/([\w-]+)=[\'"]?((?:.(?![\'"]?\s+(?:\S+)=|[>\'"]))*.)[\'"]?/i';
                    preg_match_all($regex, $tagMatches[3][$i], $attributes);
                    $element = $tagMatches[2][$i];
                    $data = $options = array();
                    for ($j = 0, $jj = count($attributes[0]); $j < $jj; $j++) {
                            if (in_array($attributes[1][$j], $validOptions)) {
                                    $options = Hash::merge($options, array($attributes[1][$j] => $attributes[2][$j]));
                            } else {
                                    $data[$attributes[1][$j]] = $attributes[2][$j];
                            }
                    }
                    if (!empty($this->_View->viewVars['block'])) {
                            $data['block'] = $this->_View->viewVars['block'];
                    }
                    $content = str_replace($tagMatches[0][$i], $this->_View->element($element, $data, $options), $content);
            }
            return $content;
    }
}

