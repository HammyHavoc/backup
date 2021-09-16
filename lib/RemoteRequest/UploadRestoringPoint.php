<?php

declare(strict_types=1);


/**
 * Nextcloud - Backup
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Maxence Lange <maxence@artificial-owl.com>
 * @copyright 2021, Maxence Lange <maxence@artificial-owl.com>
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */


namespace OCA\Backup\RemoteRequest;


use ArtificialOwl\MySmallPhpTools\IDeserializable;
use ArtificialOwl\MySmallPhpTools\Model\SimpleDataStore;
use ArtificialOwl\MySmallPhpTools\Traits\Nextcloud\nc23\TNC23Deserialize;
use ArtificialOwl\MySmallPhpTools\Traits\Nextcloud\nc23\TNC23Logger;
use OCA\Backup\AppInfo\Application;
use OCA\Backup\Db\PointRequest;
use OCA\Backup\IRemoteRequest;
use OCA\Backup\Model\RestoringChunk;


/**
 * Class UploadRestoringPoint
 *
 * @package OCA\Backup\RemoteRequest
 */
class UploadRestoringPoint extends CoreRequest implements IRemoteRequest {


	use TNC23Deserialize;
	use TNC23Logger;


	/** @var PointRequest */
	private $pointRequest;


	/**
	 * UploadRestoringPoint constructor.
	 *
	 * @param PointRequest $pointRequest
	 */
	public function __construct(PointRequest $pointRequest) {
		parent::__construct();
		$this->pointRequest = $pointRequest;

		$this->setup('app', Application::APP_ID);
	}


	/**
	 *
	 */
	public function execute(): void {
		$chunk = $this->deserializeJson($this->getSignedRequest()->getBody(), RestoringChunk::class);

		$this->log(3, '### ' . strlen($chunk->getContent()));
		$this->setOutcome(new SimpleDataStore(['dssd']));
	}


	public function import(array $data): IDeserializable {
		return $this;
	}

}

