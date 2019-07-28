<?php


namespace App\Controller;


use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ProductController
 * @package App\Controller
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    private const POSTS = [
        [
            'id' => 1,
            'slug' => 'hello-world',
            'title' => 'Hello World!'
        ],
        [
            'id' => 2,
            'slug' => 'another-post',
            'title' => 'This is another post'
        ],
        [
            'id' => 3,
            'slug' => 'last-example',
            'title' => 'This is the last example'
        ]
    ];

    /**
     * @param $page
     * @param Request $request
     * @return JsonResponse
     * @Route("/{page}", name="product_list", requirements={"page"="\d+"})
     */
    public function list($page, Request $request)
    {
//        $limit = $request->get('limit', 10);
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $items = $repository->findAll();

        return $this->json(
            [
                'page'=>$page,
//                'limit'=>$limit,
                'data'=>array_map(function(Product $item)
                {
                    return $this->generateUrl('product_by_slug', ['slug'=>$item->getSlug()]);
                }, $items)
            ]
        );
    }

    /**
     * @param Product $post
     * @return JsonResponse
     * @Route("/post/{id}", name="product_by_id", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function post(Product $post)
    {
        return $this->json($post);
    }

    /**
     * @param $post
     * @return JsonResponse
     * @Route("/post/{slug}", name="product_by_slug", methods={"GET"})
     */
    public function productBySlug(Product $post)
    {
        return $this->json($post);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/add", name="product_add", methods={"POST"})
     */
    public function add(Request $request)
    {
        /** @var Serializer $serializer */
        $serializer = $this->get('serializer');

        $product = $serializer->deserialize($request->getContent(), Product::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $this->json($product);
    }

    /**
     * @param Product $post
     * @return JsonResponse
     * @Route("/post/{id}", name="product_delete", methods={"DELETE"})
     */
    public function delete(Product $post)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($post);

        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}