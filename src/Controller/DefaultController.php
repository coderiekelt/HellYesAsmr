<?php
/**
 * Created by PhpStorm.
 * User: Riekelt Brands
 * Date: 17-3-2018
 * Time: 21:08
 */

namespace App\Controller;

use App\Entity\Background;
use App\Entity\Video;
use App\Repository\BackgroundRepository;
use App\Repository\VideoRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route(path="/", name="app_default_index")
     */
    public function index()
    {
        return $this->render('Default/index.html.twig');
    }

    /**
     * @Route(path="/ajax-videos", name="app_default_ajax_videos")
     *
     * @param Request $request
     */
    public function ajaxVideos(Request $request)
    {
        /**
         * @var VideoRepository $repository
         */
        $repository = $this->getDoctrine()->getRepository(Video::class);

        $nsfw = (bool)$request->query->get('nsfw', false);
        $query = $request->query->get('query', '');

        return new JsonResponse($this->resultsToEncodableList($repository->fetchFromParameters($query, $nsfw)));
    }

    /**
     * @Route(path="/ajax-backgrounds", name="app_default_ajax_backgrounds")
     */
    public function ajaxBackgrounds(Request $request)
    {
        /**
         * @var BackgroundRepository $repository
         */
        $repository = $this->getDoctrine()->getRepository(Background::class);

        $nsfw = (bool)$request->query->get('nsfw', false);
        $query = $request->query->get('query', '');

        return new JsonResponse($this->resultsToEncodableList($repository->fetchFromParameters($query, $nsfw)));
    }

    /**
     * @param $results
     * @return array
     */
    private function resultsToEncodableList($results)
    {
        $output = [];

        foreach ($results as $result) {
            $output[] = $result->toSerializableArray();
        }

        return $output;
    }
}