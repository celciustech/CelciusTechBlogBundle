<?php

namespace CelciusTech\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use CelciusTech\BlogBundle\Entity\Post;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends EntityRepository
{
    /**
     * Get Query for find all posts
     *
     * @return Query
     */
    public function findAllQuery()
    {
        $em = $this->getEntityManager();

        return $em->createQuery('
          SELECT p FROM CelciusTechBlogBundle:Post p
          ORDER BY p.created DESC
        ');
    }

    /**
     * Find prev post
     *
     * @param Post $post
     * @return Post
     */
    public function findPrevPost(Post $post)
    {
        $em = $this->getEntityManager();

        try {
            return $em->createQuery('
                SELECT p FROM CelciusTechBlogBundle:Post p
                WHERE p.id < :id
            ')->setParameter('id', $post->getId())->setMaxResults(1)->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    /**
     * Find next post
     *
     * @param Post $post
     * @return Post
     */
    public function findNextPost(Post $post)
    {
        $em = $this->getEntityManager();

        try {
            return $em->createQuery('
                SELECT p FROM CelciusTechBlogBundle:Post p
                WHERE p.id > :id
            ')->setParameter('id', $post->getId())->setMaxResults(1)->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }
    }
}
