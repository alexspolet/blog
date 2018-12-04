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

  private $get;
  private $post;
  private $server;
  private $route;

  /**
   * Request constructor.ls
   * @param $post
   * @param $server
   */
  public function __construct(array $post, array $server)
  {

    $this->post = $post;
    $this->server = $server;
    $this->makeParams();
  }

  private function makeParams()
  {
    $request = $_SERVER['REQUEST_URI'];
    $get = [];
    $buffer = explode('?', $request);
    $this->route = $buffer[0];

    if (isset ($buffer[1])) {
      $arr = explode('&', $buffer[1]);
      foreach ($arr as $item) {
        $last_buffer = explode('=', $item);
        if (isset( $last_buffer[1])){
          $key = $last_buffer[0];
          unset($last_buffer[0]);
          $last_buffer = implode('=' , $last_buffer);
          $get[$key] = $last_buffer;
        }

      }
      $this->get = $get;
    }
  }

  public function isGet()
  {
    return $_SERVER['REQUEST_METHOD'] === self::METHOD_GET;
  }

  public function isPost()
  {
    return $_SERVER['REQUEST_METHOD'] === self::METHOD_POST;
  }

  public function getMethod()
  {
    return $_SERVER['REQUEST_METHOD'];
  }

  /**
   * @return array
   */
  public function getGet()
  {
    return $this->get;
  }

  /**
   * @return array
   */
  public function getPost()
  {
    return $this->post;
  }

  /**
   * @return array
   */
  public function getServer()
  {
    return $this->server;
  }

  /**
   * @return mixed
   */
  public function getRoute()
  {
    return $this->route;
  }


  public function setGet($name,$value)
  {
    $this->get[$name] = $value;
  }






}