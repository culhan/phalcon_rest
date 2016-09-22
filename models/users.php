<?php
namespace models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\InclusionIn;

class users extends Model
{
    public function validation()
    {

        // Robot name must be unique
        $this->validate(
            new Uniqueness(
                [
                    "field"   => "name",
                    "message" => "The robot name must be unique",
                ]
            )
        );

        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}