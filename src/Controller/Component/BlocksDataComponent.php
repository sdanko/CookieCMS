<?php

namespace App\Controller\Component;

require_once(ROOT . DS . "Vendor" . DS . "cookie" . DS . "StringConverter.php");

use StringConverter;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Utility\Hash;
use Cake\Cache\Cache;

/**
 * Blocks Component
 */
class BlocksDataComponent extends Component {

    /**
     * Blocks for layout
     *
     * @var string
     * @access public
     */
    public $blocksForLayout = array();

    /**
     * Blocks data: contains parsed value of bb-code like strings
     *
     * @var array
     * @access public
     */
    public $blocksData = array(
        'menus' => array(),
        'vocabularies' => array()
    );

    /**
     * StringConverter instance
     */
    protected $_stringConverter = null;

    /**
     * initialize
     *
     */
    public function initialize(array $config) {
        $this->controller = $this->_registry->getController();
        $this->_stringConverter = new StringConverter();
        if (isset($this->controller->Block)) {
            $this->Block = $this->controller->Block;
        } else {
            $this->Block = TableRegistry::get('Blocks');
        }
    }

    /**
     * Startup
     *
     * @return void
     */
    public function startup(Event $event) {
        if (isset($this->request->params['prefix'])) {
            if ($this->request->params['prefix'] == 'admin') {
                return;
            }
        }
        $this->blocks();
    }

    /**
     * beforeRender
     *
     * @param object $controller instance of controller
     * @return void
     */
    public function beforeRender(Event $event) {
        $controller = $this->_registry->getController();
        $controller->set('blocks_for_layout', $this->blocksForLayout);
    }

    /**
     * Blocks
     *
     * Blocks will be available in this variable in views: $blocks_for_layout
     *
     * @return void
     */
    public function blocks() {
        $regions = $this->Block->Regions->find('active')->combine('id', 'alias')->toArray();
//        if ($regions) {
//            $keyPath = '{n}.' . $this->alias . '.id';
//            $valuePath = '{n}.' . $this->alias . '.alias';
//            $regions = Hash::combine($regions, $keyPath, $valuePath);
//        }
       
        foreach ($regions as $regionId => $regionAlias) {
            $this->blocksForLayout[$regionAlias] = array();

            $blocks = Cache::read('cookie_blocks');
            if ($blocks === false) {
                $blocks = $this->Block->find('active', array(
                    'regionId' => $regionId
                ))->toArray();
                Cache::write('cookie_blocks', $blocks);
            }
            $this->processBlocksData($blocks);
            $this->blocksForLayout[$regionAlias] = $blocks;
        }
    }

    /**
     * Process blocks for bb-code like strings
     *
     * @param array $blocks
     * @return void
     */
    public function processBlocksData($blocks) {
        $converter = $this->_stringConverter;
        foreach ($blocks as $block) {
            $this->blocksData['menus'] = Hash::merge(
                            $this->blocksData['menus'], $converter->parseString('menu|m', $block['body'])
            );
            
            $this->blocksData['vocabularies'] = Hash::merge(
                    $this->blocksData['vocabularies'],
                    $converter->parseString('vocabulary|v', $block['body'])
            );
        }
    }

    /**
     * Parses bb-code like string.
     *
     * Example: string containing [menu:main option1="value"] will return an array like
     *
     * Array
     * (
     *     [main] => Array
     *         (
     *             [option1] => value
     *         )
     * )


      /**
     * Converts formatted string to array
     *
     * A string formatted like 'Node.type:blog;' will be converted to
     * array('Node.type' => 'blog');
     *
     * @deprecated Use StringConverter::stringToArray()
     * @see StringConverter::stringToArray()
     * @param string $string in this format: Node.type:blog;Node.user_id:1;
     * @return array
     */
    public function stringToArray($string) {
        return $this->_stringConverter->stringToArray($string);
    }

}
