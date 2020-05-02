<?php
# app/Entity/Article.php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\{Column,Entity,Id,ManyToOne,OneToMany};

/**
 * @Entity(repositoryClass="ArticleRepository")
 * @Table(name="article")
 */
class Article
{

    /* ▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀ */
    /* ----------------------------------● NOTE VARIABLES
    /* ▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄ */

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /** @Column(type="string") */
    protected $title;

    /** @Column(type="text") */
    protected $content;

    /** @Column(type="string") */
    protected $pictureUrl;

    /** @Column(type="string") */
    protected $pictureAlt;

    /** @Column(type="datetime") */
    protected $createdAt;

    /** @ManyToOne(targetEntity="User", inversedBy="articles") */
    protected $user;

    /** @OneToMany(targetEntity="Comment", mappedBy="article", cascade={"persist", "remove"}) */
    protected $comments;

    /* ▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀ */
    /* ----------------------------------● NOTE GETTERS & SETTERS
    /* ▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄ */
    
    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    #ID

    public function getId()
    {
        return $this->id;
    }

    #TITLE

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    #CONTENT

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    #PICTUREURL

    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }

    public function setPictureUrl($pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;
    }

    #PICTUREALT

    public function getPictureAlt()
    {
        return $this->pictureAlt;
    }

    public function setPictureAlt($pictureAlt)
    {
        $this->pictureAlt = $pictureAlt;
    }

    #CREATEDAT

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    #USER

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    #COMMENTS

    public function getComments()
    {
        return $this->comments;
    }

    public function addComment(Comment $comment)
    {
        if ($this->comments->contains($comment))
        {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }
    }

    public function removeComment(Comment $comment)
    {
        if ($this->comments->contains($comment))
        {
            $this->comments->removeElement($comment);

            if ($comment->getArticle() === $this)
            {
                $comment->setArticle(null);
            }
        }
    }

}