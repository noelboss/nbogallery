<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Noel Bossart <n.company@me.com>, sagenja.ch
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package nbogallery
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Nbogallery_Controller_GalleryController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * galleryRepository
	 *
	 * @var Tx_Nbogallery_Domain_Repository_GalleryRepository
	 */
	protected $galleryRepository;

	/**
	 * injectGalleryRepository
	 *
	 * @param Tx_Nbogallery_Domain_Repository_GalleryRepository $galleryRepository
	 * @return void
	 */
	public function injectGalleryRepository(Tx_Nbogallery_Domain_Repository_GalleryRepository $galleryRepository) {
		$this->galleryRepository = $galleryRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$galleries = $this->galleryRepository->findAll();
		$this->view->assign('galleryCount', $this->galleryRepository->countAll());
		$this->view->assign('galleries', $galleries);
	}

	/**
	 * action show
	 *
	 * @param $gallery
	 * @return void
	 */
	public function showAction(Tx_Nbogallery_Domain_Model_Gallery $gallery) {
		$this->view->assign('galleryCount', $this->galleryRepository->countAll());
		$this->view->assign('gallery', $gallery);
	}

	/**
	 * action new
	 *
	 * @param $newGallery
	 * @dontvalidate $newGallery
	 * @return void
	 *
	public function newAction(Tx_Nbogallery_Domain_Model_Gallery $newGallery = NULL) {
		$this->view->assign('newGallery', $newGallery);
	}

	/**
	 * action create
	 *
	 * @param $newGallery
	 * @return void
	 *
	public function createAction(Tx_Nbogallery_Domain_Model_Gallery $newGallery) {
		$this->galleryRepository->add($newGallery);
		$this->flashMessageContainer->add('Your new Gallery was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $gallery
	 * @return void
	 *
	public function editAction(Tx_Nbogallery_Domain_Model_Gallery $gallery) {
		$this->view->assign('gallery', $gallery);
	}

	/**
	 * action update
	 *
	 * @param $gallery
	 * @return void
	 *
	public function updateAction(Tx_Nbogallery_Domain_Model_Gallery $gallery) {
		$this->galleryRepository->update($gallery);
		$this->flashMessageContainer->add('Your Gallery was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $gallery
	 * @return void
	 *
	public function deleteAction(Tx_Nbogallery_Domain_Model_Gallery $gallery) {
		$this->galleryRepository->remove($gallery);
		$this->flashMessageContainer->add('Your Gallery was removed.');
		$this->redirect('list');
	}
	/***/
}
?>