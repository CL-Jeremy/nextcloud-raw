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

	private $loggedInUserId;
	private $serverContainer;

	public function __construct(
		$AppName,
		$UserId,
		IRequest $request,
		IServerContainer $serverContainer
	) {
		parent::__construct($AppName, $request);
		$this->loggedInUserId = $UserId;
		$this->serverContainer = $serverContainer;
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function getByPath($userId, $path) {
		if ($userId !== $this->loggedInUserId) {
			// TODO Currently, we only allow access to one's own files. I suppose we could implement
			// authorisation checks and give the user access to files that have been shared with them.
			return new NotFoundResponse(); // would 403 Forbidden be better?
		}

		$userFolder = $this->serverContainer->getUserFolder($userId);
		if (!$userFolder) {
			return new NotFoundResponse();
		}

		try {
			$node = $userFolder->get($path);
		} catch (NotFoundException $e) {
			return new NotFoundResponse();
		}
		$this->returnRawResponse($node);
	}
}
