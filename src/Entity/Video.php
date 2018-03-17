<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(name="video_id", type="guid")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text", name="youtube_id")
     */
    private $youtubeId;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $nsfw;

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
    public function getYoutubeId()
    {
        return $this->youtubeId;
    }

    /**
     * @param string $youtubeId
     * @return Video
     */
    public function setYoutubeId($youtubeId)
    {
        $this->youtubeId = $youtubeId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Video
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return bool
     */
    public function getNsfw()
    {
        return $this->nsfw;
    }

    /**
     * @param bool $nsfw
     * @return Video
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
            'youtubeId' => $this->youtubeId,
            'nsfw' => $this->nsfw
        ];
    }
}
