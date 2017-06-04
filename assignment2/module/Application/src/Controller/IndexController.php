<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Database\QueryProcessor;
use Application\Model\Picture;
use Application\Model\Comment;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{
    /** @var PictureTable $picturesTable */
    private $Queries;

    public function __construct()
    {
        $this->queryProcessor = new Queries('4669a2', 'admintpc', '3lmerfudd');
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function getAllPicturesAction()
    {
        $data = [];

        $num = $this->getRequest()->getQuery('start');
        $count = $this->getRequest()->getQuery('count');

        $pictures = $this->queryProcessor->getPictures($num, $count);

        foreach($pictures as $picture)
        {
            $pictureModel = new Picture();
            $pictureModel
                ->setId($picture['pictures_id'])
                ->setAuthorName('Gary Tong')
                ->setTitle($picture['pictures_title'])
                ->setFileName($picture['pictures_filename'])
                ->setPictureDescription($picture['pictures_description'])
            ;

            $data[] = $pictureModel->getArray();
        }
        
        return new JsonModel($data);
    }

    public function viewOnePictureAction()
    {
        $data = [];

        $picID = $this->getRequest()->getQuery('pictures_id');

        $comments = $this->queryProcessor->getComments($picID);

        foreach($comments as $comment)
        {
            $commentModel = new Comment();
            $commentModel
                ->setComment($comment['comments_comment'])
            ;

            $data[] = $commentModel->getArray();

            $doto = array("comments" => $data);
        }

        return new JsonModel($doto);
    }

    public function searchAction()
    {
        $searchString = $this->getRequest()->getQuery('search');

        $pictureResult = $this->queryProcessor->searchPicture($searchString);

        $pictureModel = new Picture();
        $pictureModel
                ->setId($pictureResult['pictures_id'])
                ->setAuthorName('Gary Tong')
                ->setTitle($pictureResult['pictures_title'])
                ->setFileName($pictureResult['pictures_filename'])
                ->setPictureDescription($pictureResult['pictures_description'])
                ;

        return new JsonModel($pictureModel->getArray());
    }

}
