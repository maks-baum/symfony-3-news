<?php

namespace AppBundle\Service;

use AppBundle\Entity\Image;
use AppBundle\Interfaces\ImageInterface;
use AppBundle\Interfaces\ImageProviderInterface;
use GuzzleHttp\Client;

class PixabayImages implements ImageProviderInterface
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @param string $tag
     * @return ImageInterface
     */
    public function getImage(string $tag):ImageInterface
    {
        $client = new Client();
        $res = $client->get(sprintf('https://pixabay.com/api/?key=%s&q=%s&image_type=photo&orientation=horizontal&page=1&per_page=%d', $this->key, $tag, rand(10, 100)));

        if ($res->getStatusCode() !== 200) {
            throw new \Exception('Wrong http status code from pixabay api');
        }

        $result = json_decode($res->getBody()->getContents(), true);
        if ($result === null) {
            throw new \Exception('Wrong response data from pixabay api');
        }

        $image = $result['hits'][rand(0, count($result['hits'])-1)];

        return $result['totalHits'] === 0 ? new Image('') : new Image($image['previewURL'], $image['webformatWidth'], $image['webformatHeight']);
    }
}
