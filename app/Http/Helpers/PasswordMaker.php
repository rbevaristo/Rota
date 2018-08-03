<?php

use Illuminate\Support\Facades\Hash;

class PasswordMaker
{
  
    public function _construct()
    {

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
        return strtolower(substr($string, 0, 1));
    }

    /**
     * Get Last two letters of a string
     * @param string $string
     * @return string
     */
    private function getLastTwoCharacters($string)
    {
        return strtolower(substr($string, -2, 2));
    }

    /**
     * Get the whole string
     * @param string $string
     * @return string
     */
    private function getFullString($string)
    {
        return strtolower($string);
    }
}