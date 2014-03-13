<?php

namespace ce\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post extends Model
{

    static function getEntityName()
    {
        return 'ce\models\Post';
    }

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var \DateTime
     */
    private $time;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Post
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     * @return Post
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @var \ce\models\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \ce\models\User $user
     * @return Post
     */
    public function setUser(\ce\models\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ce\models\User
     */
    public function getUser()
    {
        return $this->user;
    }

}
