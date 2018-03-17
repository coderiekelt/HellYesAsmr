<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BackgroundRepository")
 */
class Background
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(name="background_id", type="guid")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $uri;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $nsfw;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     * @return Background
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNsfw()
    {
        return $this->nsfw;
    }

    /**
     * @param bool $nsfw
     * @return Background
     */
    public function setNsfw($nsfw)
    {
        $this->nsfw = $nsfw;
        return $this;
    }

    /**
     * @return array
     */
    public function toSerializableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'uri' => $this->uri,
            'nsfw' => $this->nsfw
        ];
    }

    /**
     * @param string $title
     * @return Background
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
