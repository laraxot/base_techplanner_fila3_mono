<?php

declare(strict_types=1);

namespace Modules\Seo\Services;

use DateTimeInterface;
use Modules\Seo\Data\MetatagData;

class MetatagService
{
    /**
     * The metatag data.
     *
     * @var \Modules\Seo\Data\MetatagData
     */
    protected MetatagData $metatagData;

    /**
     * Create a new metatag service instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->metatagData = new MetatagData();
    }

    /**
     * Get the metatag data.
     *
     * @return \Modules\Seo\Data\MetatagData
     */
    public function get(): MetatagData
    {
        return $this->metatagData;
    }

    /**
     * Set the metatag data.
     *
     * @param array<string, mixed> $data
     * @return void
     */
    public function set(array $data): void
    {
        $this->metatagData = new MetatagData($data);
    }

    /**
     * Set the title.
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['title' => $title]));
    }

    /**
     * Set the description.
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['description' => $description]));
    }

    /**
     * Set the keywords.
     *
     * @param string $keywords
     * @return void
     */
    public function setKeywords(string $keywords): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['keywords' => $keywords]));
    }

    /**
     * Set the colors.
     *
     * @param array<string, string> $colors
     * @return void
     */
    public function setColors(array $colors): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['colors' => $colors]));
    }

    /**
     * Set the robots.
     *
     * @param string $robots
     * @return void
     */
    public function setRobots(string $robots): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['robots' => $robots]));
    }

    /**
     * Set the canonical URL.
     *
     * @param string $canonical
     * @return void
     */
    public function setCanonical(string $canonical): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['canonical' => $canonical]));
    }

    /**
     * Set the image URL.
     *
     * @param string $image
     * @return void
     */
    public function setImage(string $image): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['image' => $image]));
    }

    /**
     * Set the locale.
     *
     * @param string $locale
     * @return void
     */
    public function setLocale(string $locale): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['locale' => $locale]));
    }

    /**
     * Set the type.
     *
     * @param string $type
     * @return void
     */
    public function setType(string $type): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['type' => $type]));
    }

    /**
     * Set the site name.
     *
     * @param string $siteName
     * @return void
     */
    public function setSiteName(string $siteName): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['site_name' => $siteName]));
    }

    /**
     * Set the URL.
     *
     * @param string $url
     * @return void
     */
    public function setUrl(string $url): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['url' => $url]));
    }

    /**
     * Set the author.
     *
     * @param string $author
     * @return void
     */
    public function setAuthor(string $author): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['author' => $author]));
    }

    /**
     * Set the published time.
     *
     * @param \DateTimeInterface $time
     * @return void
     */
    public function setPublishedTime(DateTimeInterface $time): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['published_time' => $time]));
    }

    /**
     * Set the modified time.
     *
     * @param \DateTimeInterface $time
     * @return void
     */
    public function setModifiedTime(DateTimeInterface $time): void
    {
        $this->set(array_merge($this->metatagData->toArray(), ['modified_time' => $time]));
    }
}
