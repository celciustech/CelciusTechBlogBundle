<?php

namespace CelciusTech\BlogBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class CelciusTechBlogExtension extends \Twig_Extension
{
    private $container;
    private $em;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $container->get('doctrine.orm.default_entity_manager');
    }

    public function getFunctions()
    {
        return array(
            'get_recent_posts' => new \Twig_Function_Method($this, 'getRecentPosts'),
        );
    }

    public function getRecentPosts($limit = 5)
    {
        $posts = $this->em->getRepository('CelciusTechBlogBundle:Post')->findBy(
            array(), 
            array('created' => 'DESC'),
            $limit
        );

        return $posts;
    }

    public function getName()
    {
        return 'ctblog_extension';
    }
}
