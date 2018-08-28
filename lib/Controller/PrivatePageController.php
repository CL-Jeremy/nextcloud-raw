<?php
namespace OCA\Raw\Controller;

use OCP\IRequest;
use OCP\IServerContainer;
use OCP\AppFramework\Http\NotFoundResponse;
use OCP\AppFramework\Controller;
use OCP\Files\Folder;
use OCP\Files\NotFoundException;

class PrivatePageController extends Controller {
	use RawResponse;

	private $userFolder;

	public function __construct(
		$AppName,
		$UserId,
		IRequest $request,
		IServerContainer $serverContainer
	) {
		parent::__construct($AppName, $request);
		$this->userFolder = $serverContainer->getUserFolder($UserId);
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function getByPath($path) {
		if (!$this->userFolder) {
			return new NotFoundResponse();
		}
		try {
			$node = $this->userFolder->get($path);
		} catch (NotFoundException $e) {
			return new NotFoundResponse();
		}
		$content = $node->getContent();
		$mimetype = $node->getMimeType();
		$this->returnRawResponse($content, $mimetype);
	}
}
