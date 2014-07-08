<?php

namespace SitePoint\SocialLogin\Facebook;

use SitePoint\SocialLogin\Interfaces\SocialUserInterface;

class FacebookUser implements SocialUserInterface {

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
        return "facebook";
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
        if(array_key_exists('first_name', $this->userData)) {
            return $this->userData['first_name'];
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
        if(array_key_exists('last_name', $this->userData)) {
            return $this->userData['last_name'];
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
        if(array_key_exists('name', $this->userData)) {
            return str_replace(" ", "_", $this->userData['name']);
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
        if(array_key_exists('location', $this->userData)) {
            return $this->userData['location'];
        }
        return null;
    }

    /**
     * Get the birthdate
     *
     * @return string
     */
    public function getBirthDate()
    {
        if(array_key_exists('birthday', $this->userData)) {
            return $this->userData['birthday'];
        }
        return null;
    }

    /**
     * Get the gender
     *
     * @return string
     */
    public function getGender()
    {
        if(array_key_exists('location', $this->userData)) {
            return $this->userData['location']['name'];
        }
        return null;
    }
}