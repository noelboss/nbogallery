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
class Tx_Nbogallery_Domain_Model_Gallery extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * Description
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * Folder
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $folder;
	
	/**
	 * Sort Direction
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $sortdirection;
	
	/**
	 * Sort By
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $sortby;

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the folder
	 *
	 * @return string $folder
	 */
	public function getFolder() {
		return $this->folder;
	}

	/**
	 * Sets the folder
	 *
	 * @param string $folder
	 * @return void
	 */
	public function setFolder($folder) {
		$this->folder = $folder;
	}
	
	/**
	 * Returns Sort By
	 *
	 * @return string $title
	 */
	public function getSortby() {
		return $this->sortby;
	}
	
	/**
	 * Returns Sort Direction
	 *
	 * @return string $title
	 */
	public function getSortdirection() {
		return $this->sortdirection;
	}

}
?>