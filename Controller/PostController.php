<?php

namespace CelciusTech\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as Extra;
use CelciusTech\CoreBundle\Controller\Controller;
use CelciusTech\BlogBundle\Entity\Post;

class PostController extends Controller
{
    /**
     * @Extra\Template
     */
    public function indexAction()
    {
        $query = $this->getRepository('CelciusTechBlogBundle:Post')->findAllQuery(); 
        $paginator = $this->getDoctrinePaginator($query);

        return array(
            'paginator' => $paginator
        );
    }

    /**
     * @Extra\Template
     * @Extra\ParamConverter("post", class="CelciusTechBlogBundle:Post")
     */
    public function showAction(Post $post)
    {
        $postRepository = $this->getRepository('CelciusTechBlogBundle:Post');
        $prev = $postRepository->findPrevPost($post);
        $next = $postRepository->findNextPost($post);

        return array(
          'post' => $post,
          'prev' => $prev,
          'next' => $next
        );
    }
}
