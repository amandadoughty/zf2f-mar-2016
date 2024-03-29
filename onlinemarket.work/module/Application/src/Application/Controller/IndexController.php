<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\EventManager\GlobalEventManager;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        echo '<br>' . __METHOD__;
        //$em = $this->getEventManager();
        //$em->setIdentifiers('xyz');
        GlobalEventManager::trigger('whatever', $this, ['abc' => 'GLOBAL']);
        $today = $this->getServiceLocator()->get('application-date');
        $tomorrow = $this->getServiceLocator()->get('application-date');
        $tomorrow->add(new \DateInterval('P1D'));
        echo '<br>' . $this->url()->fromRoute('search-test', ['name' => 'TEST']);
        echo '<br>' . $today->format('Y-m-d H:i:s');
        echo '<br>' . $tomorrow->format('Y-m-d H:i:s');
        echo '<br>' . $this->getServiceLocator()->get('application-who-wins');
        echo '<br>' . $this->getServiceLocator()->get('application-test');
        \Zend\Debug\Debug::dump($this->getServiceLocator()->get('ApplicationConfig'));
        $test = $this->params()->fromQuery('test');
        return new ViewModel(['test' => $test]);
    }
    
    public function fooAction()
    {
        /*(
        $topLeft = new ViewModel();
        $topLeft->setTemplate('application/widgets/top_left');
        $lowerLeft = new ViewModel();
        $lowerLeft->setTemplate('application/widgets/lower_left');
        */
        $data = ['apple' => 'Apple', 'banana' => 'Banana'];
        $viewModel = new ViewModel($data);
        //$viewModel->setTerminal(TRUE);
        //$viewModel->addChild($topLeft, 'topLeft');
        //$viewModel->addChild($lowerLeft, 'lowerLeft');
        return $viewModel;
    }

    public function jsonAction()
    {
        $data = ['apple' => 'Apple', 'banana' => 'Banana'];
        $jsonModel = new JsonModel($data);
        return $jsonModel;
    }
    
}
