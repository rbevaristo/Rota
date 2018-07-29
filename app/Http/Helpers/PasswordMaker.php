<?php

use Illuminate\Support\Facades\Hash;

class PasswordMaker
{
    public $firstname, $lastname, $id;
    
    public function _construct($firstname, $lastname, $id)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->id = $id;
        $this->makePassword($this->firstname, $this->lastname, $this->id);
    }

    /**
     * @param string $firstname, $lastname, $id
     * @return Hash String
     */
    public function makePassword($firstname, $lastname, $id)
    {
        return Hash::make($this->getFirstCharacter($firstname) . $this->getFullString($lastname) . $this->getLastTwoCharacters($id));
    }

    /**
     * Get First Letter of a string
     * @param string $string
     * @return string
     */
    private function getFirstCharacter($string)
    {
        return substr($string, 0);
    }

    /**
     * Get Last two letters of a string
     * @param string $string
     * @return string
     */
    private function getLastTwoCharacters($string)
    {
        return substr($string, -2);
    }

    /**
     * Get the whole string
     * @param string $string
     * @return string
     */
    private function getFullString($string)
    {
        return $string;
    }
}