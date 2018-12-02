<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02.12.18
 * Time: 16:05
 */

namespace Core;


class Validator
{

  public $rules;
  public $fields;
  public $isValid;
  private $map;
  public $errors;
  private $entity;

  public function __construct()
  {
    $this->map = include_once 'configs/validationMap.php';
    $this->rules = false;
    $this->isValid = true;
    $this->errors = [];
  }


  public function loadFields($entity)
  {
    $this->entity = $entity;
    $this->rules = $this->map[$entity];
    $this->extractFields([]);

    return $this;
  }

  public function runValidation(array $post)
  {
    $this->extractFields($post);
    $rules = $this->rules['rules'];
    foreach ($rules as $k => $rule) {
      if ($k === 'not_empty') {
        foreach ($this->fields as $name => $value) {
          if (in_array($name, $rule)) {
            if ($value === '' OR $value === null){
              $this->errors[$name] = "Field $name mustn't be empty";
            }
          }
        }
      }
    }
      if (!empty($this->errors)){
        $this->isValid = false;
      }
      return $this;
  }


  private function extractFields(array $post)
  {
    foreach ($this->rules['fields'] as $field) {
      if (!isset($post[$field]) || $post[$field] === '') {
        $this->fields[$field] = null;
        continue;
      }
      $this->fields[$field] = htmlspecialchars(trim($post[$field]));
    }
  }


}