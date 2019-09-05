<?php
class IndexController extends Controller
{
  public function index()
  {
    $this->loadTemplateWithView('index', 'index');
  }

  public function galery()
  {
    $images = $this->loadModel('images');

    if (!empty($_FILES['image'])) {
      $images->upload($_FILES['image']);
    }

    $image = $images->getAllImages();

    $data = array(
      'images' => $image,
    );

    $this->loadTemplateWithView('index', 'galery', $data);
  }
}
