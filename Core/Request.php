<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 24.11.18
 * Time: 22:32
 */

namespace Core;


class Request
{
  const METHOD_GET = 'GET';
  const METHOD_POST = 'POST';

  public $get;
  public $post;
  public $server;

  /**
   * Request constructor.
   * @param $get
   * @param $post
   * @param $server
   */
  public function __construct(array $get, array $post, array $server)
  {
    $this->get = $get;
    $this->post = $post;
    $this->server = $server;
  }

  public function isGet(){
    return $_SERVER['REQUEST_METHOD'] === self::METHOD_GET;
  }

  public function isPost(){
    return $_SERVER['REQUEST_METHOD'] === self::METHOD_POST;
  }

  public function getMethod(){
    return $_SERVER['REQUEST_METHOD'];
  }
}