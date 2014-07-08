<?php

namespace SitePoint\SocialLogin\Twitter;

use SitePoint\SocialLogin\Interfaces\SocialUserInterface;

class TwitterUser implements SocialUserInterface {

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
        return "twitter";
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
        if(array_key_exists('name', $this->userData)) {
            list($firstname, $lastname) = explode(" ", $this->userData['name']); // TODO: Of course you have to make this smarter
            return $firstname;
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
        if(array_key_exists('name', $this->userData)) {
            list($firstname, $lastname) = explode(" ", $this->userData['name']); // TODO: Of course you have to make this smarter
            return $lastname;
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
        if(array_key_exists('screen_name', $this->userData)) {
            return $this->userData['screen_name'];
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
        return null;
    }

    /**
     * Get the gender
     *
     * @return string
     */
    public function getGender()
    {
        return null;
    }
}