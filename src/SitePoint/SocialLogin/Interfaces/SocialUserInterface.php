<?php

namespace SitePoint\SocialLogin\Interfaces;

interface SocialUserInterface {

    /**
     * Get the provider name
     *
     * @return string
     */
    public function getProvider();

    /**
     * Get the UID of the user
     *
     * @return string
     */
    public function getUid();

    /**
     * Get the first name of the user
     *
     * @return string
     */
    public function getFirstname();

    /**
     * Get the last name of the user
     *
     * @return string
     */
    public function getLastname();

    /**
     * Get the username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Get the emailaddress
     *
     * @return string
     */
    public function getEmailAddress();

    /**
     * Get the city
     *
     * @return string
     */
    public function getCity();

    /**
     * Get the birthdate
     *
     * @return string
     */
    public function getBirthDate();

    /**
     * Get the gender
     *
     * @return string
     */
    public function getGender();
}
