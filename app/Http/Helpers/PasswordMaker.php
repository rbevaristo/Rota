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
    }

    /**
     * @param string $firstname, $lastname, $id
     * @return Hash String
     */
    public function makePassword()
    {
        return Hash::make($this->getFirstCharacter($this->firstname) . $this->getFullString($this->lastname) . $this->getLastTwoCharacters($this->id));
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