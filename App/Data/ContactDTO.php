<?php

namespace App\Data;

use App\Data\Validator;

class ContactDTO
{
  private const NAME_MIN_LENGTH = 2;
  private const NAME_MAX_LENGTH = 64;
  private const FAMILY_MIN_LENGTH = 2;
  private const FAMILY_MAX_LENGTH = 64;

  private $id;
  private $name;
  private $family;
  private $city;
  private $age;
  private $birthDate;
  private $sex;
  private $email;
  private $notes;
  private $avatar;
  private $createdAt;
  private $editedAt;

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    Validator::validateString(self::NAME_MIN_LENGTH, self::NAME_MAX_LENGTH, $name, 'Name');
    $this->name = $name;

    return $this;
  }

  public function getFamily()
  {
    return $this->family;
  }

  public function setFamily($family)
  {
    Validator::validateString(self::FAMILY_MIN_LENGTH, self::FAMILY_MAX_LENGTH, $family, 'Family');
    $this->family = $family;

    return $this;
  }

  public function getCity()
  {
    return $this->city;
  }

  public function setCity($city)
  {
    $this->city = $city;

    return $this;
  }

  public function getAge()
  {
    return $this->age;
  }

  public function setAge($age)
  {
    Validator::validateNumber($age, 'Age');
    $this->age = $age;

    return $this;
  }

  public function getBirthDate()
  {
    return $this->birthDate;
  }

  public function setBirthDate($birthDate)
  {
    Validator::validateDate($birthDate, 'birthDate');
    $this->birthDate = $birthDate;

    return $this;
  }

  public function getSex()
  {
    return $this->sex;
  }

  public function setSex($sex)
  {
    $this->sex = $sex;

    return $this;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    filter_var($email, FILTER_VALIDATE_EMAIL);
    $this->email = $email;

    return $this;
  }

  public function getNotes()
  {
    return $this->notes;
  }

  public function setNotes($notes)
  {
    $this->notes = $notes;

    return $this;
  }

  public function getAvatar()
  {
    return $this->avatar;
  }

  public function setAvatar($avatar)
  {
    $this->avatar = $avatar;

    return $this;
  }

  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  public function setCreatedAt($createdAt)
  {
    Validator::validateDate($createdAt, 'createdAt');
    $this->createdAt = $createdAt;

    return $this;
  }

  public function getEditedAt()
  {
    return $this->editedAt;
  }

  public function setEditedAt($editedAt)
  {
    Validator::validateDate($editedAt, 'editedAt');
    $this->editedAt = $editedAt;

    return $this;
  }
}