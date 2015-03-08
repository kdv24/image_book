<?php

//this file is class declaration only!!!!!
class Contact {

    private $name;
    private $phone;
    private $address;
    private $image;

    function __construct($name, $phone, $address, $image)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
        $this->image = $image;
    }

// these 3 are for the search bar/function/thing
    function nameMatch($name)
    {
        return $this->name == ($name);
    }


    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }
    function getName()
    {
        return $this->name;
    }
    function setPhone($new_phone)
    {
        $this->phone = (string) $new_phone;
    }
    function getPhone()
    {
        return $this->phone;
    }
    function setAddress($new_address)
    {
        $this->address = (string) $new_address;
    }

    function getAddress()
    {
        return $this->address;
    }
    function setImage($new_image)
    {
        $this->image = $new_image;
    }
    function getImage()
    {
        return $this->image;
    }
    function save()
    {
        array_push($_SESSION['contact_list'], $this);
    }
    static function getAll()
    {
        return $_SESSION['contact_list'];
    }
    static function deleteAll()
    {
        $_SESSION['contact_list'] = array();
    }
}

?>
