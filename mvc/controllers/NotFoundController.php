<?php
class NotFoundController extends Controller{
  public function index($err){
    $this->loadTemplateWithView('404');
  }
}