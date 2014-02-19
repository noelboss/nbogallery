<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Claus Due <claus@wildside.dk>, Wildside A/S
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * @author Claus Due, Wildside A/S
 * @package Nbogallery
 * @subpackage ViewHelpers/Resource
 *
 */
class Tx_Nbogallery_ViewHelpers_Resource_FileViewHelper extends Tx_Nbogallery_ViewHelpers_ResourceViewHelper {


	/**
	 * Intialize arguments relevant for file resources
	 */
	public function initializeArguments() {
		// initialization of arguments which relate to array('key' => 'filename')
		// type resource ViewHelpers
		parent::initializeArguments();
		$this->registerArgument('file', 'string', 'If specified, takes precedense over "files"', FALSE, NULL);
		$this->registerArgument('files', 'array', 'Array of files to process', FALSE, NULL);
		$this->registerArgument('sql', 'string', 'SQL Query to fetch files, must return either just "filename" or "uid, filename" field in that order', FALSE, NULL);
	}

}
