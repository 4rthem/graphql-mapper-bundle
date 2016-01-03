<?php

namespace Arthem\Bundle\GraphQLBundle\Controller;

use Arthem\GraphQLMapper\Exception\QueryException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller
{
    public function queryAction(Request $request)
    {
        $manager = $this->get('arthem_graphql.manager');

        $query = $request->request->get('query');

        try {
            $data = $manager->query($query);
        } catch (QueryException $e) {
            $response = new JsonResponse($e->getErrors(), 500);

            return $response;
        }

        $response = new JsonResponse($data);

        return $response;
    }
}
