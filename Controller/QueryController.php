<?php

namespace Arthem\Bundle\GraphQLBundle\Controller;

use Arthem\GraphQLMapper\Exception\QueryException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class QueryController extends Controller
{
    public function queryAction(Request $request)
    {
        $manager = $this->get('arthem_graphql.manager');

        $query = $request->get('query');
        if (empty($query)) {
            throw new BadRequestHttpException('Empty query');
        }

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
