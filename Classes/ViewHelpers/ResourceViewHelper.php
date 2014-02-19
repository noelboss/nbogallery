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
 * Master Resource ViewHelper. Functions as proxy for FilesViewHelper as well as
 * base class for all Resource ViewHelpers
 *
 * @author Claus Due, Wildside A/S
 * @package Nbogallery
 * @subpackage ViewHelpers
 *
 */
class Tx_Nbogallery_ViewHelpers_ResourceViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractTagBasedViewHelper {

	/**
	 * Itnitialize all common arguments for Resource ViewHelpers
	 */
	public function initializeArguments() {
		$this->registerArgument('path', 'string', 'Directory from which to read files', FALSE, NULL);
		$this->registerArgument('as', 'string', 'Optional template variable name to assign', FALSE, NULL);
		$this->registerArgument('return', 'boolean', 'If TRUE, returns the array instead of registering/rendering', FALSE, FALSE);
		$this->registerArgument('sortBy', 'string', 'Special sort property', FALSE, 'filename');
		$this->registerArgument('sortDirection', 'string', 'Direction to sort', FALSE, 'ASC');
		$this->registerArgument('limit', 'integer', 'Specify to limit the number of images which may be rendered');
		$this->registerArgument('offset', 'integer', 'Specify to offset results, use in combination with "limit"', FALSE, 0);
	}

	/**
	 * Render / process
	 *
	 * @return string
	 */
	public function render() {
		// if no "as" argument and no child content, return linked list of files
		// else, assign variable "as"
		$pathinfo = pathinfo($this->arguments['path']);
		if (is_dir($pathinfo['dirname']) === FALSE) {
			$pathinfo = pathinfo(PATH_site . $this->arguments['path']);
		}
		if ($pathinfo['filename'] === '*') {
			$files = $this->documentHead->getFilenamesOfType($pathinfo['dirname'], $pathinfo['extension']);
		} else if ($this->arguments['file']) {
			$files = array($this->arguments['path'] . $this->arguments['file']);
			$files = $this->arrayToFileObjects($files);
			$file = array_pop($files);
			if ($this->arguments['as']) {
				if ($this->templateVariableContainer->exists($this->arguments['as'])) {
					$this->templateVariableContainer->remove($this->arguments['as']);
				}
				$this->templateVariableContainer->add($this->arguments['as'], $file);
			} else if ($this->arguments['return'] === TRUE) {
				return $file;
			} else {
				$this->templateVariableContainer->add('file', $file);
				$content = $this->renderChildren();
				$this->templateVariableContainer->remove('file');
				if (strlen(trim($content)) === 0) {
					return $this->renderFileList($files);
				} else {
					return $content;
				}
			}
		} else if (is_array($this->arguments['files']) && count($this->arguments['files']) > 0) {
			$files = $this->arguments['files'];
			if ($this->arguments['path']) {
				foreach ($files as $k=>$file) {
					$files[$k] = $this->arguments['path'] . $file;
				}
			}
		} else if (is_dir($pathinfo['dirname'] . '/' . $pathinfo['basename'])) {
			$files = scandir($pathinfo['dirname'] . '/' . $pathinfo['basename']);
			foreach ($files as $k=>$file) {
				$file = $pathinfo['dirname'] . '/' . $pathinfo['basename'] . '/' . $file;
				if (is_dir($file)) {
					unset($files[$k]);
				} else if (substr($file, 0, 1) === '.') {
					unset($files[$k]);
				} else {
					$files[$k] = $file;
				}
			}
		} else {
			if ($this->arguments['return'] === TRUE) {
				return array();
			} else {
				return '';
			}
			//throw new Exception('Invalid path given to Resource ViewHelper', $code, $previous);
		}
		$files = $this->arrayToFileObjects($files);
		$files = $this->sortFiles($files);
		// rendering
		$content = '';
		if ($this->arguments['as']) {
			if ($this->templateVariableContainer->exists($this->arguments['as'])) {
				$this->templateVariableContainer->remove($this->arguments['as']);
			}
			$this->templateVariableContainer->add($this->arguments['as'], $files);
		} else if ($this->arguments['return'] === TRUE) {
			return $files;
		} else {
			$this->templateVariableContainer->add('files', $files);
			$content = $this->renderChildren();
			$this->templateVariableContainer->remove('files');
			// possible return: HTML file list
			if (strlen(trim($content)) === 0) {
				$content = $this->renderFileList($files);
			}
		}
		return $content;
	}

	/**
	 * Render a simple list of files with links to that file
	 *
	 * @param array $files
	 * @return string
	 */
	public function renderFileList(array $files) {
		$html = "<ol>" . LF;
		foreach ($files as $file) {
			$relPath = $file->getRelativePath();
			$html .= "<li><a href='{$relPath}'>{$file}</a></li>" . LF;
		}
		$html .= "</ol>" . LF;
		return $html;
	}

	/**
	 * Convert an array of relative or absolute filenames to an array of File
	 * objects.
	 *
	 * @param array $files
	 * @return array
	 */
	protected function arrayToFileObjects(array $files) {
		$objects = array();
		foreach ($files as $k=>$file) {
			if (file_exists($file) === FALSE) {
				$file = PATH_site . $file;
			}
			if (file_exists($file) === TRUE) {
				$fileObject = TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Nbogallery_Resource_File', $file);
				$objects[$k] = $fileObject;
			}
		}
		return $objects;
	}

	/**
	 * Sort the files as defined by arguments
	 *
	 * @param array $files
	 * @return array
	 */
	protected function sortFiles(array $files) {
		$sorted = array();
		foreach ($files as $key=>$file) {
			$index = $this->getSortValue($file, $key);
			while (isset($sorted[$index])) {
				$index = $this->findNewIndex($index);
			}
			$sorted[$index] = $file;
		}
		if ($this->arguments['sortDirection'] === 'ASC') {
			ksort($sorted);
		} else {
			krsort($sorted);
		}
		if ($this->arguments['limit'] > 0) {
			$sorted = array_slice($sorted, $this->arguments['offset'], $this->arguments['limit'], TRUE);
		}
		return array_values($sorted);
	}

	protected function findNewIndex($index) {
		if (is_numeric($index)) {
			return $index+1;
		} else {
			return $index . 'a';
		}
	}

	/**
	 * Gets the value used for sort index for this file
	 *
	 * @param string $src
	 * @param mixed $index
	 * @return mixed
	 */
	protected function getSortValue($src, $index) {
		$field = array_shift(explode(':', $this->arguments['sortBy']));
		if ($src instanceof Tx_Nbogallery_Resource_File) {
			switch ($field) {
				case 'filesize': return $src->getSize();
				case 'mofified': return $src->getModified()->format('U');
				case 'created': return $src->getCreated()->format('U');
				case 'filename': return $src->getBasename();
				default: return $index;
			}
		} else {
			switch ($field) {
				case 'filesize': return (is_file(PATH_site . $src) ? filesize(PATH_site . $src) : 0);
				case 'mofified': return (is_file(PATH_site . $src) ? filemtime(PATH_site . $src) : 0);
				case 'created': return (is_file(PATH_site . $src) ? filectime(PATH_site . $src) : 0);
				case 'filename': return $src;
				default: return $index;
			}
		}
	}

}
