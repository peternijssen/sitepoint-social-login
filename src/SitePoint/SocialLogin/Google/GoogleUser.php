<?php

namespace SitePoint\SocialLogin\Google;

use SitePoint\SocialLogin\Interfaces\SocialUserInterface;

class GoogleUser implements SocialUserInterface {

    /**
     * @var mixed user data
     */
    private $userData;

    /**
     * Constructor.
     *
     * @param $userData mixed Raw social network data for this particular user
     */
    public function __construct($userData)
    {
        $this->userData = $userData;
    }

    /**
     * Get the provider name
     *
     * @return string
     */
    public function getProvider()
    {
        return "google";
    }

    /**
     * Get the UID of the user
     *
     * @return string
     */
    public function getUid()
    {
        if(array_key_exists('id', $this->userData)) {
            return $this->userData['id'];
        }
        return null;
    }

    /**
     * Get the first name of the user
     *
     * @return string
     */
    public function getFirstname()
    {
        if(array_key_exists('given_name', $this->userData)) {
            return $this->userData['given_name'];
        }
        return null;
    }

    /**
     * Get the last name of the user
     *
     * @return string
     */
    public function getLastname()
    {
        if(array_key_exists('family_name', $this->userData)) {
            return $this->userData['family_name'];
        }
        return null;
    }

    /**
     * Get the username
     *
     * @return string
     */
    public function getUsername()
    {
        if(array_key_exists('family_name', $this->userData)) {
            return str_replace(" ", "_", $this->userData['family_name']);
        }

        return null;
    }

    /**
     * Get the emailaddress
     *
     * @return string
     */
    public function getEmailAddress()
    {
        if(array_key_exists('email', $this->userData)) {
            return $this->userData['email'];
        }
        return null;
    }

    /**
     * Get the city
     *
     * @return string
     */
    public function getCity()
    {
        return null;
    }

    /**
     * Get the birthdate
     *
     * @return string
     */
    public function getBirthDate()
    {
        return null;
    }

    /**
     * Get the gender
     *
     * @return string
     */
    public function getGender()
    {

        if(array_key_exists('gender', $this->userData)) {
            return $this->userData['gender'];
        }
        return null;
    }
}
