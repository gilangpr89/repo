<?php

class ErrorController extends Zend_Controller_Action
{
    public function init()
    {
        $this->_helper->layout()->disableLayout();
    }

    public function errorAction()
    {
        if($this->getRequest()->isXmlHttpRequest()) {
            $this->_helper->viewRenderer->setNoRender(true);

            $json['login'] = true;
            $json['success'] = false;
            $json['error_code'] = 404;
            $json['error_message'] = 'Page not found.';

            echo Zend_Json::encode($json);
        } else {
            $errors = $this->_getParam('error_handler');
            
            switch ($errors->type) {
                case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
                case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
                case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
            
                    // 404 error -- controller or action not found
                    $this->getResponse()->setHttpResponseCode(404);
                    $this->view->message = 'Page not found';
                    break;
                default:
                    // application error
                    $this->getResponse()->setHttpResponseCode(500);
                    $this->view->message = 'Application error';
                    break;
            }
            
            // Log exception, if logger available
            $log = $this->getLog();
            if ($log) {
                $log->crit($this->view->message, $errors->exception);
            }
            
            // conditionally display exceptions
            if ($this->getInvokeArg('displayExceptions') == true) {
                $this->view->exception = $errors->exception;
            }
            
            $this->view->request   = $errors->request;
        }
    }

    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasPluginResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }


}